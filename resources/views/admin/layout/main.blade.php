<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{url('/')}}/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><img src="{{url('/')}}/img/SHN-side-logo-2-ce9fc412115910e6ac7df874d95a98c9.png" class="logo"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

        @include('admin.partials.side-navigation')
        @include('admin.partials.main-navigation')

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Charts</li>
      </ol> -->
      <!-- Area Chart Example-->

        @yield('content')


    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © The Safe Haven Network <?php echo date("Y"); ?></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>


    @include('admin.partials.logout-modal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('/')}}/js/jquery.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('/')}}/js/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <!-- <script src="{{url('/')}}/js/Chart.min.js"></script> -->
    <!-- Custom scripts for all pages-->
    <script src="{{url('/')}}/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- <script src="{{url('/')}}/js/sb-admin-charts.min.js"></script> -->
    <script src="{{url('/')}}/js/jquery.mask.js"></script>
    <script src="{{url('/')}}/js/sh_admin_custom.js"></script>
    @yield('pageJS')
  </div>
</body>


</html>
