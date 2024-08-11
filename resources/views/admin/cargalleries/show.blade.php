@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.cargallery')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    {{-- to create languages tabs uncomment that --}}
                                    {{-- <div class="col-12">
                                        <div class="col-12">
                                            <ul class="nav nav-tabs  mb-3">
                                                    @foreach (languages() as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                        </li>
                                                    @endforeach
                                            </ul>
                                        </div>  --}}

                                        <div class="imgMontg col-12 text-center">

                                            <div class="dropBox d-flex">
                                                @foreach ($cargallery->images as $image)
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$image->image}}" class="im">
                                                                {{-- <button class="delete-image" data-id="{{$image->id}}" ><i class="feather icon-trash text-danger"></i></button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.car')}}</label>
                                                <div class="controls">
                                                    <select name="car_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.car')}}</option>
                                                        @foreach ($cars as $car)
                                                            <option value="{{$car->id}}" {{ $car->id == $cargallery->car_id ? 'selected' : '' }}>{{$car->car_num.' - '.$car->lot.' - '.$car->vin}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.carstatus')}}</label>
                                                <div class="controls">
                                                    <select name="car_status_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                        <option value>{{__('admin.carstatus')}}</option>
                                                        @foreach ($statuses as $status)
                                                            <option value="{{$status->id}}" {{ $status->id == $cargallery->car_status_id ? 'selected' : '' }}>{{$status->name}}</option>
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