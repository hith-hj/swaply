@extends('layouts.sapp')

@section('content')

    @livewire('menu')
    <div class="fullPage">
        <div id="center">
            @livewire('search')

            @livewire('body')
            
        </div>
        
        @livewire('footnav')
    </div>
    
@endsection
