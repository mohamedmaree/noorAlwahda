@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<style>
    .uploadedBlock{
        margin: 5px !important;
    }
    .clickAdd{
        display: inline-block;
        width: 140px;
        height: 140px;
        line-height: 110px;
        text-align: center;
        position: relative;
        border-radius: 15px;
        margin: 5px;
        border: 3px dotted #e4e4e4;
        width: 140px;
        height: 140px;
        margin: 20px;
        border-radius: 28px;
    }        
    .delete-image{
        position: absolute;
        z-index: 9999999;
        left: 36%;
        top: 42%;
        background: bottom;
        font-size: 26px;
        border: aquamarine;
    }
    .delete-attach{
        position: absolute;
        z-index: 9999999;
        left: 36%;
        top: 42%;
        background: bottom;
        font-size: 26px;
        border: aquamarine;
    }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection
{{-- extra css files --}}
@section('content')

<div class="content-body">
<form  method="POST" action="{{route('admin.cars.update' , ['id' => $car->id])}}" class="store form-horizontal" novalidate>
@csrf
@method('PUT')

  <!-- account setting page start -->
    <section id="page-account-settings">
      <div class="row">
          <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1 card card-body">

                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-main" data-toggle="pill" href="#account-vertical-main" aria-expanded="true">
                            <i class="feather icon-settings mr-50 font-medium-3"></i>
                            {{__('admin.main_data')}}
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-carfinance" data-toggle="pill" href="#account-vertical-carfinance" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.carfinance')}}
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-carfinanceoperations" data-toggle="pill" href="#account-vertical-carfinanceoperations" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.carfinanceoperations')}}
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-cargallery" data-toggle="pill" href="#account-vertical-cargallery" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.cargallery')}}
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-carattachments" data-toggle="pill" href="#account-vertical-carattachments" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.carattachments')}}
                        </a>
                    </li>

                </ul>
            </div>
          <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="account-vertical-main" aria-labelledby="account-pill-main" aria-expanded="true">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="image" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$car->image}}">
                                                                <button class="close"><i class="feather icon-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.lot') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="lot" value="{{ $car->lot }}" class="form-control"
                                                        placeholder="{{ __('admin.lot') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.vin') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="vin" value="{{ $car->vin }}" class="form-control"
                                                        placeholder="{{ __('admin.vin') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.client')}}</label>
                                                <div class="controls">
                                                    <select name="user_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.client')}}</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{$user->id}}" {{$user->id == $car->user_id ? 'selected' : ''}}>{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.carbrand')}}</label>
                                                <div class="controls">
                                                    <select name="car_brand_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.carbrand')}}</option>
                                                        @foreach ($carbrands as $carbrand)
                                                            <option {{$carbrand->id == $car->car_brand_id ? 'selected' : ''}} value="{{$carbrand->id}}">{{$carbrand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.carmodel')}}</label>
                                                <div class="controls">
                                                    <select name="car_model_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.carmodel')}}</option>
                                                        @foreach ($carmodels as $carmodel)
                                                            <option {{$carmodel->id == $car->car_model_id ? 'selected' : ''}} value="{{$carmodel->id}}">{{$carmodel->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.caryear')}}</label>
                                                <div class="controls">
                                                    <select name="car_year_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.caryear')}}</option>
                                                        @foreach ($caryears as $caryear)
                                                            <option {{$caryear->id == $car->car_year_id ? 'selected' : ''}} value="{{$caryear->id}}">{{$caryear->year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.carcolor')}}</label>
                                                <div class="controls">
                                                    <select name="car_color_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.carcolor')}}</option>
                                                        @foreach ($carcolors as $carcolor)
                                                            <option {{$carcolor->id == $car->car_color_id ? 'selected' : ''}} value="{{$carcolor->id}}">{{$carcolor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.carstatus')}}</label>
                                                <div class="controls">
                                                    <select name="car_status_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.carstatus')}}</option>
                                                        @foreach ($statuses as $status)
                                                            <option  value="{{$status->id}}" {{$status->id == $car->car_status_id ? 'selected' : ''}}>{{$status->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.damagetype')}}</label>
                                                <div class="controls">
                                                    <select name="car_damage_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.damagetype')}}</option>
                                                        @foreach ($cardamagetypes as $damagae)
                                                            <option  value="{{$damagae->id}}" {{$damagae->id == $car->car_damage_type_id ? 'selected' : ''}}>{{$damagae->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.bodytype')}}</label>
                                                <div class="controls">
                                                    <select name="car_body_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.damagetype')}}</option>
                                                        @foreach ($bodytypes as $bodytype)
                                                            <option  value="{{$bodytype->id}}" {{$bodytype->id == $car->car_body_type_id ? 'selected' : ''}}>{{$bodytype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.enginetype')}}</label>
                                                <div class="controls">
                                                    <select name="car_engine_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.enginetype')}}</option>
                                                        @foreach ($enginetypes as $enginetype)
                                                            <option  value="{{$enginetype->id}}" {{$enginetype->id == $car->car_engine_type_id ? 'selected' : ''}}>{{$enginetype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.enginecylinder')}}</label>
                                                <div class="controls">
                                                    <select name="car_engine_cylinder_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.enginecylinder')}}</option>
                                                        @foreach ($enginecylinder as $enginecylinder)
                                                            <option  value="{{$enginecylinder->id}}" {{$enginecylinder->id == $car->car_engine_cylinder_id ? 'selected' : ''}}>{{$enginecylinder->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.transmissiontype')}}</label>
                                                <div class="controls">
                                                    <select name="car_transmission_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.transmissiontype')}}</option>
                                                        @foreach ($transmissiontypes as $transmissiontype)
                                                            <option  value="{{$transmissiontype->id}}" {{$transmissiontype->id == $car->car_transmission_type_id ? 'selected' : ''}}>{{$transmissiontype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.drivetype')}}</label>
                                                <div class="controls">
                                                    <select name="car_drive_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.drivetype')}}</option>
                                                        @foreach ($drivetypes as $drivetype)
                                                            <option  value="{{$drivetype->id}}" {{$drivetype->id == $car->car_drive_type_id ? 'selected' : ''}}>{{$drivetype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.fueltype')}}</label>
                                                <div class="controls">
                                                    <select name="car_fuel_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.fueltype')}}</option>
                                                        @foreach ($fueltypes as $fueltype)
                                                            <option  value="{{$fueltype->id}}" {{$fueltype->id == $car->car_fuel_type_id ? 'selected' : ''}}>{{$fueltype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.auction')}}</label>
                                                <div class="controls">
                                                    <select name="auction_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.auction')}}</option>
                                                        @foreach ($auctions as $auction)
                                                            <option  value="{{$auction->id}}" {{$auction->id == $car->auction_id ? 'selected' : ''}}>{{$auction->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.distance') }}</label>
                                                <div class="controls">
                                                    <input type="number" name="distance" value="{{ $car->distance }}" class="form-control"
                                                        placeholder="{{ __('admin.distance') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.key')}}</label>
                                                <div class="controls">
                                                    <select name="key" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.key')}}</option>
                                                            <option  value="0" {{$car->key == 0 ? 'selected' : ''}}>{{ __('admin.no') }}</option>
                                                            <option  value="1" {{$car->key == 1 ? 'selected' : ''}}>{{ __('admin.yes') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.from_country')}}</label>
                                                <div class="controls">
                                                    <select name="from_country_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.from_country')}}</option>
                                                        @foreach ($countries as $country)
                                                            <option  value="{{$country->id}}" {{$country->id == $car->from_country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.region')}}</label>
                                                <div class="controls">
                                                    <select name="region_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.region')}}</option>
                                                        @foreach ($regions as $region)
                                                            <option  value="{{$region->id}}" {{$region->id == $car->region_id ? 'selected' : ''}}>{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.to_country')}}</label>
                                                <div class="controls">
                                                    <select name="to_country_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.to_country')}}</option>
                                                        @foreach ($countries as $country)
                                                            <option  value="{{$country->id}}" {{$country->id == $car->to_country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.warehouse')}}</label>
                                                <div class="controls">
                                                    <select name="warehouse_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.warehouse')}}</option>
                                                        @foreach ($warehouses as $warehouse)
                                                            <option  value="{{$warehouse->id}}" {{$warehouse->id == $car->warehouse_id ? 'selected' : ''}}>{{$warehouse->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.pickup_location')}}</label>
                                                <div class="controls">
                                                    <select name="pickup_location_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.pickup_location')}}</option>
                                                        @foreach ($branches as $branch)
                                                            <option  value="{{$branch->id}}" {{$branch->id == $car->pickup_location_id ? 'selected' : ''}}>{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.container') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="container" value="{{$car->container}}" class="form-control"
                                                        placeholder="{{ __('admin.container') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.purchasing_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="purchasing_date" value="{{$car->purchasing_date}}" class="form-control"
                                                        placeholder="{{ __('admin.purchasing_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.estimation_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="estimation_arrive_date" value="{{$car->estimation_arrive_date}}" class="form-control"
                                                        placeholder="{{ __('admin.estimation_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.warehouse_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="warehouse_arrive_date" value="{{$car->warehouse_arrive_date}}" class="form-control"
                                                        placeholder="{{ __('admin.warehouse_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.company_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="company_arrive_date" value="{{$car->company_arrive_date}}"  class="form-control"
                                                        placeholder="{{ __('admin.company_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.port_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="port_arrive_date" value="{{$car->port_arrive_date}}" class="form-control"
                                                        placeholder="{{ __('admin.port_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.shipping_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="shipping_date" value="{{$car->shipping_date}}"  class="form-control"
                                                        placeholder="{{ __('admin.shipping_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.towing_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="towing_date" value="{{$car->towing_date}}"  class="form-control"
                                                        placeholder="{{ __('admin.towing_date') }}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{ __('admin.notes') }}</label>
                                                    <textarea class="form-control" name="notes" id="" cols="30" rows="10"
                                                        placeholder="{{ __('admin.notes') }}">{{$car->notes}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div role="tabpanel" class="tab-pane" id="account-vertical-carfinance" aria-labelledby="account-pill-carfinance" aria-expanded="false">
                                    <div class="row">
                                        @foreach ($priceTypes as $priceType)
                                           <input type="hidden" name="price_type_id[]" value="{{ $priceType->id }}">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ $priceType->name}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="required_amount[]" value="{{ $car->carFinance->where('price_type_id',$priceType->id)->first()->required_amount??''}}" class="form-control"
                                                            placeholder="{{ __('admin.required_amount') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="account-vertical-carfinanceoperations" aria-labelledby="account-pill-carfinanceoperations" aria-expanded="false">
                                    <div class="row">
                                        @foreach ($priceTypes as $priceType)
                                           <input type="hidden" name="operations_price_type_id[]" value="{{ $priceType->id }}">
                                            
                                            <div class="col-12">
                                                <div class="imgMontg col-12 text-center">
                                                    <div class="dropBox">
                                                        <div class="textCenter">
                                                            <div class="imagesUploadBlock">
                                                                <label class="uploadImg">
                                                                    <span><i class="feather icon-image"></i></span>
                                                                    <input type="file" name="operations_image[]" class="imageUploader">
                                                                </label>
                                                                <div class="uploadedBlock">
                                                                    <img src="{{ $car->carFinanceOperations->where('price_type_id',$priceType->id)->first()->image??''}}">
                                                                    <button class="close"><i class="feather icon-x"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ $priceType->name}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="amount[]" value="{{ $car->carFinanceOperations->where('price_type_id',$priceType->id)->first()->amount??''}}"  class="form-control"
                                                            placeholder="{{ __('admin.amount') }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="account-vertical-cargallery" aria-labelledby="account-pill-cargallery" aria-expanded="false">
                                    <div class="row">
                                       
                                        @foreach ($statuses as $status)
                                            <input type="hidden" name="car_status_ids[]" value="{{ $status->id }}">
                                            {{-- {{ $status->name}} --}}
                                     
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox d-flex">
                                                    @if($galleryImages = $car->carGalleries->where('car_status_id',$status->id)->first()?->images)
                                                        @foreach ($galleryImages as $image)
                                                            <div class="textCenter">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*" name="gallery_images[{{ $status->id }}][]" class="imageUploader" multiple>
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        <img src="{{$image->image}}" class="im">
                                                                        <button class="delete-image" data-id="{{$image->id}}" ><i class="feather icon-trash text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    
                                                    @endif
                                                </div>
                                                {{-- <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="gallery_images[{{ $status->id }}][]"  class="imageUploader" multiple>
                                                        </label>
                                                    </div>
                                                </div> --}}
                                            </div>

                                        @endforeach

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="account-vertical-carattachments" aria-labelledby="account-pill-carattachments" aria-expanded="false">
                                    <div class="row">
                                        <div class="imgMontg col-12 text-center">

                                            <div class="dropBox d-flex">
                                                @foreach ($car->carAttachments as $attach)
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$attach->image}}" class="im">
                                                                <button class="delete-attach" data-id="{{$attach->id}}" ><i class="feather icon-trash text-danger"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
    
                                            {{-- <button class="clickAdd">
                                                <span>
                                                    <i class="feather icon-plus"></i>
                                                </span>
                                            </button> --}}
                                            
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <div class="col-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
    </div>

</form>
<!-- account setting page end -->
</div>

@endsection
@section('js')
<script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

{{-- show selected image script --}}
    @include('admin.shared.addImage')
{{-- show selected image script --}}

{{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
{{-- submit add form script --}}
</script>
<script>
    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();
        var image_id = $(this).data('id');
        var url = '{{ route('admin.cargalleries.delete.image') }}';
        if (confirm('Are you sure to delete this image')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'POST',
                data: {
                    image_id: image_id
                },
                dataType: 'json',
                success: (msg) => {
                    if (msg.msg == 'success') {
                        $(this).parents('.textCenter').remove()
                        Swal.fire({
                            position: 'top-start',
                            type: 'success',
                            title: '{{ __('تم حذف المحدد بنجاح') }}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,

                        })
                    }
                }
            });
        }
    })  
    
    $(document).on('click', '.delete-attach', function(e) {
        e.preventDefault();
        var image_id = $(this).data('id');
        var url = '{{ route('admin.carattachments.delete.image') }}';
        if (confirm('Are you sure to delete this file')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'POST',
                data: {
                    image_id: image_id
                },
                dataType: 'json',
                success: (msg) => {
                    if (msg.msg == 'success') {
                        $(this).parents('.textCenter').remove()
                        Swal.fire({
                            position: 'top-start',
                            type: 'success',
                            title: '{{ __('تم حذف المحدد بنجاح') }}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,

                        })
                    }
                }
            });
        }
    })  
</script>  
@endsection

