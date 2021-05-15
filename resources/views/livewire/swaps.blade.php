<div>
    @forelse ($swaps as $swap)
        <div class="col mt-5px ani ani_fadeIn ani_faster">
            <div class="card shadow">
                <div class="card-body" > 
                    <div class="row">
                        <div class="col">
                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>مبادلة</span></small>
                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-calendar-day"></i><span>{{$swap->created_at->diffForHumans()}}</span></small>
                        </div>
                    </div>   
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div wire:click="$emitTo('body','changeBody',['showitem','{{$swap->user_item->id}}'])" title=" عرض {{$swap->user_item->item_title}}">
                                <small class="text-muted"> <i class="bi bi-card-text mx-1"></i> {{$swap->user_item->item_title}} </small>
                                <small class="text-muted"> <i class="bi bi-justify mx-1"></i> <span>
                                    {{-- {{$swap->user_item->item_info}} --}}
                                    {{substr($swap->user_item->item_info,0,strlen($swap->user_item->item_info) < 40? strlen($swap->user_item->item_info): strlen($swap->user_item->item_info)/2)}}...
                                </span></small><hr>
                                <div class="d-flex justify-content-evenly mt-5px" wire:loading.grid >
                                    <img class=" glow" src="{{asset('assets/items/'.$swap->user_item->directory.'/'.$swap->user_item->collection[0])}}" width="180" alt="{{$swap->item_type}}" >
                                </div><hr>
                                <div class="row">
                                    <div class="col">
                                        <small class="card-text"> <i class="bi bi-person"></i> {{$swap->user->name}}</small>
                                        <small class="card-text"> <i class="bi bi-geo"></i> {{$swap->user->location }}</small><br>
                                        <small class="card-text"> <i class="bi bi-phone"></i> {{$swap->user->phone }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div wire:click="$emitTo('body','changeBody',['showitem','{{$swap->sender_item->id}}'])" title=" عرض {{$swap->sender_item->item_title}}">
                                <small class="text-muted"> <i class="bi bi-card-text mx-1"></i> {{$swap->sender_item->item_title}} </small>
                                <small class="text-muted"> <i class="bi bi-justify mx-1"></i> <span>
                                    {{-- {{$swap->sender_item->item_info}} --}}                                    
                                    {{substr($swap->sender_item->item_info,0,strlen($swap->sender_item->item_info) < 40? strlen($swap->sender_item->item_info): strlen($swap->sender_item->item_info)/2)}}...
                                </span></small><hr>
                                <div class="d-flex justify-content-evenly mt-5px" wire:loading.grid >
                                    <img class=" glow" src="{{asset('assets/items/'.$swap->sender_item->directory.'/'.$swap->sender_item->collection[0])}}" width="180" alt="{{$swap->sender_item->item_type}}" >
                                </div><hr>
                                <div class="row">
                                    <div class="col">
                                        <small class="card-text"> <i class="bi bi-person"></i> {{$swap->sender->name}}</small>
                                        <small class="card-text"> <i class="bi bi-geo"></i> {{$swap->sender->location }}</small><br>
                                        <small class="card-text"> <i class="bi bi-phone"></i> {{$swap->sender->phone }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="alert alert-success" role="alert">
                        <div class="row">
                            <div class="col " >
                                <small> عملية التبادل ناجحة</small>
                                <p>شكرا لك لأستخدامك سوابلي في تبديل غرضك /_ ^_^ _\  😍 🙏 💚 💚</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لم تتم اي عملية تبديل الي الان , بالتوفيق</p>
        </div>
    @endforelse
</div>
