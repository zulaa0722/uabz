<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Дадаа файл менежер</title>
    {{-- bootstrap 3.3 --}}
    <link href="{{url('public/dada-file-manager/bootstrap-4/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- bootstrap 3.3 --}}
    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/dada-file-manager/z-alert/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/dada-file-manager/z-alert/css/alertify.default.css') }}" />
    <!--Zagvarlag alert-->
    {{-- Dadaa custom css --}}
    <link href="{{url('public/dada-file-manager/css/dadaa-custom.css')}}" rel="stylesheet">
    @yield('css')
  </head>
  <body>
  @yield('content')
  {{-- jquery --}}
  <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{url('public/dada-file-manager/bootstrap-4/js/bootstrap.min.js')}}"></script>
  <!--Zagvarlag alert-->
  <script src="{{ asset('public/dada-file-manager/z-alert/js/alertify.min.js') }}"></script>
  @yield('js')
  </body>
</html>
