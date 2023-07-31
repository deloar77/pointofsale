<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deloar</title>
    <link rel="shortcut icon" href="{{asset("/images/favicon.ico")}}" type="image/x-icon">
    <link  href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link  href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link  href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link  href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastify.css')}}" rel="stylesheet">
    <script src="{{asset('js/toastify.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
</head>
<body>

 <div>
    @yield('content')
 </div>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>