<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\UsersResource;
use App\Models\User;
use App\Http\Requests\Api\User\CreateSubCustomerRequest;
use App\Http\Requests\Api\User\UpdateSubcustomerRequest;
use App\Http\Requests\Api\User\ChangeBlockStatusRequest;

class UserController extends Controller {
  use ResponseTrait;

  public function mySubaccounts(){
    $accounts =  UsersResource::collection(auth()->user()->childes);
    return $this->successData( $accounts);
  }

  public function accountDetails(User $user){
    return $this->successData( new UsersResource($user));
  }

  public function createSubCustomer(CreateSubCustomerRequest $request) {
    $user = User::create($request->validated()+(['parent_id' => auth()->id()]));
    return $this->successData( new UsersResource($user->refresh()) );
  }

  public function updateSubcustomer(UpdateSubcustomerRequest $request) {
    $user = User::findOrFail($request->user_id);
    $user->update($request->validated());
    return  $this->successData( new UsersResource($user->refresh()) );
  }

  public function changeBlockStatus(ChangeBlockStatusRequest $request) {
    $user = User::findOrFail($request->user_id);
    $user->update($request->validated());
    return  $this->successData( new UsersResource($user->refresh()) );
  }

}
