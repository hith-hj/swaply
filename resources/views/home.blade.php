@extends('layouts.sapp')

@section('content')

    <div class="fullPage">
        <div id="center">
            @livewire('search')

            @livewire('body')
            
        </div>
        
        @livewire('footnav')
    </div>
    {{-- @include('comps.menu') --}}
    @livewire('menu')
    {{--  --}}
    
@endsection
