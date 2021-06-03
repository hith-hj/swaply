@extends('layouts.sapp')

@section('content')

    
    <div class="fullPage">
        <div id="center">
            @livewire('search')

            @livewire('body',['dest'=>$dest ?? 'feeds'])
            
        </div>
        
        @livewire('footnav')
    </div>
    @livewire('menu')
    
@endsection
