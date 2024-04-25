<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="content-language" content="en">
    <!-- CSRF Token -->
    <meta id="token" name = "csrf-token" content = "{{ csrf_token() }}">

    <title>{{ config('admin.name', 'Administrator') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('template/assets/vendors/core/core.css')}}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('template/assets/vendors/flatpickr/flatpickr.min.css')}}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('template/assets/fonts/feather-font/css/iconfont.css')}}">

    <link rel="stylesheet" href="{{asset('template/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">

    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('template/assets/css/demo1/style.css')}}">

    <link rel="stylesheet" href="{{asset('template/assets/vendors/sweetalert2/sweetalert2.min.css')}}">


    <!-- End layout styles -->

    <link rel="shortcut icon" href="/admin/favicon.png">

    @yield('styles')
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>;
    </script>
</head>

<body>
<div class="main-wrapper">
    @yield('content')
</div>

<!-- core:js -->
<script src="{{ asset('template/assets/vendors/core/core.js') }}"></script>

<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('template/assets/vendors/flatpickr/flatpickr.min.css') }}"></script>
<script src="{{ asset('template/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('template/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('template/assets/js/template.js') }}"></script>

<!-- endinject -->

<!-- Custom js for this page -->

<script src="{{ asset('template/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('template/assets/js/sweet-alert.js') }}"></script>

<!-- End custom js for this page -->

<script type = "text/javascript">
    $(document).ready(function(){
        $("body").on("click", "#eye", function(event){
            var password = document.getElementById("password");
            if(password.getAttribute("type")=="password"){
                password.setAttribute("type","text");

                $("span#eye i").removeClass('mdi-eye-off');
                $("span#eye i").addClass('mdi-eye');
            } else {
                password.setAttribute("type","password");
                $("span#eye i").removeClass('mdi-eye');
                $("span#eye i").addClass('mdi-eye-off');
            }
        });
    });
</script>

@yield('scripts')
</body>
</html>
