<?php

namespace App\Models;

use App\Http\Resources\Api\UserResource;
use App\Traits\SmsTrait;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSms;

/**
 * @property mixed country_code
 * @property mixed phone
 */
class User extends Authenticatable
{

    use Notifiable, UploadTrait, HasApiTokens, SmsTrait  , SoftDeletes;

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'lat'         => 'decimal:8',
        'lng'         => 'decimal:8',
        'is_notify'   => 'boolean',
        'is_blocked'  => 'boolean',
        'is_approved' => 'boolean',
        'vip'         => 'boolean',
        'middle'      => 'boolean',
        'usual'       => 'boolean',
        'active'      => 'boolean',
    ];

    protected $fillable = [
        'customer_num',
        'parent_id',
        'country_id',
        'name',
        'country_code',
        'currency_code',
        'phone',
        'email',
        'password',
        'address',
        'image',
        'active',
        'is_blocked',
        'block_reason',
        'is_approved',
        'vip',
        'middle',
        'usual',
        'lang',
        'is_notify',
        'code',
        'code_expire',
        'lat',
        'lng',
        'map_desc',
        'wallet_balance',
    ];

    public function scopeSearch($query, $searchArray = [])
    {
        return $query->when(@$searchArray['created_at_min']
            && @$searchArray['created_at_max'], function ($q) use ($searchArray) {
            $q->whereDate('created_at', '>=', @$searchArray['created_at_min'])
                ->whereDate('created_at', '<=', @$searchArray['created_at_max']);
            })
            ->when(@$searchArray['created_at_min'], function ($q) use ($searchArray) {
                $q->whereDate('created_at', @$searchArray['created_at_min']);
            })
            ->when(@$searchArray['created_at_max'], function ($q) use ($searchArray) {
                $q->whereDate('created_at', @$searchArray['created_at_max']);
            })
            ->when(@$searchArray['order'], function ($q) use ($searchArray) {
                $q->orderBy('created_at', @$searchArray['order']);
            })
            ->when(@$searchArray['name'], function ($q) use ($searchArray) {
                $q->where('name', 'LIKE', '%' . @$searchArray['name'] . '%');
            })
            ->when(@$searchArray['phone'], function ($q) use ($searchArray) {
                $q->where('phone', 'LIKE', '%' . @$searchArray['phone']);
            })
            ->when(@$searchArray['email'], function ($q) use ($searchArray) {
                $q->where('email', 'LIKE', '%' . @$searchArray['email']);
            })
            ->when(@$searchArray['is_blocked'], function ($q) use ($searchArray) {
                $q->where('is_blocked', @$searchArray['is_blocked']);
            })
            ->when(@$searchArray['active'], function ($q) use ($searchArray) {
                $q->where('active', @$searchArray['active']);
            })
            ->when(@$searchArray['is_approved'] !== null, function ($q) use ($searchArray) {
                $q->where('is_approved', @$searchArray['is_approved']);
            })
            ->when(@$searchArray['vip'] !== null, function ($q) use ($searchArray) {
                $q->where('vip', @$searchArray['vip']);
            })
            ->when(@$searchArray['middle'] !== null, function ($q) use ($searchArray) {
                $q->where('middle', @$searchArray['middle']);
            })
            ->when(@$searchArray['usual'] !== null, function ($q) use ($searchArray) {
                $q->where('usual', @$searchArray['usual']);
            })
            ->when(@$searchArray['account_type'] !== null, function ($q) use ($searchArray) {
                if(@$searchArray['account_type'] == '0'){
                    $q->whereNotNull('parent_id');
                }else{
                    $q->whereNull('parent_id');
                }
            });
    }

    public function setPhoneAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['phone'] = fixPhone($value);
        }
    }

    public function setCountryCodeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['country_code'] = fixPhone($value);
        }
    }

    public function getFullPhoneAttribute()
    {
        return $this->attributes['country_code'] . $this->attributes['phone'];
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'users');
        } else {
            $image = $this->defaultImage('users');
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'users') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'users');
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function replays()
    {
        return $this->morphMany(ComplaintReplay::class, 'replayer');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');

    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable')->latest();
    }

    public function settlements()
    {
        return $this->morphMany(Settlement::class, 'transactionable')->latest();
    }

    public function markAsActive()
    {
        $this->update(['code' => null, 'code_expire' => null, 'active' => true]);
        return $this;
    }

    public function sendVerificationCode()
    {
        $this->update([
            'code'        => $this->activationCode(),
            'code_expire' => Carbon::now()->addMinute(),
        ]);

        $this->sendCodeAtSms($this->code);
    //   $this->sendEmail($this->code);

        return new UserResource($this->refresh());
    }

    private function activationCode()
    {
        return 1234;
        return mt_rand(1111, 9999);
    }

    public function sendCodeAtSms($code ,$full_phone = null){
        $msg = trans('apis.activeCode');
        dispatch(new SendSms($full_phone ?? $this->full_phone , $msg . $code));
    }

    public function sendEmail($code ,$full_phone = null){
        $msg = __('apis.activeCode');
        $data = ['title' => __('admin.reset_password'),'message' => $msg.$code];
        dispatch(new SendEmailJob($this->email,$data  ));
    }

    public function logout()
    {
        $this->tokens()->delete();
        // $this->currentAccessToken()->delete();
        if (request()->device_id) {
            $this->devices()->where(['device_id' => request()->device_id])->delete();
        }
        return true;
    }

    public function devices()
    {
        return $this->morphMany(Device::class, 'morph');
    }

    public function login()
    {
        // $this->tokens()->delete();
        $this->updateUserDevice();
        $this->updateUserLang();
        $token = $this->createToken(request()->device_type??"create token")->plainTextToken;
        return UserResource::make($this)->setToken($token);
    }

    public function updateUserLang()
    {
        if (request()->header('Lang') != null
            && in_array(request()->header('Lang'), languages())) {
            $this->update(['lang' => request()->header('Lang')]);
        } else {
            $this->update(['lang' => defaultLang()]);
        }
    }

    public function updateUserDevice()
    {
        if (request()->device_id) {
            $this->devices()->updateOrCreate([
                'device_id'   => request()->device_id,
                'device_type' => request()->device_type,
            ]);
        }
    }

    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable');
    }

    public function ownRooms()
    {
        return $this->morphMany(Room::class, 'createable');
    }

    public function joinedRooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable')
            ->with('room')
            ->get()
            ->sortByDesc('room.last_message_id')
            ->pluck('room');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class,'user_id','id');
    }

    public function childes(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function carFinanceOperations(){
        $carids = $this->cars->pluck('id');
        return CarFinanceOperations::whereIn('car_id',$carids)->get();
    }

    public function carFinance(){
        $carids = $this->cars->pluck('id');
        return CarFinance::whereIn('car_id',$carids)->get();
    }

    public static function boot()
    {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */
        self::creating(function ($model) {
            $lastId = self::max('id') ?? 0;
            $model->customer_num = date('Y') . ($lastId + 1);
        });
        static::deleted(function ($model) {
            $model->deleteFile($model->attributes['image'], 'users');
        });
    }


}
