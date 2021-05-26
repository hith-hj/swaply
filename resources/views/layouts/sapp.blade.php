<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <link rel="manifest" href="{{asset('manifest.webmanifest')}}">
        <meta charset="utf-8">
        <meta name="theme-color" content="#9decae">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0,maximum-scale=1.0,">
        <meta name="description" content="a site for swaping items freely or almost"> 
        <meta name="auther" content="bixa">
        @auth
            <meta name="logged" content="{{Auth::user()->name}}">
        @else
            <meta name="logged" content="false">   
        @endauth
        <link rel="shortcut icon" href="{{asset('imgs/new-logo.png')}}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{asset('imgs/new-logo.png')}}" />
        <title>swaply | home</title>        
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/lib.css')}}" > 
        <link rel="stylesheet" href="{{asset('css/bs-icons.css')}}" >
        <link rel="stylesheet" href="{{asset('css/animation.css')}}" >
        @livewireStyles
        
    </head>
    <body >
        
        <div id="canvas"></div>
        <main>
            @yield('content')
        </main>
        <div id="notification" class="notification bottom hidden"></div>
        
        <div id="app_install" class="notification top ani ani_slideInUp"  hidden>            
            <div class="noti noti-bob my-1 ani ani_fadeIn cursor text-center" >
                <div onclick="document.querySelector('#app_install').hidden = true">
                    <i class="bi bi-x noti-close m-1 icon-15 cursor" ></i>
                </div>
                <div class="noti-header noti-hb install-btn" id="install_btn">
                    <span>حمل التطبيق </span>
                    <i class="bi bi-download"></i>
                </div>
            </div>
        </div>
        
    </body>
    @livewireScripts
    <script src="{{asset('js/app.js')}}" ></script>
    <script src="{{asset('js/popper.min.js')}}" defer></script> 
    <script src="{{asset('js/bootstrap.min.js')}}" defer></script>
    
</html>
