<div class="tab-pane fade" id="carFinance">

    @if($row->carFinance()->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.carfinance') }}</h5>
                    </div>
                    <div class="d-flex justify-content-center btns">

                    </div>
                    <div class="card-body">
                        <div class="contain-table">
                            <table class="table datatable-button-init-basic ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{__('admin.car')}}</th>
                                    <th>{{__('admin.pricetype')}}</th>
                                    <th>{{__('admin.required_amount')}}</th>
                                    <th>{{__('admin.paid_amount')}}</th>
                                    <th>{{__('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $total_required = 0;
                                    $total_paid = 0;
                                ?>
                                @forelse($row->carFinance() as $key => $carfinance)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td>{{ $carfinance->car->car_num??'' }}</td>
                                        <td>{{ $carfinance->priceType->name??'' }}</td>
                                        <td>{{ $carfinance->required_amount }}</td>
                                        <td>{{ $carfinance->paid_amount }}</td>
                                        
                                        <td class="product-action"> 
                                            <span class="text-primary"><a href="{{ route('admin.carfinances.show', ['id' => $carfinance->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                                        </td>
                                    </tr>
                                    <?php 
                                        $total_required += str_replace(',','',$carfinance->required_amount); 
                                        $total_paid +=str_replace(',','',$carfinance->paid_amount); 
                                    ?>
                                @empty
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card border-right-2 border-left-2 border-right-primary border-left-primary">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{__('admin.total_required_amount')}}  </h3>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-right-2 border-left-2 border-right-primary border-left-primary">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{ number_format($total_required - $total_paid,2) }} </h3>
                        </div>
                        <div>
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