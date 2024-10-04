<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Traits\Firebase;

class ChangeCarStatusNotification extends Notification
{
    use Queueable , Firebase;
    protected $receiver, $data;

    public function __construct($car, $status)
    {
        $this->data     = [
            'id'          => $car->id,
            'car_num'     => $car->car_num,
            'vin'         => $car->vin,
            'lot'         => $car->lot,
            'type'        => 'change_car_status' ,
            'car_status'  => $status
        ];
    }
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $tokens = [];
        $types  = [];
        foreach ($notifiable->devices as $device) {
            $tokens[] = $device->device_id ; 
            $types[]  = $device->device_type ; 
        }
        $this->sendFcmNotification($tokens  ,$types, $this->data , $notifiable->lang  ) ;
        return $this->data;
    }
}
