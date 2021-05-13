<nav class="navbar navbar-light bg-light h-20 shadow container " >
    <input class="form-control-light" type="search" placeholder="بحث" aria-label="بحث" wire:model.debounce.250ms="query">
    @if(strlen($query) > 0)
        <ol class="search-list w-100 ">
            <div class="search-underline cursor" wire:click="$emit('changeBody','feeds')">$ الرئيسية</div>
            <div class="search-underline cursor" wire:click="$emit('changeBody','items')">$ اغراضي</div>
            <div class="search-divider"></div>
            @forelse ($result as $res)
            <li class="search-underline cursor glow" wire:click="$emit('changeBody',['showitem','{{$res->item_id}}'])">
                {{markWords($res->data,$query)}}   
            </li>                
            @empty
                <small>اكتب شي لندورلك عليه</small>
            @endforelse
        </ol>
    @endif
</nav>
