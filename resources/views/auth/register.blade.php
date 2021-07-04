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

                            <div class="mt-2" >
                                <x-label for="name" :value="__('كلمة المرور')" />
                                <x-input class="mt-2 form-control-light " id="password" type="password" name="password" required autocomplete="new-password"/>
                            </div>

                            <div class="mt-3">
                                <x-button class="w-100">
                                    {{ __('اشتراك') }}
                                </x-button>
                            </div>

                            <a class="btn btn-outline-dark mt-2" href="{{ route('login') }}">
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

