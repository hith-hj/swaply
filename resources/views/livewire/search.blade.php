<div>
    <nav class="navbar navbar-light bg-light h-20 shadow container ani ani_slideInDown">
        <span id="cir-icon" class="cursor" onclick="toggleCirMenu()">
            <i class="bi bi-list" role="button" tabindex="0" aria-label="Menu"></i>
        </span>
        <input class="form-control-light width-auto" type="search" placeholder=" 🔍 بحث" aria-label="بحث"
         wire:model.debounce.250ms="query">   
    </nav>
    @if(strlen($query) > 0)
        <div class="w-100 ">
            <ol class="search-list">
                <div class="search-underline cursor" wire:click="$emit('changeBody','feeds')">$ الرئيسية</div>
                <div class="search-underline cursor" wire:click="$emit('changeBody','items')">$ اغراضي</div>
                @if(is_countable($result) && count($result) > 0)
                    <div class="search-underline cursor" wire:click="$emit('changeBody',['searchResult','{{$query}}'])">عرض المزيد</div>
                @endif
                <div class="search-divider"></div>
                <div style="max-height: 25vh;overflow: auto;">
                    @forelse ($result as $res)
                    <li class="search-underline cursor" wire:click="$emit('changeBody',['showitem','{{$res->item_id}}'])">
                        <div class="row">
                            <div class="col">
                                <small>
                                    @if($res->info->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$res->info->directory.'/'.$res->info->collection[0]))
                                        <img class="d-block glow px-1" src="{{asset('assets/items/'.$res->info->directory.'/'.$res->info->collection[0])}}" alt="{{$res->info->item_type}}" width="8%">
                                    @else
                                        <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$res->info->item_type}}" width="8%" >
                                    @endif
                                </small>
                                <small>{{markWords($res->data,$query)}} </small>
                            </div>
                        </div>
                    </li>
                    @empty
                        <small>اكتب شي لندورلك عليه</small>
                    @endforelse
                </div>
            </ol>
        </div>
    @endif
</div>
