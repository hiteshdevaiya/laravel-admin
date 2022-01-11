<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title> @yield('title') | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{!! getTinyLogo() !!}">
        @include('admin.layouts.head')
        @yield('customcss')
    </head>

    @section('body')
    @show
    <body data-sidebar="dark">
        <!-- loader start -->
        <div id="preloader">
            <div id="preloader-inner">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>
        <!-- loader end -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('admin.layouts.topbar')
            @include('admin.layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
            <!-- End Page-content -->
            @include('admin.layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('admin.layouts.footer-script')    
    </body>
</html>