<div class="tab-pane fade" id="carFinanceOperations">

    @if($car->carFinanceOperations->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.carfinanceoperations') }}</h5>
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
                                    <th>{{__('admin.pricetype')}}</th>
                                    <th>{{__('admin.amount')}}</th>
                                    <th>{{__('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($car->carFinanceOperations as $key => $carfinanceoperations)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td><a href="{{$carfinanceoperations->image}}" target="blank">{{ __('admin.show') }} </a></td>
                                        <td>{{ $carfinanceoperations->priceType->name??'' }}</td>
                                        <td>{{ $carfinanceoperations->amount }}</td>
                                        
                                        <td class="product-action"> 
                                            <span class="text-primary"><a href="{{ route('admin.carfinanceoperations.show', ['id' => $carfinanceoperations->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
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
