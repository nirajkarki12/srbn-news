<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
   <div id="app">
      @include('layouts.user.nav')

      <main class="py-3 container">
         <div class="row">
            <div class="col-md-3 pr-1 sidebar">
               @include('layouts.user.side-nav')
            </div>
            <div class="col-md-9 pl-2 contents">
               @yield('content')
            </div>
         </div>

      </main>
      <!-- <main class="py-4">
      </main> -->
   </div>
@include('layouts.modal.confirmation')
@yield('scripts')
</body>
</html>
