<!DOCTYPE html>
<html lang="en" class="inner_pages_html">

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
    <!-- Safe Haven Custom styles for this template-->
    <link href="{{url('/')}}/css/safehaven_custom.css" rel="stylesheet">
</head>

<?php /*<body class="fixed-nav sticky-footer bg-dark" id="page-top">*/ ?>
<body class="sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('user.dashboard') }}"><img src="{{url('/')}}/img/SHN-side-logo-2-ce9fc412115910e6ac7df874d95a98c9.png" class="logo logo_mobile"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

        @if( $currentUser->type == "shelter" )
            @include('partials.side-navigation-shelter')
        @elseif( $currentUser->type == "advocate" )
            @include('partials.side-navigation-advocate')
        @endif
        {{--@include('partials.user-main-navigation')--}}

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
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


    @include('partials.user-logout-modal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('/')}}/js/jquery.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('/')}}/js/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    {{--<script src="{{url('/')}}/js/Chart.min.js"></script>--}}
    <!-- Custom scripts for all pages-->
    <script src="{{url('/')}}/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    {{--<script src="{{url('/')}}/js/sb-admin-charts.min.js"></script>--}}
  <!-- Custom scripts for Safe Haven-->
    <script src="{{url('/')}}/js/sh_custom.js"></script>
  </div>
</body>

</html>
