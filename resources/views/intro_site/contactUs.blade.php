<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{__('site.contact_us2')}}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="{{$data['fav_icon']}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{$data['fav_icon']}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com"  />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
        <!-- Icons -->
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/fonts/fontawesome.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/fonts/flag-icons.css')}}" />
        <!-- Core CSS -->
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/css/rtl/core.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/css/rtl/theme-default.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/app-assets/css/demo.css')}}" />
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/libs/node-waves/node-waves.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/libs/typeahead-js/typeahead.css')}}" />
        <!-- Vendor -->
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/libs/form-validation/umd/styles/index.min.css')}}" />
        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/css/pages/page-auth.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/toastr.css')}}">


    <style>
     .app-content{
        background-image:  url("{{$data['login_background']}}") ;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
     }   
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body>
    <!-- Content -->
    <div class="container-xxl ">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card" style="direction: {{ lang() == 'ar' ? 'rtl':'ltr' }};">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img class="w-100" src="{{$data['logo']}}" alt="branding logo" style="max-height: 360px;">
                  </span>
                  <span class="app-brand-text demo text-body fw-bold ms-1">{{$data['name_'.lang()]}}</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1 pt-2">{{__('site.contact_us2')}} </h4>
              {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

              <form id="formAuthentication" class="mb-3 send-message" action="{{url('send-message')}}"  method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('site.name')}}:</label>
                    <input type="text"  class="form-control" id="name" name="name" placeholder="{{__('site.name')}}:" autofocus />
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{__('site.phone2')}}</label>
                    <input type="text"  class="form-control" id="phone" name="phone" placeholder="{{__('site.phone2')}}"  />
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">{{__('site.email')}}:</label>
                  <input type="text"  class="form-control" id="email" name="email" placeholder="{{__('site.email')}}:"  />
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="message" placeholder="{{__('site.write_here')}}"></textarea>
                </div>
 
                <div class="mb-3">
                  <button class="btn btn-success d-grid w-100 submit_button" type="submit">{{__('site.send_message')}}</button>
                </div>
              </form>


              </div>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
<script src="{{asset('admin/app-assets/vendors/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/libs/popper/popper.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/libs/node-waves/node-waves.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/menu.js')}}"></script>
<!-- endbuild -->
<!-- Vendors JS -->

<!-- Main JS -->

<!-- Page JS -->
{{-- <script src="{{asset('admin/app-assets/js/pages-auth.js')}}"></script> --}}
<script src="{{asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>


<script> 
    $(document).on('submit','.send-message',function (e) {
        e.preventDefault()
        var url = $(this).attr('action')
        $.ajax({
            url: url,
            method: 'post',
            data: new FormData($(this)[0]),
            dataType:'json',
            processData: false,
            contentType: false,
            success: function(response){
                $('.error_meassages').remove();
                    toastr.success(response.message)
                    $('.send-message')[0].reset()
            },
            error: function (xhr) {
                $('.error_meassages').remove();
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('.send-message input[name=' + key + ']').after('<small class="form-text error_meassages text-danger">' + value + '</small>');
                    $('.send-message textarea[name=' + key + ']').after('<small class="form-text error_meassages text-danger">' + value + '</small>');
                });
            },
        });
    })
</script>
</body>
<!-- END: Body-->

</html>
