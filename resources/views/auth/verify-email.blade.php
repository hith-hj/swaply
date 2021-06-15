@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center h-100">
            <x-guest-layout>
                <x-auth-card>
                    @include('comps.logo')

                    <div class="fs-20 cb">
                        {{ __('Thanks for signing up!') }}
                        {{ __('could you verify your email address.') }}
                        {{ __('Click on the link we just emailed to you?') }}
                        {{ __('If you didn\'t receive the email, we will gladly send you another.') }}
                     </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 cb">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="uk-form-row uk-text-small">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-button class="sbtn w-75 bg-light">
                                    {{ __('Resend Verification Email') }}
                                </x-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="mt-5px">
                            @csrf

                            <button type="submit" class="sbtn w-25 bg-light">
                                {{ __('Log out') }}
                            </button>
                        </form>
                    </div>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
