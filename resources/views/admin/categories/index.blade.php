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
    addbutton="{{ route('admin.categories.create') }}" 
    deletebutton="{{ route('admin.categories.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'level' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.purchasing') , 
                'id' => 'purchasing' , 
              ],
              '2' => [
                'name' => __('admin.shipping') , 
                'id' => 'shipping' , 
              ],
              '3' => [
                'name' => __('admin.arrived') , 
                'id' => 'arrived' , 
              ],
            ] , 
            'input_name' => __('admin.level')  , 
        ] ,
        'car_statuses' => [
            'input_type' => 'select', 
            'input_name' => __('admin.carstatuses') , 
            'rows'       => $statuses , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
            <a class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light"  href="{{url(route('admin.master-export', 'Category'))}}"><i  class="fa fa-file-excel-o"></i>
                {{ __('admin.export') }}</a>
    </x-slot>


    <x-slot name="tableContent">
        <div class="table_content_append card">

        </div>
    </x-slot>
</x-admin.table>


    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/categories-show/'.$id)])
@endsection
