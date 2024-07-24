<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Models\Car;
use App\Http\Resources\Api\Cars\CarsCollection;
use Illuminate\Http\Request;
use App\Models\Category;

class CarController extends Controller {
  use ResponseTrait;

  public function availableCars(){
    $cars = new CarsCollection(Car::whereNull('user_id')->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function carsByCategory(Request $request){
    $category = Category::findOrFail($request->category_id);
    $cars = new CarsCollection(Car::whereIn('car_status_id',$category->car_statuses_ids??[])->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }
  
}
