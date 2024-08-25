@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    @endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4 class="card-title">{{__('admin.cars_status')}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body py-0">
                    <div id="cars-chart-status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.cars.create') }}" 
    deletebutton="{{ route('admin.cars.deleteAll') }}" 
    :searchArray="[
        'lot' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.lot') , 
        ] ,
        'vin' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.vin') , 
        ] ,
        'user_id' => [
            'input_type' => 'select' , 
            'rows'       => $users , 
            'input_name' => __('admin.client') , 
        ] ,
        'car_brand_id' => [
            'input_type' => 'select' , 
            'rows'       => $carbrands , 
            'input_name' => __('admin.carbrand') , 
        ] ,
        'car_model_id' => [
            'input_type' => 'select' , 
            'rows'       => $carmodels , 
            'input_name' => __('admin.carmodel') , 
        ],
        'car_year_id' => [
            'input_type' => 'select' , 
            'rows'       => $caryears , 
            'row_name'   => 'year' , 
            'input_name' => __('admin.manufacturing_year') , 
        ] ,
        'car_color_id' => [
            'input_type' => 'select' , 
            'rows'       => $carcolors , 
            'input_name' => __('admin.carcolor') , 
        ] ,
        'car_status_id' => [
            'input_type' => 'select' , 
            'rows'       => $statuses , 
            'input_name' => __('admin.carstatuses') , 
        ] ,
        'car_damage_type_id' => [
            'input_type' => 'select' , 
            'rows'       => $cardamagetypes , 
            'input_name' => __('admin.damagetypes') , 
        ] ,
        'car_body_type_id' => [
            'input_type' => 'select' , 
            'rows'       => $bodytypes , 
            'input_name' => __('admin.bodytypes') , 
        ] ,
        'car_engine_type_id' => [
            'input_type' => 'select' , 
            'rows'       => $enginetypes , 
            'input_name' => __('admin.enginetypes') , 
        ] ,
        'from_country_id' => [
            'input_type' => 'select' , 
            'rows'       => $countries , 
            'input_name' => __('admin.countries') , 
        ] ,
        'region_id' => [
            'input_type' => 'select' , 
            'rows'       => $regions , 
            'input_name' => __('admin.regions') , 
        ] ,
        'warehouse_id' => [
            'input_type' => 'select' , 
            'rows'       => $warehouses , 
            'input_name' => __('admin.warehouses') , 
        ] ,
        'pickup_location_id' => [
            'input_type' => 'select' , 
            'rows'       => $branches , 
            'input_name' => __('admin.branches') , 
        ] ,
        'auction_id' => [
            'input_type' => 'select' , 
            'rows'       => $auctions , 
            'input_name' => __('admin.auctions') , 
        ] ,
        'available' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.sell_available') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.sell_not_available') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.sell_available')  , 
        ] ,

    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>
</x-admin.table>


    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/charts_functions.js')}}"></script>

    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/cars')])
    <script>
    //cars-chart-status
    new ApexCharts(
        document.querySelector("#cars-chart-status"),
        pieChartFunction(@json($statusArr) , @json($carsStatusArr) ,['#A5978B', '#F9CE1D','#4CAF50', '#EA3546','#1CAF20','#A5776B'])
    ).render();
    </script>
@endsection
