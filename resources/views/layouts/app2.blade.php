<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <link rel="manifest" href="manifest.webmanifest">
        <meta charset="utf-8">
        <meta name="theme-color" content="#9decae">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="imgs/new-logo.png" type="image/x-icon">
        <link rel="apple-touch-icon" href="imgs/new-logo.png">
        <title>swaply | home</title>
        <link rel="stylesheet" href="{{asset('css/app.css') }}" type="text/css">
        <link rel="stylesheet" href="{{asset('css/app2.min.css')}}" type="text/css"> 
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" > --}}
    </head>
    <body >
        <div id="canvas"></div>
        <main>
            @yield('content')
        </main>
        {{-- <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/js/uikit.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/js/uikit-icons.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- @livewireScripts --}}
    
    </body>
    @livewireScripts
    <script src="{{asset('js/app.js')}}"></script> 
    <script src="{{asset('js/uikit.min.js')}}" ></script>
    <script src="{{asset('js/uikit-icons.min.js')}}" ></script> 
</html>
