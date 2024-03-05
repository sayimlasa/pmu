<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('include.head')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        @include('include.header')
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('include.sidebar')
    <!-- /.control-sidebar -->
    <div class="content-wrapper">

        <section class="content">

            @yield('content')

        </section>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
        @include('include.footer')
    </footer>
</div>
<!-- ./wrapper -->
@include('include.footerscript')
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

</body>
</html>
