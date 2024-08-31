<div class="tab-pane fade" id="subAccounts">

    @if($row->childes->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.subAccounts') }}</h5>
                    </div>
                    <div class="d-flex justify-content-center btns">

                    </div>
                    <div class="card-body">
                        <div class="contain-table">
                            <table class="table datatable-button-init-basic ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{ __('admin.image') }}</th>
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.email') }}</th>
                                    <th>{{ __('admin.phone') }}</th>
                                    <th>{{ __('admin.ban_status') }}</th>
                                    <th>{{ __('admin.is_approved') }}</th>
                                    <th>{{ __('admin.vip') }}</th>
                                    <th>{{ __('admin.middle') }}</th>
                                    <th>{{ __('admin.usual') }}</th>
                                    <th>{{ __('admin.control') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($row->childes as $key => $child)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td><img src="{{$child->image}}" width="30px" height="30px" alt=""></td>
                                        <td>{{ $child->name }}</td>
                                        <td>{{ $child->email }}</td>
                                        <td>{{ $child->phone }}</td>
                                        <td>
                                            {!! toggleBooleanView($child , route('admin.model.active' , ['model' =>'User' , 'id' => $child->id , 'action' => 'is_blocked'])) !!}
                                        </td>
                                        <td>
                                            {!! toggleBooleanView($child , route('admin.model.active' , ['model' =>'User' , 'id' => $child->id , 'action' => 'is_approved'])) !!}
                                        </td>
                                        <td>
                                            {!! toggleBooleanView($child , route('admin.model.active' , ['model' =>'User' , 'id' => $child->id , 'action' => 'vip'])) !!}
                                        </td>
                                        <td>
                                            {!! toggleBooleanView($child , route('admin.model.active' , ['model' =>'User' , 'id' => $child->id , 'action' => 'middle'])) !!}
                                        </td>
                                        <td>
                                            {!! toggleBooleanView($child , route('admin.model.active' , ['model' =>'User' , 'id' => $child->id , 'action' => 'usual'])) !!}
                                        </td>
                                        <td class="product-action">
                                            <span class="text-primary"><a href="{{ route('admin.clients.show', ['id' => $child->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
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
