@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    @include('comps.logo')

                    <div class="mb-4 text-sm text-gray-600 cb fs-20">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.email') }}" class="uk-panel uk-panel-box uk-form">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="form-control-light" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-5px">
                            <x-button class="uk-button uk-button-primary">
                                {{ __('Email Password Reset Link') }}
                            </x-button>
                        </div>
                    </form>
                    <a href="{{route('login')}}"><button class="sbtn sbtn-txt w-25" >
                        {{ __('login') }}
                    </button></a>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
