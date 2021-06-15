<div>
    <div class="alert alert-light mt-5px ani ani_slideInDown" role="alert">
        <h3>مبادلاتي</h3>
        <p>عمليات التبادل الناجحة</p>
    </div>
    @forelse ($swaps as $swap)
        <div class="col mt-5px ani ani_fadeIn ani_faster">
            <div class="card shadow">
                <div class="card-body mx-2" > 
                    
                    @if($swap->sender_item != 'donate' && $swap->sender_item != 'trade')
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-title m-0"> <span>{{$swap->sender_item->item_title}}</span> </h5>
                                    </div>                            
                                </div>
                                <small class="card-text">
                                    <span>
                                        {{substr($swap->sender_item->item_info,0,strlen($swap->sender_item->item_info) < 70 ? strlen($swap->sender_item->item_info): strlen($swap->sender_item->item_info)/2)}}...
                                    </span>
                                </small>
                                <br>
                                <small class=""><span> <i class="bi bi-geo-alt"></i></span> {{$swap->sender_item->item_location}}</small>
                            </div>
                            <div class="col-3" style="padding-left:0;">
                                <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$swap->sender_item->id}}'])" title="عرض المنشور">                                
                                    <div class="d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                        @if($swap->sender_item->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$swap->sender_item->directory.'/'.$swap->sender_item->collection[0]) )
                                            <img class=" dark-border px-1" src="{{asset('assets/items/'.$swap->sender_item->directory.'/'.$swap->sender_item->collection[0])}}" alt="{{$swap->sender_item->item_type}}" width="100%" height="64px">
                                        @else 
                                            <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$swap->sender_item->item_type}}" width="100%" height="64px" >
                                        @endif
                                    </div>                    
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-10 mx-2">
                                <h5 class="card-title m-0"> <span>{{$swap->sender_item == 'trade' ? 'شراء':'طلب'}}</span> </h5>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3" style="padding-lef:0;">
                            <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$swap->user_item->id}}'])" title="عرض المنشور">                                
                                <div class="d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                    @if($swap->user_item->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$swap->user_item->directory.'/'.$swap->user_item->collection[0]) )
                                        <img class=" dark-border px-1" src="{{asset('assets/items/'.$swap->user_item->directory.'/'.$swap->user_item->collection[0])}}" alt="{{$swap->user_item->item_type}}" width="100%" height="64px">
                                    @else 
                                        <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$swap->user_item->item_type}}" width="100%" height="64px" >
                                    @endif
                                </div>                    
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title m-0"> <span>{{$swap->user_item->item_title}}</span> </h5>
                                </div>                            
                            </div>
                            <small class="card-text">
                                <span>
                                    {{substr($swap->user_item->item_info,0,strlen($swap->user_item->item_info) < 70 ? strlen($swap->user_item->item_info): strlen($swap->user_item->item_info)/2)}}...
                                </span>
                            </small>
                            <br>
                            <small class=""><span> <i class="bi bi-geo-alt"></i></span> {{$swap->user_item->item_location}}</small>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="alert alert-success" role="alert">
                        <div class="row">
                            <div class="col-12">
                                <small> عملية ناجحة</small>
                                <p>شكرا لك لأستخدامك سوابلي <br>💚/_ (^_^) _\💚</p>
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