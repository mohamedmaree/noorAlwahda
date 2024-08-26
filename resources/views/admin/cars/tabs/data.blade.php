<div class="tab-pane fade active show" id="data">
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
                        data-validation-required-message="{{ __('admin.this_field_is_required') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.vin') }}</label>
                <div class="controls">
                    <input type="text" name="vin" value="{{ $car->vin }}" class="form-control"
                        placeholder="{{ __('admin.vin') }}" required
                        data-validation-required-message="{{ __('admin.this_field_is_required') }}" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.client')}}</label>
                <div class="controls">
                    <select name="user_id" class="select2 form-control"  disabled>
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
                    <select name="car_brand_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_model_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_year_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled >
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
                    <select name="car_color_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_status_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_damage_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_body_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
                        <option value>{{__('admin.bodytype')}}</option>
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
                    <select name="car_engine_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_engine_cylinder_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_transmission_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_drive_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="car_fuel_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="auction_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <input type="text" name="distance" value="{{ $car->distance }}" class="form-control"
                        placeholder="{{ __('admin.distance') }}" required
                        data-validation-required-message="{{ __('admin.this_field_is_required') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.key')}}</label>
                <div class="controls">
                    <select name="key" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="from_country_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="region_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="to_country_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="warehouse_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                    <select name="pickup_location_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
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
                        data-validation-required-message="{{ __('admin.this_field_is_required') }}" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.purchasing_date') }}</label>
                <div class="controls">
                    <input type="date" name="purchasing_date" value="{{$car->purchasing_date}}" class="form-control"
                        placeholder="{{ __('admin.purchasing_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.estimation_arrive_date') }}</label>
                <div class="controls">
                    <input type="date" name="estimation_arrive_date" value="{{$car->estimation_arrive_date}}" class="form-control"
                        placeholder="{{ __('admin.estimation_arrive_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.warehouse_arrive_date') }}</label>
                <div class="controls">
                    <input type="date" name="warehouse_arrive_date" value="{{$car->warehouse_arrive_date}}" class="form-control"
                        placeholder="{{ __('admin.warehouse_arrive_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.company_arrive_date') }}</label>
                <div class="controls">
                    <input type="date" name="company_arrive_date" value="{{$car->company_arrive_date}}"  class="form-control"
                        placeholder="{{ __('admin.company_arrive_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.port_arrive_date') }}</label>
                <div class="controls">
                    <input type="date" name="port_arrive_date" value="{{$car->port_arrive_date}}" class="form-control"
                        placeholder="{{ __('admin.port_arrive_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.shipping_date') }}</label>
                <div class="controls">
                    <input type="date" name="shipping_date" value="{{$car->shipping_date}}"  class="form-control"
                        placeholder="{{ __('admin.shipping_date') }}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.towing_date') }}</label>
                <div class="controls">
                    <input type="date" name="towing_date" value="{{$car->towing_date}}"  class="form-control"
                        placeholder="{{ __('admin.towing_date') }}" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="first-name-column">{{ __('admin.price') }}</label>
                <div class="controls">
                    <input type="text" name="price" value="{{$car->price}}"  step="0.000" class="form-control"
                        placeholder="{{ __('admin.price') }}" >
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <div class="controls">
                    <label for="account-name">{{ __('admin.notes') }}</label>
                    <textarea class="form-control" name="notes" id="" cols="30" rows="10"
                        placeholder="{{ __('admin.notes') }}" disabled>{{$car->notes}}</textarea>
                </div>
            </div>
        </div>
    
    <div class="col-12 d-flex justify-content-center mt-3">
        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
    </div>
    
    </div>
</div>
