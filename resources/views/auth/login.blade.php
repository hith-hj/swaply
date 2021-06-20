@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    @include('comps.logo')
                        
                    <x-auth-session-status class="mb-2" :status="session('status')" />
                    <x-auth-validation-errors class="mb-2 danger" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}" class="form-group">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="name" :value="__('اسم المستخدم')" />

                            <x-input id="name" class="form-control-light w-50 m-auto" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-1">
                            <x-label for="password" :value="__('كلمة المرور')" />

                            <x-input id="password" class="form-control-light w-50 m-auto"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                        </div>

                        <div class="form-row text-small mt-2">
                            <x-button id="loginBtn" class="rounded bg-light sbtn-txt w-50">
                                {{ __('دخول') }}
                            </x-button>
                        </div>

                        <div class="row text-small mt-2 col-6 m-auto">
                            <label for="remember_me" class="float-left col-6 sbtn-txt">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded shadow-sm" onclick="rememberMe()">
                                <span class="ml-2 text-sm text-gray-600 cb">{{ __('تذكرني') }}</span>
                            </label>

                            {{-- @if(Route::has('password.request'))
                                <a class="float-right link-dark col-sm sbtn-txt" href="{{ route('password.request') }}">
                                    {{ __('نسيت كلمة المرور؟') }}
                                </a>
                            @endif --}}

                            <a class="float-center link-dark col-6 sbtn-txt"  href="{{ route('register') }}">
                                {{ __('اشتراك') }}
                            </a>

                        </div>

                        
                    </form>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
@endsection


