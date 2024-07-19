@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.car')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
                            <div class="form-body">
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
                                                    <select name="user_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
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
                                        

                                    
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script>
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
@endsection