@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.carmodels.create') }}" 
    deletebutton="{{ route('admin.carmodels.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'car_brand_id' => [
            'input_type' => 'select' , 
            'rows'       => $brands , 
            'input_name' => __('admin.carbrand') , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
        <a type="button" data-toggle="modal" data-target="#import-file"
        class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light import-file"
        data-id="all"><i class="feather icon-arrow-up-circle"></i> {{ __('admin.importfile') }}</a>
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>
</x-admin.table>
{{-- import files model --}}
<x-admin.ImportFile route="{{ route('admin.carmodels.importFile') }}" />
{{-- import files  model --}}  

    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/carmodels')])
    {{-- import excel file script--}}
    @include('admin.shared.importFile')
    {{-- import excel file script --}}  
@endsection
