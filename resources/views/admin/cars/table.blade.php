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
            <th>{{__('admin.car_num')}}</th>
            <th>{{__('admin.lot')}}</th>
            <th>{{__('admin.vin')}}</th>
            <th>{{__('admin.client')}}</th>
            <th>{{__('admin.carbrand')}}</th>
            <th>{{__('admin.carmodel')}}</th>
            <th>{{__('admin.carcolor')}}</th>
            <th>{{__('admin.manufacturing_year')}}</th>
            <th>{{__('admin.carstatus')}}</th>
            <th>{{__('admin.still_days')}}</th>
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
                    <td>{{ $car->car_num }}</td>
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
                    <td>{{ $car->carStatus->name??'' }}</td>
                    @if($car->stillDays() != null && $car->stillDays() <= 0)
                        <td class="text-danger">{{ $car->stillDays().' '.__('admin.days')  }}</td>
                    @elseif($car->stillDays() > 0)
                        <td>{{ $car->stillDays().' '.__('admin.days') }}</td>
                    @else
                        <td>_</td>
                    @endif
                    
                    <td class="product-action"> 
                        @if($car->nextCarStatus())
                            <span class="change-status btn btn-success btn-sm" data-url="{{ route('admin.cars.carsChangeStatus.'.($car->nextCarStatus()->id??0),[$car->id,($car->nextCarStatus()->id??0)]) }}"><i class="feather icon-edit"></i> {{ __('admin.change_status_to').' '.($car->nextCarStatus()->name??'') }}</span>
                        @endif
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

<script>
    $(document).on('click' , '.change-status', function (e) {
        e.preventDefault()
        Swal.fire({
            title: "{{__('هل تريد الاستمرار ؟')}}",
            text: "{{__('هل انت متأكد انك تريد استكمال عملية التعديل')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('admin.confirm')}}',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonText: '{{__('admin.cancel')}}',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
            }).then( (result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: $(this).data('url'),
                    data: {},
                    dataType: "json",
                    success: function(response){
                            Swal.fire(
                            {
                                position: 'top-start',
                                type: 'success',
                                title: '{{__('admin.changed_successfully')}}',
                                showConfirmButton: false,
                                timer: 1500,
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                            })
                            getData({'searchArray' : searchArray()} )
                            // toastr.error()
                            // $('.data-list-view').DataTable().row($(this).closest('td').parent('tr')).remove().draw();
                    },
                    error: function(xhr) {
                        if(xhr.responseJSON.msg){
                            toastr.error(xhr.responseJSON.msg)
                        }
                    }
                });
            }
        })
    });
</script>

