<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{Setting::get('site_name')}} | @yield('title') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('vendor/admin-css/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('vendor/admin-css/bootstrap/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('vendor/admin-css/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('vendor/admin-css/plugins/iCheck/square/blue.css')}}">

    <link rel="shortcut icon" href="@if( Setting::get('site_icon')) {{ Setting::get('site_icon') }} @else {{asset('favicon.png')}} @endif">

</head>

<body class="hold-transition login-page">
    
    <div class="col-md-6 col-md-offset-3">

    </div>

    <div class="login-box">

        <div class="login-logo">
             <a href="{{route('admin.login')}}"><b> 
                <img class="adm-log-logo" style="width:50%;height:auto" src="@if(Setting::get('site_logo_path')) {{Setting::get('site_logo_path')}} @else {{asset('images/logo.png')}} @endif" /></b></a>
        </div>

        @yield('content')

    </div>

    <!-- jQuery 2.2.0 -->
    <script src="{{asset('vendor/admin-css/plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{asset('vendor/admin-css/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('vendor/admin-css/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            });
        });
    </script>

@yield('scripts')


</body>

</html>

