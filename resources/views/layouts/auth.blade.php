<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/all.css')}}" rel="stylesheet" >

        <style>
            .login {
                margin-left:20%;
                padding: 12% 100px;
            }
        </style>

    </head>
    <body>
            <div class="content">
                    <div class="title m-b-md">
                        @yield('content')
                    </div>
                </div>
    </body>
</html>
