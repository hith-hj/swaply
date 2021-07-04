<div class="w-100">
    
    <div class="card shadow mt-1">
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" role="alert">
        <h3>نتيجة البحث عن ({{$query}}) </h3>
    </div>
        @forelse ($result as $res)        
            <div class="card shadow p-2 mt-1 mb-1 ani ani_slideInUp glow">
                <div class="card-body">
                    <div class="row">            
                        <div class="col-3">
                            <div class="cursor" wire:click="$emit('changeBody',['showitem','{{$res->item_id}}'])" title="عرض المنشور">                                
                                <div class="dark-border d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                    @if($res->info->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$res->info->directory.'/'.$res->info->collection[0]))
                                        @php
                                            $temp = getimagesize( 'assets/items/'.$res->info->directory.'/'.$res->info->collection[0] );
                                            $height = $temp[1] > 720 ? '50%':'100%';
                                        @endphp
                                        <img class="d-block glow px-1" src="{{asset('assets/items/'.$res->info->directory.'/'.$res->info->collection[0])}}" alt="{{$res->info->item_type}}" width="{{$height}}">
                                    @else
                                        <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$res->info->item_type}}" width="50%" >
                                    @endif
                                </div>                    
                            </div>
                        </div>
                        <div class="col-9">
                            <p>{{$res->data}}</p><br>
                            <small> <i class="bi bi-cart-plus"></i> {{$res->info->requests}}</small> |
                            <small> <i class="bi bi-check2-all"></i> {{$res->info->views}}</small> |
                            <small> <i class="bi bi-calendar"></i> {{$res->info->created_at->diffForHumans()}}</small>                            
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <small>اكتب شي لندورلك عليه</small>
        @endforelse
    </div>
</div>
{{-- <li class="search-underline cursor" wire:click="$emit('changeBody',['showitem','{{$res->item_id}}'])">
    <div class="row">
        <div class="col">
            <small>
                @if($res->info->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$res->info->directory.'/'.$res->info->collection[0]))
                    <img class="d-block glow px-1" src="{{asset('assets/items/'.$res->info->directory.'/'.$res->info->collection[0])}}" alt="{{$res->info->item_type}}" width="20%">
                @else
                    <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$res->info->item_type}}" width="8%" >
                @endif
            </small>
            <small>{{markWords($res->data,$query)}} </small>
        </div>
    </div>
</li> --}}