<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="default-style">

<head>
  <title>SGEP - Sistema de Gestão de Espaços Publicitários</title>

  <meta charset="utf-8"> 
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

  <!-- Icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css">
  <link rel="stylesheet" href="assets/vendor/fonts/ionicons.css"> 

  <!-- Core stylesheets -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/bootstrap.css"> <!-- class="theme-settings-bootstrap-css" --> 
  <link rel="stylesheet" href="assets/vendor/css/rtl/appwork.css"> <!-- class="theme-settings-appwork-css" -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-air.css"> <!-- class="theme-settings-theme-css" -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/colors.css"> <!-- class="theme-settings-colors-css" -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/uikit.css">

  <link rel="stylesheet" href="assets/vendor/libs/toastr/toastr.css">

  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/custom_login.css">

  <script src="assets/vendor/js/material-ripple.js"></script>
  <script src="assets/vendor/js/layout-helpers.js"></script>


  <!-- Core scripts -->
  <script src="assets/vendor/js/pace.js"></script>
  <script src="assets/vendor/js/jquery.min.js"></script>

  <!-- Libs -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/authentication.css">
</head>

<body>
  <div class="page-loader">
    <div class="bg-primary"></div>
  </div>

  <!-- Content -->

  <div class="authentication-wrapper authentication-3">
    <div class="authentication-inner">

      <!-- Side container -->
      <!-- Do not display the container on extra small, small and medium screens -->
      <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('assets/img/bg/32.jpg');">
        <div class="ui-bg-overlay bg-dark opacity-50"></div>

        <!-- Text -->
        <div class="w-100 text-white px-5">
          <h3 class="display-2 font-weight-bolder mb-2">Sistema de Gerenciamento de Espaços Publicitários</h3>
          <div class="text-large font-weight-light">
           Nome Provisório
          </div>
        </div>
        <!-- /.Text -->
      </div>
      <!-- / Side container -->

      <!-- Form container -->
      <div class="d-flex col-lg-4 align-items-center bg-white p-5">
        <!-- Inner container -->
        <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
        <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
          <div class="w-100">

            <!-- Logo -->
            <div class="d-flex justify-content-center align-items-center">
              <div class="ui-w-60">
                <div class="w-100 position-relative" style="padding-bottom: 54%">
                  <img class="login_logo" src="{{asset('assets/img/logo.png')}}" alt="Indiana">
                </div>
              </div>
            </div>
            <!-- / Logo -->

            <h4 class="text-center text-lighter font-weight-normal text_login">Entre com seu usuário</h4>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" aria-label="Login" class="my-5 login_form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">           
              <div class="form-group">
                <label class="form-label">Usuário</label>
                <input type="text" class="form-control" name="email" VALUE="{{ old('email') }}">
              </div>
              <div class="form-group">
                <label class="form-label d-flex justify-content-between align-items-end">
                  <div>Senha</div>
                </label>
                <input type="password" class="form-control" name="password">
              </div>
              <div class="d-flex justify-content-between align-items-center m-0">
                <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
            </form>
            <!-- / Form -->

          </div>
        </div>
      </div>
      <!-- / Form container -->

    </div>
  </div>

  <!-- / Content -->

    <!-- Core scripts -->
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/js/sidenav.js"></script>

    <!-- Libs -->
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/libs/toastr/toastr.js"></script>

    <!-- Demo -->
    <script src="assets/js/app.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            @include('layouts.partials.notifications')
        });
    </script>  


</body>

</html>