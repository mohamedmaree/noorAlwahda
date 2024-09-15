@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.status-history-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-wrap: nowrap;
}

.icon-line {
    display: flex;
    align-items: center;
    position: relative;
    width: 100%;
}

.status-item {
    text-align: center;
    position: relative;
    margin: 0 10px;
}

.car-icon {
    font-size: 20px;
    position: absolute;
    top: -10px; /* Adjust as needed */
    left: 50%;
    transform: translateX(-50%);
}

.line {
    height: 1px;
    background-color: #252424;
    width: 130%;
    position: absolute;
    top: 12px; /* Adjust as needed */
    left: 0;
}

.status-details {
    margin-top: 20px; /* Adjust as needed */
}

</style>

@endsection

@section('content')

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
        'user_id' => [
            'input_type' => 'select' , 
            'rows'       => $users , 
            'input_name' => __('admin.client') , 
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
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/cars/status/'.$status_id)])
@endsection
