@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.carattachment')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    {{-- to create languages tabs uncomment that --}}
                                    <div class="col-12">
                                        <div class="col-12">
                                            <ul class="nav nav-tabs  mb-3">
                                                    @foreach (languages() as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                        </li>
                                                    @endforeach
                                            </ul>
                                        </div> 

                                        <div class="col-12">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file"  name="image" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <a href="{{$carattachment->image}}" target="blank"><img src="{{$carattachment->image}}"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" value="{{$carattachment->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.car')}}</label>
                                                    <div class="controls">
                                                        <select name="car_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                            <option value>{{__('admin.car')}}</option>
                                                            @foreach ($cars as $car)
                                                                <option value="{{$car->id}}" {{$car->id == $carattachment->car_id ? 'selected' : ''}}>{{$car->car_num.' - '.$car->lot.' - '.$car->vin}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    {{--  to create languages tabs uncomment that --}}
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