<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Traits\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\UpdateProfile;
use App\Http\Requests\Admin\Auth\updatePassword;
use Hash ;
use App\Models\Country ;
use App\Models\SiteSetting;
use App\Models\CarStatus;
use App\Models\CarFinanceOperations;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use Menu ;
    /***************** dashboard *****************/
    public function dashboard()
    {
        $carsArray      = $this->chartData(new Car);
        $carFinanceOperationsArrayCount      = $this->chartData(new CarFinanceOperations);
        $carFinanceOperationsArraySum      = $this->chartDataFinance(new CarFinanceOperations);

        $activeUsers    = User::where(['is_approved' => 1])->count() ; 
        $notActiveUsers = User::where(['is_approved' => 0])->count() ; 
        
        $mainUsers    = User::whereNull('parent_id')->count() ; 
        $subUsers    = User::whereNotNull('parent_id')->count() ; 

        $vipUsers    = User::where(['vip' => 1])->count() ; 
        $notvipUsers = User::where(['vip' => 0])->count() ; 

        $availableCars    = Car::where(['available' => 1])->count() ; 
        $notavailable     = Car::where(['available' => 0])->count() ; 

        $statuses = CarStatus::orderBy('sort','ASC')->get();
        foreach($statuses as $status){
            $statusArr[] =  $status->name;
            $carsStatusArr[] = Car::where('car_status_id',$status->id)->count();
        }
        foreach($statuses as $status){
            $DelaystatusArr[]     =  $status->name;
            $DelaycarsStatusArr[] = DB::table('cars')
                                            ->join('car_status_histories', 'cars.id', '=', 'car_status_histories.car_id')
                                            ->join('car_statuses', 'cars.car_status_id', '=', 'car_statuses.id')
                                            ->select('car_statuses.name', DB::raw('COUNT(cars.id) as delayed_count'))
                                            ->whereRaw('DATEDIFF(NOW(), car_status_histories.start_date) > car_statuses.num_days')
                                            ->where('car_statuses.id',$status->id)
                                            ->whereNull('car_status_histories.end_date')
                                            ->groupBy('car_statuses.id')
                                            ->get()->first()->delayed_count??0;
        }

        $menus          = $this->home() ;
        $introSiteCards = $this->introSiteCards() ;
        $colores        = ['info' , 'danger' , 'warning' , 'success' , 'primary'];
        
        return view('admin.dashboard.index' ,get_defined_vars());
    }

    public function profile() {
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        return view('admin.admins.profile',get_defined_vars());
    }

    
    public function updateProfile(UpdateProfile $request) {
        auth('admin')->user()->update($request->validated());
        return back()->with('success' , __('admin.update_successfullay'));
    }
    
    public function updatePassword(updatePassword $request) {
        auth('admin')->user()->update(['password' => $request->password]);
        return back()->with('success' , __('admin.update_successfullay'));
    }




    public function chartData($model)
    {
        $users = $model::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); 
        });
        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            $d = ($i < 10 )? date('Y').'-0'.$i : date('Y').'-'.$i;
            if(!empty($usermcount[$d])){
                $userArr[] = $usermcount[$d];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr ; 
    }

    public function chartDataFinance($model)
    {
        $users = $model::select('id', 'created_at','amount')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); 
        });
        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[$key] = $value->sum('amount')??0;
        }
        for($i = 1; $i <= 12; $i++){
            $d = ($i < 10 )? date('Y').'-0'.$i : date('Y').'-'.$i;
            if(!empty($usermcount[$d])){
                $userArr[] = $usermcount[$d];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr ; 
    }
}
