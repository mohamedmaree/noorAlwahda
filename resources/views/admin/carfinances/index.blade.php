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
    addbutton="{{ route('admin.carfinances.create') }}" 
    deletebutton="{{ route('admin.carfinances.deleteAll') }}" 
    :searchArray="[
        'required_amount' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.required_amount') , 
        ] ,
        'car_id' => [
            'input_type' => 'select' , 
            'rows'       => $cars , 
            'row_name'   => 'car_num' , 
            'input_name' => __('admin.cars') , 
        ] ,
         'price_type_id' => [
            'input_type' => 'select' , 
            'rows'       => $priceTypes , 
            'input_name' => __('admin.pricetypes') , 
        ] ,
        'userid' => [
            'input_type' => 'select' , 
            'rows'       => $users , 
            'input_name' => __('admin.client') , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
        <a href class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light print" href=""><i  class="feather icon-arrow-down"></i>
            {{ __('admin.print') }}</a>
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
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/carfinances')])
    <script>
        $(document).on('click', '.print', function (e) {
            e.preventDefault();
            var ids = [];
            $('.checkSingle:checked').each(function () {
                var id = $(this).attr('id');
                ids.push({
                    id: id,
                });
            });
            var requestData = JSON.stringify(ids);
            if (ids.length > 0) {
                var newUrl = '{{ route('admin.carfinances.print-defined') }}?data=' + requestData;
                window.location.href = newUrl;
            }else{
                alert('{{ __('admin.define_items') }}');
            }
        });
    </script>
@endsection
