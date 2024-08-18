<div class="tab-pane fade" id="history">

    @if($car->statusHistory->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.car_history') }}</h5>
                    </div>
                    <div class="d-flex justify-content-center btns">

                    </div>
                    <div class="card-body">
                        <div class="contain-table">
                            <table class="table datatable-button-init-basic ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{__('admin.name')}}</th>
                                    <th>{{__('admin.start_date')}}</th>
                                    <th>{{__('admin.end_date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($car->statusHistory as $key => $status)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>

                                        <td>{{ $status->carStatus->name }}</td>
                                        <td>{{ $status->start_date }}</td>
                                        <td>{{ $status->end_date }}</td>
                                        
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
