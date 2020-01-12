<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Products</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            #app{
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <app />
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
