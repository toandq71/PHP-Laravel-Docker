<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Admin Panel | @yield('title')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    @include('layouts.admin.styles')
    @include('layouts.admin.footer')

    <script>
        var BASE_URL = '{{ url("/") }}';
    </script>
</head>
<body class="">
    <div class="main-wrapper">

        @include('layouts.admin.sidebar')

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            @include('layouts.admin.header')

            <!-- Page content -->
            <div class="page-content">

                <nav class="page-breadcrumb">
                    @yield('breadcrumb')
				</nav>

                @include('layouts.admin.flash')

                @yield('content')
            </div>
            <!-- /.content -->

            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>.</p>
                <p class="text-muted">Handcrafted With <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart mb-1 text-primary ms-1 icon-sm"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </footer>
        </div>
    </div>
    @yield('js_inline')
</body>
</html>