<div id="feedsBody">
    @forelse ($feeds as $feed)
        <div class="col mt-5px ani ani_fadeIn ani_faster" wire:key="{{$feed->id}}" >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row mb-2">
                        <div class="col">
                            <small class="card-subtitle text-muted  green_underline" title="نوع المنشور">
                                <i class="mx-1 bi bi-distribute-horizontal"></i>
                                <span>{{$feed->item_type == 1 ? 'مبادلة' : ($feed->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                            </small>
                            @if($feed->item_type == 1)
                                <small class="card-subtitle text-muted " title="بديل الغرض">
                                    <i class="mx-1 bi bi-arrow-down-up"></i>
                                    <span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span>
                                </small>
                            @endif
                            <small class="card-subtitle text-muted " title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            @if($feed->amount > 0)
                                <small class="card-subtitle text-muted mt-1" title="الفرق"><i class="mx-1 bi bi-cash"></i><span>{{$feed->amount}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted "> <i class=" mx-1 bi bi-images"></i> {{ count($feed->collection)}} </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3" style="padding-left:0;">
                            <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$feed->id}}'])" title="عرض المنشور">                                
                                <div class="d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                    @if($feed->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) )
                                        <img class=" dark-border px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" width="100%" >
                                    @else 
                                        <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$feed->item_type}}" width="100%" >
                                    @endif
                                </div>                    
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-10 ">
                                    <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                                </div>
                                <div class="col-1 mr-1">
                                    <div class="d-inline ">
                                        @if($feed->user_id != Auth::user()->id) 
                                            <span class="icon-1 link-dark cursor" id="options{{$loop->index}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </span>
                                            <ul class="dropdown-menu "  aria-labelledby="options">
                                                <li class="cursor dropdown-item" wire:click="savePost('{{$feed->id}}','{{$feed->user_id}}')"><i class="bi bi-save"></i> <span>حفظ</span></li>
                                                <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                                <li class="cursor dropdown-item mb-0" onclick="
                                                document.querySelector(`#report_modal{{$feed->id}}`).classList.toggle('hidden');
                                                "><i class="bi bi-flag cr"></i> <span>تبليغ المنشور</span></li>
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
                        </div>
                        <div class="py-1 {{ file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true ? 'hidden' : ''}}">
                            <small class="green_underline" >عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                        </div> 
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                                <small class="mx-1"><span> <i class="bi bi-geo-alt"></i></span> {{$feed->item_location}}</small>|
                                <small class="mx-1"><span> <i class="bi bi-cart-plus"></i></span> {{$feed->requests}}</small>|
                                <small class="mx-1"> <i class="bi bi-check2-all mx-1"></i> <span> {{$feed->views}}</span></small>
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
                    <div class="modal-footer justify-content-center">
                        
                        <button type="button" class="sbtn sbtn-txt mx-1" wire:click="report('{{$feed->id}}','{{$feed->user_id}}')"><span>ارسال</span></button>
                        <button type="button" class="sbtn sbtn-txt mx-3" data-bs-dismiss="modal" wire:click="resetReport()"><span>أغلاق</span></button>
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
        <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد منشورات في الوقت الحالي ,الرجاء المحاولة لاحقا. </p>
        </div>
    @endforelse
</div>