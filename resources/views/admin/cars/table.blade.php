<div class="position-relative">
    {{-- table loader  --}}
    {{-- <div class="table_loader" >
        {{__('admin.loading')}}
    </div> --}}
    {{-- table loader  --}}
    
    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
            <tr>
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
            </th>
            <th>{{__('admin.image')}}</th>
            <th>{{__('admin.lot')}}</th>
            <th>{{__('admin.vin')}}</th>
            <th>{{__('admin.client')}}</th>
            <th>{{__('admin.carbrand')}}</th>
            <th>{{__('admin.carmodel')}}</th>
            <th>{{__('admin.carcolor')}}</th>
            <th>{{__('admin.manufacturing_year')}}</th>
            <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $car->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$car->image}}" width="30px" height="30px" alt=""></td>
                    <td>{{ $car->lot }}</td>
                    <td>{{ $car->vin }}</td>
                    <td>
                        @if($car->user_id)
                            <a href="{{ route('admin.clients.show',[$car->user_id]) }}">{{ $car->user->name??'' }}</a>
                        @endif
                    </td>
                    <td>{{ $car->carBrand->name??'' }}</td>
                    <td>{{ $car->carModel->name??'' }}</td>
                    <td>{{ $car->carColor->name??'' }}</td>
                    <td>{{ $car->carYear->year??'' }}</td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.cars.show', ['id' => $car->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.cars.edit', ['id' => $car->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/cars/' . $car->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($cars->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($cars->count() > 0 && $cars instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$cars->links()}}
    </div>
@endif
{{-- pagination  links div --}}

