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
                <th>{{__('admin.image')}}</th>
                <th>{{__('admin.car')}}</th>
                <th>{{__('admin.pricetypes')}}</th>
                <th>{{__('admin.amount')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carfinanceoperations as $carfinanceoperations)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $carfinanceoperations->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="{{$carfinanceoperations->image}}" target="blank">{{ __('admin.show') }} </a></td>
                    <td>{{ $carfinanceoperations->car->car_num??'' }}</td>
                    <td>
                       {{ $carfinanceoperations->priceType->name??''}}
                    </td>
                    <td>{{ $carfinanceoperations->amount }}</td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.carfinanceoperations.show', ['id' => $carfinanceoperations->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.carfinanceoperations.edit', ['id' => $carfinanceoperations->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/carfinanceoperations/' . $carfinanceoperations->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($carfinanceoperations->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($carfinanceoperations->count() > 0 && $carfinanceoperations instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$carfinanceoperations->links()}}
    </div>
@endif
{{-- pagination  links div --}}

