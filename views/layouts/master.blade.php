{{--  feel free to edit this template , just dont forget to embed @yield('content')
your template may be like :

  @include('header')
        @yield('content')
 @include('footer')

 --}}

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Irticket</title>
    <style>
        .no-btn {
            border:none;
            background-color: transparent;
        }
        .no-btn:hover{
            color: #b95126;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>


