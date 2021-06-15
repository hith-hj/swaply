@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    @include('comps.logo')

                    <div style="max-height: 60vh; min-height:50vh;overflow: auto;">
                        <x-auth-validation-errors class="mb-2 danger" :errors="$errors" />

                        <form method="POST" action="{{ route('register') }}" class="form-group">
                            @csrf

                            <div class="mt-2">
                                <x-label for="name" :value="__('اسم المستخدم')" />
                                <x-input class="mt-2 form-control-light " id="name" type="text" name="name" :value="old('name')" placeholder="استخدم الأسم في تسجيل الدخول" required autofocus autocomplete="name"/>
                            </div>

                            {{-- <div class="mt-2" >
                                <x-label for="name" :value="__('البريد الالكتروني')" />
                                <x-input class="mt-2 form-control-light" id="email" type="text" inputmode="email" name="email" :value="old('email')" required autocomplete="email"/>
                            </div> --}}

                            <div class="mt-2" >
                                <x-label for="name" :value="__('كلمة المرور')" />
                                <x-input class="mt-2 form-control-light " id="password" type="password" name="password" required autocomplete="new-password"/>
                            </div>

                           {{-- <div class=" mt-5px" >
                                <x-input class="form-control-light" id="password_confirmation" placeholder="{{__('تاكيد كلمة المرور')}}" type="password" autocomplete="password_confirmation"
                                                name="password_confirmation" required />
                            </div> --}}

                            <div class="mt-3">
                                <x-button class="w-100">
                                    {{ __('اشتراك') }}
                                </x-button>
                            </div>

                            <a class="cb sbtn sbtn-txt mt-2" href="{{ route('login') }}">
                                {{ __('لدي حساب') }}
                            </a>
                        </form>
                    </div>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
@endsection


            {{-- <form class="uk-panel uk-panel-box uk-form">
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Username">
                </div>
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-form-large" type="email" placeholder="Email">
                </div>
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-form-large" type="tel" placeholder="Phone number">
                </div>
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-form-large" type="password" placeholder="Password">
                </div>
                <div class="uk-form-row mt-5px">
                    <a class="uk-width-1-1 uk-button uk-button-primary uk-button-large" href="#">start</a>
                </div>
                <div class="uk-form-row uk-text-small mt-5px">
                    <a class="uk-float-center uk-link uk-link-muted" href="login.html">Sing in</a>
                </div>
            </form> --}}
