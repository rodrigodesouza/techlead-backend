<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #2f3031 !important;
        }
    </style>

</head>

<body>

  <div id="app">

    <div id="page-content-wrapper">
        <menu-component v-if="$store.getters.autenticado"></menu-component>
        <div class="container-fluid mt-5">
            <router-view></router-view>
        </div>
        <div class="col d-flex justify-content-center mt-5" >
            <a href="/login" target="_blank">Acessar área administrativa</a>
        </div>
    </div>

  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>

