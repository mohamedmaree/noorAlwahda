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
                <th>{{__('admin.attachment')}}</th>
                <th>{{__('admin.car')}}</th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carattachments as $carattachment)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $carattachment->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="{{$carattachment->image}}" target="blank"><img src="{{$carattachment->image}}" width="30px" height="30px" alt=""></a></td>
                    <td>
                        @if($carattachment->car)
                            <a href="{{ route('admin.cars.show', ['id' => $carattachment->car_id]) }}" > {{  $carattachment->car->car_num}}</a>
                        @endif
                    </td>
                    <td>{{ $carattachment->name }}</td>

                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.carattachments.show', ['id' => $carattachment->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.carattachments.edit', ['id' => $carattachment->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/carattachments/' . $carattachment->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($carattachments->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($carattachments->count() > 0 && $carattachments instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$carattachments->links()}}
    </div>
@endif
{{-- pagination  links div --}}

