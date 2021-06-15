@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    @include('comps.logo')

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div>
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="form-control-light"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-button class="sbtn w-50 bg-light">
                                {{ __('Confirm') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>

