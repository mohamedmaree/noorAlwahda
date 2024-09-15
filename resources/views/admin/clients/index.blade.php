@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection

@section('content')
<div class="row">

  <div class="col-lg-6 col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
            <h4 class="card-title">{{__('admin.main_users')}}</h4>
        </div>
        <div class="card-content">
            <div class="card-body py-0">
                <div id="mainusers-chart"></div>
            </div>
            {{-- <ul class="list-group list-group-flush customer-info">
                <li class="list-group-item d-flex justify-content-between ">
                    <div class="series-info">
                        <i class="fa fa-circle font-small-3 text-primary"></i>
                        <span class="text-bold-600">{{__('admin.main_users')}}</span>
                    </div>
                    <div class="product-result">
                        <span>{{$mainUsers}}</span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between ">
                    <div class="series-info">
                        <i class="fa fa-circle font-small-3 text-warning"></i>
                        <span class="text-bold-600">{{__('admin.sub_users')}}</span>
                    </div>
                    <div class="product-result">
                        <span>{{$subUsers}}</span>
                    </div>
                </li>
            </ul> --}}
        </div>
    </div>
  </div>
  <div class="col-lg-6 col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
            <h4 class="card-title">{{__('admin.vip_users')}}</h4>
        </div>
        <div class="card-content">
            <div class="card-body py-0">
                <div id="vip-chart"></div>
            </div>
            {{-- <ul class="list-group list-group-flush customer-info">
                <li class="list-group-item d-flex justify-content-between ">
                    <div class="series-info">
                        <i class="fa fa-circle font-small-3 text-primary"></i>
                        <span class="text-bold-600">{{__('admin.vip_users')}}</span>
                    </div>
                    <div class="product-result">
                        <span>{{$vipUsers}}</span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between ">
                    <div class="series-info">
                        <i class="fa fa-circle font-small-3 text-warning"></i>
                        <span class="text-bold-600">{{__('admin.not_vip_users')}}</span>
                    </div>
                    <div class="product-result">
                        <span>{{$notvipUsers}}</span>
                    </div>
                </li>
            </ul> --}}
        </div>
    </div>
  </div>
</div>
<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.clients.create') }}" 
    deletebutton="{{ route('admin.clients.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ],
        'phone' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.phone') , 
        ] ,
        'email' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.email') , 
        ] ,
        'country_id' => [
            'input_type' => 'select' , 
            'rows'       => $countries , 
            'input_name' => __('admin.countries') , 
        ] ,
        'is_blocked' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.Prohibited') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.Unspoken') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.ban_status') , 
        ] ,
        'is_approved' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.approved') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.not_approved') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.is_approved')  , 
        ] ,
        'account_type' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.main_account') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.sub_account') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.account_type')  , 
        ] ,
        'vip' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.vip') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.not_vip') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.vip')  , 
        ] ,
        'middle' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.middle') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.not_middle') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.middle')  , 
        ] ,
        'usual' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.usual') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.not_usual') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.usual')  , 
        ] ,
        
    ]" 
>
  <x-slot name="extrabuttonsdiv">
    <a type="button" data-toggle="modal" data-target="#notify"
      class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify"
      data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a>
   {{--  <a type="button" data-toggle="modal" data-target="#mail"
      class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light mail"
      data-id="all"><i class="feather icon-mail"></i> {{ __('admin.Send_email') }}</a>
      <a type="button" data-toggle="modal" data-target="#sms"
      class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light sms"
      data-id="all"><i class="feather icon-phone"></i> {{ __('admin.send_sms') }}</a>
    <a class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light"  href="{{url(route('admin.master-export', 'User'))}}"><i  class="fa fa-file-excel-o"></i>
        {{ __('admin.export') }}</a>
    <a type="button" data-toggle="modal" data-target="#import-file"
        class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light import-file"
        data-id="all"><i class="feather icon-arrow-up-circle"></i> {{ __('admin.importfile') }}</a> --}}
  </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">

        </div>
    </x-slot>
</x-admin.table>
  {{-- notify users model --}}
  <x-admin.NotifyAll route="{{ route('admin.clients.notify') }}" />
  {{-- notify users model --}}
  {{-- import files model --}}
  <x-admin.ImportFile route="{{ route('admin.clients.importFile') }}" />
  {{-- import files  model --}}  
@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/charts_functions.js')}}"></script>

    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/clients-show/'.$id)])
    @include('admin.shared.notify')
    <script>
      $(document).ready(function(){
          $(document).on('click','.block_user',function(e){
              e.preventDefault();
              $.ajax({
                  url: '{{url("admin/clients/block")}}',
                  method: 'post',
                  data: { id : $(this).data('id')},
                  dataType:'json',
                  beforeSend: function(){
                      $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disable',true)
                  },
                  success: function(response){
                      Swal.fire({
                                  position: 'top-start',
                                  type: 'success',
                                  title: response.message,
                                  showConfirmButton: false,
                                  timer: 1500,
                                  confirmButtonClass: 'btn btn-primary',
                                  buttonsStyling: false,
                              })
                      setTimeout(function(){
                          window.location.reload()
                      }, 1000);
                  },
              });
  
          });
      });
  </script>
  <script>
        //vip-chart
        new ApexCharts(
            document.querySelector("#vip-chart"),
            pieChartFunction(['{{ __('admin.vip_users') }}', '{{ __('admin.not_vip_users') }}'] , [ Number('{{$vipUsers}}'), Number('{{$notvipUsers}}')] , ['#7367F0', '#FF9F43'])
        ).render();
        //mainusers-chart
        new ApexCharts(
            document.querySelector("#mainusers-chart"),
            pieChartFunction(['{{ __('admin.main_users') }}', '{{ __('admin.sub_users') }}'] , [ Number('{{$mainUsers}}'), Number('{{$subUsers}}')] , ['#7367F0', '#FF9F43'])
        ).render();

        document.querySelectorAll('input[name="vip"]').forEach(function(vipCheckbox) {
          alert('dd');
            vipCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    let rowClass = this.classList[1];
                    document.querySelectorAll(`.toggleBtn.${rowClass}`).forEach(function(checkbox) {
                        if (checkbox.name !== 'vip') {
                            checkbox.checked = false;
                        }
                    });
                }
            });
        });

        document.querySelectorAll('input[name="middle"]').forEach(function(vipCheckbox) {
            vipCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    let rowClass = this.classList[1];
                    document.querySelectorAll(`.toggleBtn.${rowClass}`).forEach(function(checkbox) {
                        if (checkbox.name !== 'middle') {
                            checkbox.checked = false;
                        }
                    });
                }
            });
        });

        document.querySelectorAll('input[name="usual"]').forEach(function(vipCheckbox) {
            vipCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    let rowClass = this.classList[1];
                    document.querySelectorAll(`.toggleBtn.${rowClass}`).forEach(function(checkbox) {
                        if (checkbox.name !== 'usual') {
                            checkbox.checked = false;
                        }
                    });
                }
            });
        });
    </script>

  </script>
    {{-- import excel file script--}}
    @include('admin.shared.importFile')
    {{-- import excel file script --}}  
@endsection
