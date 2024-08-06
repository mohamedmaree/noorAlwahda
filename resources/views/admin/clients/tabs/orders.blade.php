<div class="tab-pane fade" id="orders">

    @if($row->cars->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.cars') }}</h5>
                    </div>
                    <div class="d-flex justify-content-center btns">

                    </div>
                    <div class="card-body">
                        <div class="contain-table">
                            <table class="table datatable-button-init-basic ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{__('admin.image')}}</th>
                                    <th>{{__('admin.lot')}}</th>
                                    <th>{{__('admin.vin')}}</th>
                                    <th>{{__('admin.carbrand')}}</th>
                                    <th>{{__('admin.carmodel')}}</th>
                                    <th>{{__('admin.carcolor')}}</th>
                                    <th>{{__('admin.manufacturing_year')}}</th>
                                    <th>{{__('admin.show')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($row->cars as $key => $car)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td><img src="{{$car->image}}" width="30px" height="30px" alt=""></td>
                                        <td>{{ $car->lot }}</td>
                                        <td>{{ $car->vin }}</td>
                                        <td>{{ $car->carBrand->name??'' }}</td>
                                        <td>{{ $car->carModel->name??'' }}</td>
                                        <td>{{ $car->carColor->name??'' }}</td>
                                        <td>{{ $car->carYear->year??'' }}</td>
                                        <td class="product-action">
                                            <span class="text-primary"><a href="{{ route('admin.cars.show', ['id' => $car->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>

                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif

</div>
