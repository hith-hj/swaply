@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center mt-5 py-5">
            <x-guest-layout>
                <x-auth-card>
                        
                    {{session()->get('errors')}}
                    {{-- {{dd(session()->get('attemps'))}} --}}

                    <form method="POST" action="{{ route('admin.check') }}" class="form-group">
                        @csrf
                        <div class="mt-1">
                            <x-label for="password" :value="__('Your Admin Password')" />

                            <x-input id="password" class="form-control-light w-50 m-auto"
                                            type="password"
                                            name="password"
                                            required
                                            oninput="
                                            console.log(this.value.length)
                                            if(this.value.length >= 8) {
                                                document.querySelector('#loginBtn').disabled = false;
                                            }else{
                                                document.querySelector('#loginBtn').disabled = true;
                                            }" />
                        </div>
                        <input type="hidden" name="attemps" value="{{old('attemps')}}" >
                        <div class="form-row text-small mt-2">
                            <x-button id="loginBtn" class="rounded bg-light sbtn-txt w-50" disabled>
                                {{ __('Submit') }}
                            </x-button>
                        </div>                        
                    </form>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
@endsection


