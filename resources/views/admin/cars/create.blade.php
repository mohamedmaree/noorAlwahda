@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
<style>
    .clickAdd {
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
</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection
{{-- extra css files --}}
@section('content')

<div class="content-body">
<form action="{{route('admin.cars.store')}}" method="post" enctype="multipart/form-data" class="store form-horizontal" novalidate>
@csrf

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
                    {{-- <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-carfinanceoperations" data-toggle="pill" href="#account-vertical-carfinanceoperations" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.carfinanceoperations')}}
                        </a>
                    </li> --}}
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
                                                <div class="">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="image" class="imageUploader">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.lot') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="lot" class="form-control"
                                                        placeholder="{{ __('admin.lot') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.vin') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="vin" class="form-control"
                                                        placeholder="{{ __('admin.vin') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.client')}}</label>
                                                <div class="controls">
                                                    <select name="user_id" class="select2 form-control" >
                                                        <option value>{{__('admin.client')}}</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                            <option value="{{$carbrand->id}}">{{$carbrand->name}}</option>
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
                                                            <option  value="{{$carmodel->id}}">{{$carmodel->name}}</option>
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
                                                            <option value="{{$caryear->id}}">{{$caryear->year}}</option>
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
                                                            <option  value="{{$carcolor->id}}">{{$carcolor->name}}</option>
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
                                                            <option  value="{{$status->id}}">{{$status->name}}</option>
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
                                                            <option  value="{{$damagae->id}}">{{$damagae->name}}</option>
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
                                                        <option value>{{__('admin.bodytype')}}</option>
                                                        @foreach ($bodytypes as $bodytype)
                                                            <option  value="{{$bodytype->id}}">{{$bodytype->name}}</option>
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
                                                            <option  value="{{$enginetype->id}}">{{$enginetype->name}}</option>
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
                                                            <option  value="{{$enginecylinder->id}}">{{$enginecylinder->name}}</option>
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
                                                            <option  value="{{$transmissiontype->id}}">{{$transmissiontype->name}}</option>
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
                                                            <option  value="{{$drivetype->id}}">{{$drivetype->name}}</option>
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
                                                            <option  value="{{$fueltype->id}}">{{$fueltype->name}}</option>
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
                                                            <option  value="{{$auction->id}}">{{$auction->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.distance') }}</label>
                                                <div class="controls">
                                                    <input type="number" name="distance" class="form-control"
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
                                                            <option  value="0">{{ __('admin.no') }}</option>
                                                            <option  value="1">{{ __('admin.yes') }}</option>
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
                                                            <option  value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.region')}}</label>
                                                <div class="controls">
                                                    <select name="region_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.region')}}</option>
                                                        @foreach ($regions as $region)
                                                            <option  value="{{$region->id}}">{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.to_country')}}</label>
                                                <div class="controls">
                                                    <select name="to_country_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.to_country')}}</option>
                                                        @foreach ($countries as $country)
                                                            <option  value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.warehouse')}}</label>
                                                <div class="controls">
                                                    <select name="warehouse_id" class="select2 form-control" >
                                                        <option value>{{__('admin.warehouse')}}</option>
                                                        @foreach ($warehouses as $warehouse)
                                                            <option  value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.pickup_location')}}</label>
                                                <div class="controls">
                                                    <select name="pickup_location_id" class="select2 form-control" >
                                                        <option value>{{__('admin.pickup_location')}}</option>
                                                        @foreach ($branches as $branch)
                                                            <option  value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.container') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="container" class="form-control"
                                                        placeholder="{{ __('admin.container') }}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.purchasing_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="purchasing_date" class="form-control"
                                                        placeholder="{{ __('admin.purchasing_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.estimation_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="estimation_arrive_date" class="form-control"
                                                        placeholder="{{ __('admin.estimation_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.warehouse_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="warehouse_arrive_date" class="form-control"
                                                        placeholder="{{ __('admin.warehouse_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.company_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="company_arrive_date" class="form-control"
                                                        placeholder="{{ __('admin.company_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.port_arrive_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="port_arrive_date" class="form-control"
                                                        placeholder="{{ __('admin.port_arrive_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.shipping_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="shipping_date" class="form-control"
                                                        placeholder="{{ __('admin.shipping_date') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.towing_date') }}</label>
                                                <div class="controls">
                                                    <input type="date" name="towing_date" class="form-control"
                                                        placeholder="{{ __('admin.towing_date') }}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.price') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" step="0.00" class="form-control"
                                                        placeholder="{{ __('admin.price') }}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{ __('admin.notes') }}</label>
                                                    <textarea class="form-control" name="notes" id="" cols="30" rows="10"
                                                        placeholder="{{ __('admin.notes') }}"></textarea>
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
                                                        <input type="number" name="required_amount[]" class="form-control"
                                                            placeholder="{{ __('admin.required_amount') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                {{-- <div role="tabpanel" class="tab-pane" id="account-vertical-carfinanceoperations" aria-labelledby="account-pill-carfinanceoperations" aria-expanded="false">
                                    <div class="row">
                                        @foreach ($priceTypes as $priceType)
                                           <input type="hidden" name="operations_price_type_id[]" value="{{ $priceType->id }}">
                                            <div class="col-12">
                                                <div class="imgMontg col-12 text-center">
                                                    <div class="">
                                                        <div class="textCenter">
                                                            <div class="imagesUploadBlock">
                                                                <label class="uploadImg">
                                                                    {{ $priceType->name}}
                                                                    <span><i class="feather icon-image"></i></span>
                                                                    <input type="file" name="operations_image[]" class="imageUploader">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ $priceType->name}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="amount[]" class="form-control"
                                                            placeholder="{{ __('admin.amount') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> --}}
                                <div role="tabpanel" class="tab-pane" id="account-vertical-cargallery" aria-labelledby="account-pill-cargallery" aria-expanded="false">
                                    <div class="row">
                                        
            
                                        @foreach ($statuses as $status)
                                            <input type="hidden" name="car_status_ids[]" value="{{ $status->id }}">
                                           
                                            <div class="col-12">
                                                <div class="imgMontg col-12 text-center">
                                                    <div class=" d-flex">
                                                        <div class="textCenter">
                                                            <div class="imagesUploadBlock">
                                                                {{ $status->name}}
                                                                <label class="uploadImg">
                                                                    <span><i class="feather icon-image"></i></span>
                                                                    <input type="file" accept="image/*" name="gallery_images[{{ $status->id }}][]"  class="imageUploader" multiple>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
        
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="account-vertical-carattachments" aria-labelledby="account-pill-carattachments" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="imgMontg col-12 text-center">
    
                                                <div class="dropBox d-flex">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file"  name="images[]"
                                                                    class="imageUploader">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <button class="clickAdd">
                                                    <span>
                                                        <i class="feather icon-plus"></i>
                                                    </span>
                                                </button>
    
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
      </div>
    </section>

    <div class="col-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.add')}}</button>
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
@endsection

