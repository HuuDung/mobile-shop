@include('layouts.header')
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
@if(Auth::check())
    @include('modules.top')
@else
    @include('modules.unauth-top')
@endif
<!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content container">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
    @yield('footer')
    <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->
@include('layouts.footer')
