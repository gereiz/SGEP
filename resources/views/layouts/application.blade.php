<!DOCTYPE html>

<html lang="en" class="default-style">
<head> 
    <title> SGEP - Sistema de Gestão de Espaços Publicitários </title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/ionicons.css')}}"> 
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/linearicons.css')}}"> 


    <!-- Core stylesheets -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/bootstrap.css')}}"> <!-- class="theme-settings-bootstrap-css" --> 
  <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/appwork.css')}}"> <!-- class="theme-settings-appwork-css" -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-corporate.css')}}"> <!-- class="theme-settings-theme-css" -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/colors.css')}}"> <!-- class="theme-settings-colors-css" -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/uikit.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables/datatables.css')}}">

  <link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}">

  
  <!--pessoal-->   
  <link rel="stylesheet" href="{{asset('assets/css/sidenav.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">   



 <!--<script src="{{asset('assets/vendor/js/material-ripple.js')}}"></script>
  <script src="{{asset('assets/vendor/js/layout-helpers.js')}}"></script>-->


    <!-- Theme settings -->
    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
    <script src="{{asset('assets/vendor/js/theme-settings.js')}}"></script>
    

    <!-- Core scripts -->
    <script src="{{asset('assets/vendor/js/pace.js')}}"></script>
    <script src="{{asset('assets/vendor/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/js/layout-helpers.js')}}"></script>
    

    <!-- Libs -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">

</head>


<body>
    <div class="page-loader"><div class="bg-primary"></div></div>

    @yield('layout-content')

      <!-- Core scripts -->
      <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
      <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
      <script src="{{asset('assets/vendor/js/sidenav.js')}}"></script>

   
       <!-- Libs -->
       <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
       <script src="{{asset('assets/vendor/libs/datatables/datatables.js')}}"></script>
       <script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
   
       <!-- Demo -->
       <script src="{{ asset('assets/js/demo.js') }}"></script>

     
     
     
     
     
       <!-- Plugins Datatables-->
      <!--<script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.buttons.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/buttons.bootstrap.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/jszip.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/pdfmake.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/vfs_fonts.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/buttons.html5.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/buttons.print.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.fixedHeader.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.keyTable.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.responsive.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/responsive.bootstrap.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.scroller.min.js') }}"></script>
      <script src="{{asset('assets/vendor/libs/datatables/plugins/dataTables.rowGroup.min.js') }}"></script>-->
   
  

      <script type="text/javascript">
           jQuery(document).ready(function() {
               @include('layouts.partials.notifications')
           });

                         // configurando o datatables para pt-br
                         $.extend( true, $.fn.dataTable.defaults, {
                  oLanguage : {
                      "sProcessing":   "A processar...",
                      "sLengthMenu":   "Mostrar _MENU_ registros",
                      "sZeroRecords":  "Não foram encontrados resultados",
                      "sEmptyTable":   "Nenhum registro foi encontrado",
                      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                      "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
                      "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                      "sInfoPostFix":  "",
                      "sSearch":       "Pesquisar",
                      "sUrl":          "",
                      "oPaginate": {
                          "sFirst":    "Primeiro",
                          "sPrevious": "Anterior",
                          "sNext":     "Seguinte",
                          "sLast":     "Último"
                      }
                  }
              });

      </script>  
</body>
</html>
