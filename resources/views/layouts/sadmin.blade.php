<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <link rel="manifest" href="{{asset('manifest.webmanifest')}}"/>
        <meta charset="utf-8"/>
        <meta name="theme-color" content="#9decae"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta name="description" content="a site for items trading freely or almost"/> 
        <meta name="auther" content="bixa">
        <meta property="og:url" content="https://www.swap-ly.com/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Swaply" />
        <meta property="og:description" content="swap sell buy donate simply" />
        <meta property="og:locale" content="ar_EG" />
        <meta property="og:image" content="{{asset('imgs/new-logo.png')}}" />

        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}" />
        <title>Swaply | Admin</title>        
        <link rel="stylesheet" href="{{asset('admin/css/bs-rtl.min.css')}}">        
        <link rel="stylesheet" href="{{asset('admin/css/bs-utilities.rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/bs-grid.rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/bs-reboot.rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bs-icons.css')}}" >
        <link rel="stylesheet" href="{{asset('css/animation.css')}}" >
        
        @livewireStyles
        
    </head>
    <body>
        <div id="canvas"></div>
        <main>
            @yield('content')
        </main>
        <div id="notification" class="notification bottom hidden"></div>
        <div id="network_connection" class="network_connection ani ani_slideInUp hidden"></div>
    </body>
    
    @livewireScripts      
    <script src="{{asset('admin/js/bs.bundle.min.js')}}" defer></script>
    <script type="module" src="{{asset('admin/js/bs.esm.min.js')}}" defer></script> 
    <script src="{{asset('js/popper.min.js')}}" defer></script>
    <script src="{{asset('admin/js/bs.min.js')}}"></script>  
</html>
