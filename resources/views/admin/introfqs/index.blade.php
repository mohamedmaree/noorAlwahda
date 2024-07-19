@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    addbutton="{{ route('admin.introfqs.create') }}" 
    deletebutton="{{ route('admin.introfqs.deleteAll') }}" 
    :searchArray="[
        'title' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.question') , 
        ] ,
        'description' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.answer') , 
        ] ,
        'intro_fqs_category_id' => [
            'input_type' => 'select' , 
            'rows'       => $categories , 
            'row_name'   => 'title' , 
            'input_name' => __('admin.section') , 
        ] ,
        
    ]" 
>
    <x-slot name="tableContent">
        <div class="table_content_append card">

        </div>
    </x-slot>
</x-admin.table>


    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- delete all script --}}
        @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
        @include('admin.shared.deleteOne')
    {{-- delete one user script --}}

    {{-- delete one user script --}}
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/introfqs')])
    {{-- delete one user script --}}
@endsection
