@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/clients.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/datatable-responsive.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/datatable.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">

                <!-- Content area -->

                <div style="position: relative">
                    <div class="profile-cover">
                        <div class="profile-cover-img"
                             style="background-image: url({{ $settings['profile_cover'] }})"></div>
                        <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <a href="{{ $row->image }}"
                                   class="profile-thumb" data-fancybox="gallery" data-caption="Caption">
                                    <img src="{{ $row->image }}"
                                         class="bg-white border-white rounded-circle" width="48" height="48" alt="">
                                </a>
                            </div>
                            <div class="media-body text-white">
                                <h1 class="mb-1"> {{ $row->name }}</h1>
                                {{-- <span class="d-block mb-1">{{  __('admin.city') }} : {{ $row->city->name??'' }}</span> --}}
                                {{-- <span class="d-block ">
                                    <i class="fa-regular fa-star font-size-base {{ $row->rate > 0 ? 'active' : '' }}"></i>
                                    <i class="fa-regular fa-star font-size-base {{ $row->rate >= 1 ? 'active' : '' }}"></i>
                                    <i class="fa-regular fa-star font-size-base {{ $row->rate >= 2 ? 'active' : '' }}"></i>
                                    <i class="fa-regular fa-star font-size-base {{ $row->rate >= 3 ? 'active' : '' }}"></i>
                                    <i class="fa-regular fa-star font-size-base {{ $row->rate >= 4 ? 'active' : '' }}"></i>
                                </span> --}}
                            </div>
                            <div class="ml-md-3 mt-2 mt-md-0">
                                <ul class="list-inline list-inline-condensed mb-0">
                                    <li class="list-inline-item"><a href="{{ route('admin.clients.edit', $row->id) }}" class="btn btn-primary border-transparent legitRipple">
                                            <i class="fa-regular fa-pen-to-square mr-2"></i>{{  __('admin.edit') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="navbar navbar-expand-lg navbar-light bg-light p-0">
                        <div class="text-center d-lg-none w-100">
                            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                                    data-target="#navbar-second">
                                <i class="fa-solid fa-bars mr-2"></i>
                                {{  __('admin.data_user') }}
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar-second">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a href="#data" class="navbar-nav-link active legitRipple" data-toggle="tab">
                                        <i class="fa-solid fa-bars mr-2"></i>
                                        {{  __('admin.data_user') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#subAccounts" class="navbar-nav-link legitRipple" data-toggle="tab">
                                        <i class="fa-solid fa-group mr-2"></i>
                                        {{  __('admin.subAccounts') }}
                                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $row->childes->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#orders" class="navbar-nav-link legitRipple" data-toggle="tab">
                                        <i class="fa-solid fa-truck mr-2"></i>
                                        {{  __('admin.cars') }}
                                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $row->cars->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#carFinance" class="navbar-nav-link legitRipple" data-toggle="tab">
                                        <i class="fa-solid feather icon-dollar-sign mr-2"></i>
                                        {{  __('admin.carfinance') }}
                                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $row->carFinance()->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#carFinanceOperations" class="navbar-nav-link legitRipple" data-toggle="tab">
                                        <i class="fa-solid feather icon-dollar-sign mr-2"></i>
                                        {{  __('admin.carfinanceoperations') }}
                                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $row->carFinanceOperations()->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#userattachments" class="navbar-nav-link legitRipple" data-toggle="tab">
                                        <i class="fa-solid feather icon-file mr-2"></i>
                                        {{  __('admin.userattachments') }}
                                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $row->attachments()->count() }}</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="content-3">
                        <div class="row d-flex align-items-start flex-column flex-md-row">
                            <!-- Left content -->
                             <div class="col-md-8">
                                 <div class="tab-content w-100 order-2 order-md-1">
                                     @include('admin.clients.tabs.data')
                                     @include('admin.clients.tabs.subAccounts')
                                     @include('admin.clients.tabs.orders')
                                     @include('admin.clients.tabs.carFinance')
                                     @include('admin.clients.tabs.carFinanceOperations')
                                     @include('admin.clients.tabs.userattachments')
                                 </div>
                             </div>
                            <div class="col-md-4">
                                <div  class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right  border-0 shadow-0 order-1 order-lg-2 sidebar-expand-md">
                                <div class="sidebar-content">


                                    <div class="card border-left-3 border-left-primary rounded-left-0">
                                        <div class="card-header bg-transparent header-elements-inline">
                                            <span class="card-title font-weight-semibold">{{  __('admin.send_notify') }}</span>
                                        </div>
                                        <div class="card-body">
                                            <form class="form notify-form" action="{{  route('admin.clients.notify')  }}"
                                                  method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="notify" value="notify">
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                
                                                <input type="text" name="title_ar" class="form-control" placeholder="{{__('admin.the_title_in_arabic')}}">
                                                <div class="error error_title_ar"></div>
                                                <br>
                                                <input type="text" name="title_en" class="form-control" placeholder="{{__('admin.the_title_in_english')}}">
                                                <div class="error error_body_ar"></div>
                                                <br>
                                                <textarea name="body_ar" class="form-control" rows="3" cols="1" placeholder="{{  __('admin.write') }} {{  __('admin.the_message_in_arabic') }}" required></textarea>
                                                <div class="error error_body_ar"></div>
                                                <br>
                                                <textarea name="body_en" class="form-control" rows="3" cols="1" placeholder="{{  __('admin.write') }} {{  __('admin.the_message_in_english') }}" required></textarea>
                                                <div class="error error_body_en"></div>
                                                <br>
                                                <hr>
                                                <div class="d-flex align-items-center">
                                                    <button type="submit"
                                                            class="btn  btn-labeled btn-labeled-right ml-auto legitRipple btn-primary submit-button"><b><i
                                                                    class="fa-solid fa-paper-plane"></i></b>{{  __('admin.send') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                <!-- /footer -->

                <!-- /main content -->
            </div>
            <!-- /page content -->


        </div>

    </section>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('admin/app-assets/js/jquery-datatable.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>


    <script>
            $(document).ready(function() {
            $('.table').addClass( 'wrap' ).dataTable({
                responsive: true,

                columnDefs: [
                    { responsivePriority: 4, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ],

                "language":
                    {
                        "sProcessing": "جارٍ التحميل...",
                        "sLengthMenu": "أظهر _MENU_ مدخلات",
                        "sZeroRecords": "لم يعثر على أية سجلات",
                        // "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                        "sInfo": " اظهار النتائج من  _START_ - _END_",

                        "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                        "sInfoPostFix": "",
                        "sSearch": "ابحث:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "الأول",
                            "sPrevious": "السابق",
                            "sNext": "التالي",
                            "sLast": "الأخير"
                        },
                        'paginate': {
                            'previous': '<div class="contain-next-previous"><i class="fa-solid fa-angles-right"></i></div>',
                            'next': '<div class="contain-next-previous"><i class="fa-solid fa-angles-left"></i></div> '
                        }
                    },


            });
        } );
        // window.addEventListener("load", function() {

        //     var inputs = document.querySelectorAll('input[type="search"]')
        //     inputs.forEach((input) => {
        //         input.classList.add('form-control');

        //         // input.css.style.borderRadius = '10px'

        //     })
        //     var selects = document.querySelectorAll('select')
        //     selects.forEach((el) => {
        //         el.classList.add('form-control');
        //         console.log(el)
        //         // input.css.style.borderRadius = '10px'

        //     })

        // })
            window.addEventListener("load", function() {

             var containTable =  document.querySelectorAll('.dataTables_wrapper');
            containTable.forEach((el) => {
                let footer = document.createElement("div");
                footer.classList.add('table_footer');
                footer.classList.add('p-2');
                let info = el.querySelector(".dataTables_info");
                let pagination = el.querySelector(".dataTables_paginate")
                footer.append(info)
                footer.append(pagination)


                el.append(footer);
            })

        })
    </script>

    <script>
        // $(document).ready(function () {
        //     $('select').select2();
        // });
    </script>
    <script>
        // $(document).ready(function () {
        //     $(".emojionearea1").emojioneArea({
        //         pickerPosition: "right",
        //         tonesStyle: "bullet",
        //         search: false,
        //         events: {
        //             keyup: function (editor, event) {
        //
        //             }
        //         }
        //     });
        // });
    </script>
    @include('admin.shared.notify')
    <script>
        $(document).on('click', '.print_finance', function (e) {
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
            var newUrl = '{{ route('admin.carfinanceoperations.print-defined') }}?data=' + requestData;
            window.location.href = newUrl;
        }else{
            alert('{{ __('admin.define_items') }}');
        }
    });
    </script>
@endsection