<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nota Fiscal de Serviço</title>

        <link rel="stylesheet" href="{{asset('site/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('site/style.css')}}">
        @yield('js')
        
    </head>

    <body>
        @include('layout.navbar')
        
        @yield('content')

        @include('layout.footer')

        <script src="{{asset('site/jquery.js')}}"></script>
        <script src="{{asset('site/bootstrap.js')}}"></script>
    </body>
</html>
