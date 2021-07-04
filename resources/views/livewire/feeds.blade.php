<div id="feedsBody">
    @forelse ($feeds as $feed)
        <div class="col mb-2 {{$loop->first ? 'mt-1':''}} ani ani_fadeIn ani_faster" wire:key="{{$feed->id}}" >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row mb-2">
                        <div class="col">
                            <small class="green_underline mx-1" title="نوع المنشور">
                                <i class="bi bi-distribute-horizontal"></i>
                                <span>{{$feed->item_type == 1 ? 'مبادلة' : ($feed->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                            </small> |
                            @if($feed->item_type == 1)
                                <small class="mx-1" title="بديل الغرض">
                                    <i class="bi bi-arrow-down-up"></i>
                                    <span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span> 
                                </small> |
                            @endif
                            <small class="mx-1" title="تاريخ النشر"><i class="bi bi-calendar-day"></i>
                                <span>{{$feed->created_at->diffForHumans()}}</span>
                            </small> 
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-3" style="padding-left:0;">
                            <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$feed->id}}'])" title="عرض المنشور">                                
                                <div class="dark-border d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                    @if($feed->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) )
                                        @php
                                            $temp = getimagesize( 'assets/items/'.$feed->directory.'/'.$feed->collection[0] );
                                            $height = $temp[1] > 720 ? '45%':'100%';
                                        @endphp
                                        <img src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" width="{{$height}}}" height="64px">
                                    @else 
                                        <img class="glow" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$feed->item_title}}" width="100%" height="64px" >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-10 ">
                                    <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                                </div>
                                <div class="col-2 text-left">
                                    <div class="d-inline ">
                                        @if($feed->user_id != Auth::user()->id) 
                                            <span class="icon-1 link-dark cursor" id="options{{$loop->index}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </span>
                                            <ul class="dropdown-menu "  aria-labelledby="options">
                                                <li class="cursor dropdown-item" wire:click="savePost('{{$feed->id}}','{{$feed->user_id}}')"><i class="bi bi-save"></i> <span>حفظ</span></li>                                                
                                                <li class="cursor dropdown-item" onclick="sharePost('{{$feed->id}}','{{$feed->item_title}}')"><i class="bi bi-share"></i> مشاركة</li>
                                                <li class="cursor dropdown-item mb-0" onclick="document.querySelector(`#report_modal{{$feed->id}}`).classList.toggle('hidden');">
                                                    <i class="bi bi-flag cr"></i> <span>تبليغ المنشور</span>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <small class="card-text">
                                <span>
                                    {{substr($feed->item_info,0,strlen($feed->item_info) < 70 ? strlen($feed->item_info): strlen($feed->item_info)/2)}}...
                                </span>
                            </small>
                            <br>
                            <small class=""><span> <i class="bi bi-geo-alt"></i></span> {{$feed->item_location}}</small> |
                            <small class="card-subtitle text-muted"> <i class="bi bi-images"></i> {{ count($feed->collection)}} </small>
                        </div>
                        <div class="py-1 {{ file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true ? 'hidden' : ''}}">
                            <small class="green_underline" >عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                        </div> 
                    </div>
                    <hr>

                    <div class="row mx-1">
                        <div class="col p-0"> 
                            <small class="card-subtitle text-muted"> <i class="bi bi-check2-all"></i> <span> {{$feed->views}}</span></small> |
                            <small class="card-subtitle text-muted"><span> <i class="bi bi-cart-plus"></i></span> {{$feed->requests}}</small>                         
                            @if($feed->amount > 0)
                                | <small class="card-subtitle text-muted mt-1" title="الفرق"><i class="bi bi-cash"></i> <span>{{$feed->amount}}</span></small>
                            @endif
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

                <div id="report_modal{{$feed->id}}" class="hidden w-95 mx-auto mt-0 z-100">
                    <hr>
                    <div class="modal-body">
                        <label for="" class="form-label">نوع الاساءة</label>
                        <input type="text" wire:model.defer="repo.type" list="reportsType" class="form-control">
                        <datalist id="reportsType">
                                <option value="منشور وهمي">
                                <option value="منشور مسيء">
                                <option value="منشور غير مفهوم">
                        </datalist>
                        <label for="" class="form-label">وضح لنا الأساءة</label>
                        <textarea class="form-control my-1" wrap="hard" wire:model.defer="repo.info" rows="2"></textarea>
                    </div>
                    <div class="modal-footer justify-content-center btn-group">                        
                        <button type="button" class="btn btn-outline-danger " wire:click="report('{{$feed->id}}','{{$feed->user_id}}')"><span>ارسال</span></button>
                        <button type="button" class="btn btn-outline-dark " data-bs-dismiss="modal" wire:click="resetReport()"><span>أغلاق</span></button>
                    </div>
                </div>
                
                <div id="share{{$feed->id}}" class="hidden w-100">
                    <div class="modal-body text-center">
                        <small class="sbtn sbtn-txt" onclick="document.querySelector('#share{{$feed->id}}').classList.toggle('hidden')">إغلاق</small><br>                     
                        <small class="cursor mx-2" wire:click="$emit('copyUrl',['{{$feed->id}}'])">
                            <i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span>
                        </small>                       
                    </div>
                </div>

                @if(Auth::user()->id != $feed->user_id)
                    @switch($feed->item_type)
                        @case('1')
                                @livewire('reqs.swap', ['feed' => $feed], key($feed->id))
                            @break
                        @case('2')
                                @livewire('reqs.trade', ['feed' => $feed], key($feed->id))
                            @break
                        @case('3')
                                @livewire('reqs.donate', ['feed' => $feed], key($feed->id))
                            @break                    
                    @endswitch
                @endif            
            </div>
        </div>
    @empty
        <div class="alert alert-light ani ani_slideInUp p-0 m-0 mt-1 mb-1" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد منشورات في الوقت الحالي ,الرجاء المحاولة لاحقا. </p>
        </div>
    @endforelse
</div>