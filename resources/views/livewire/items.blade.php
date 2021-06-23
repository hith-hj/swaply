<div>
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" role="alert">
        <h3>منشوراتي</h3>
    </div>
    @forelse ($feeds as $feed)
        <div class="col mt-5px ani ani_fadeIn ani_faster {{$feed->status == 1 ? 'br-success' : ''}}" >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-10 ">
                            <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                        </div>
                        <div class="col-1">
                            <div class="d-inline ">
                                <span class="icon-1 link-dark cursor" id="options" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </span>
                                <ul class="dropdown-menu" aria-labelledby="options">
                                    <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                    @if($feed->status == 0)
                                        <li class="cursor dropdown-item" onclick="document.querySelector('#delete{{$feed->id}}').classList.toggle('hidden')" ><i class="bi bi-trash cr"></i> <small>حذف المنشور</small></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="hidden px-1" id="delete{{$feed->id}}">
                            <hr>
                            <div class="modal-dialog ani ani_fadeIn mx-auto mb-1 mt-1" >
                                <div class="modal-content">
                                    <div class="modal-footer justify-content-center">
                                        <div class="btn-group" >
                                            <button type="button" class="btn btn-outline-danger " wire:click="deleteItem({{$feed->id}})"><i class="bi bi-trash mx-2"></i><small>حذف</small></button> 
                                            <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#delete{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            @if($feed->status ==1)
                                <small class="card-subtitle text-muted mx-1 green_underline"><strong>تم {{$feed->item_type == 1 ? 'التبديل' : ($feed->item_type == 2 ? 'البيع' : 'التبرع')}}</strong></small>
                            @else 
                                <small class="card-subtitle text-muted green_underline" title="نوع المنشور">
                                    <i class="mx-1 bi bi-distribute-horizontal"></i>
                                    <span>{{$feed->item_type == 1 ? 'مبادلة' : ($feed->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                                </small>
                            @endif  
                            @if($feed->item_type == '1')
                                <small class="card-subtitle text-muted " title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted " title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                        </div>
                    </div>  
                    <hr>
                    <div wire:click="$emitTo('body','changeBody',['showitem','{{$feed->id}}'])" data-bs-toggle="tooltip" title="عرض المنشور">
                        <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                        <div style="display: grid;place-items: center">
                            @if($feed->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]))
                                <img class="glow px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" width="100%">
                            @else 
                                <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$feed->item_type}}" >
                            @endif
                        </div>
                        <div class="py-1 {{ file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true ? 'hidden' : ''}}">
                            <small class="green_underline">عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <small class="mx-1"><span> <i class="bi bi-geo-alt"></i> </span> {{$feed->item_location}}</small>|
                            <small class="mx-1"><span> عروض :</span> {{$feed->requests}}</small>|
                            <small class="mx-1">شوهد : <span>{{$feed->views}}</span></small>
                            @if($feed->rates > 0 )
                                | <small class="card-subtitle text-muted"> <i class="bi bi-stars"></i> <span> {{$feed->rates > 10 ? round($feed->rates/5) : $feed->rates}}</span></small>
                            @endif
                            @if($feed->user_id != Auth::id() && $feed->rated == false)
                                | <small onclick="document.querySelector('#rate{{$feed->id}}').classList.toggle('hidden')" class="card-subtitle text-muted cursor">
                                    <i class="bi bi-star "></i> قيم</small>
                                <small id="rate{{$feed->id}}" class="hidden ani ani_fadeIn">
                                    <input wire:model.defer="feed_rate" id="rate1" type="checkbox" value="1" hidden>
                                    <label onclick="rateFeed(event,{{$feed->id}})" for="rate1"> <i id="star_1_{{$feed->id}}" class="bi bi-star"></i></label>
                                    <input wire:model.defer="feed_rate" id="rate2" type="checkbox" value="2" hidden>
                                    <label onclick="rateFeed(event,{{$feed->id}})" for="rate2"> <i id="star_2_{{$feed->id}}" class="bi bi-star"></i></label>
                                    <input wire:model.defer="feed_rate" id="rate3" type="checkbox" value="3" hidden>
                                    <label onclick="rateFeed(event,{{$feed->id}})" for="rate3"> <i id="star_3_{{$feed->id}}" class="bi bi-star"></i></label>
                                    <input wire:model.defer="feed_rate" id="rate4" type="checkbox" value="4" hidden>
                                    <label onclick="rateFeed(event,{{$feed->id}})" for="rate4"> <i id="star_4_{{$feed->id}}" class="bi bi-star"></i></label>
                                    <input wire:model.defer="feed_rate" id="rate5" type="checkbox" value="5" hidden>
                                    <label onclick="rateFeed(event,{{$feed->id}})" for="rate5"> <i id="star_5_{{$feed->id}}" class="bi bi-star"></i></label>
                                    <small wire:click="rateFeed('{{$feed->id}}')" class="btn btn-outline-success"><i class="bi bi-check"></i></small>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                           
            </div>
        </div>
    @empty
        <div class="alert alert-light ani ani_fadeIn p-0 m-0 mt-1 mb-1" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد منشورات لك في الوقت الحالي. </p>
        </div>
    @endforelse
</div>
