<div id="feedsBody">
    @forelse ($feeds as $feed)
        <div class="col mt-5px ani ani_fadeIn ani_faster " >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-10 ">
                            <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                        </div>
                        <div class="col-1 mr-1">
                            <div class="d-inline ">
                                @if($feed->user_id != Auth::user()->id) 
                                    <span class="icon-1 link-dark " id="options{{$loop->index}}" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <div class="row">
                        <div class="col">
                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$feed->item_type == 1 ? 'مبادلة' : 'تبرع'}}</span></small>
                            @if($feed->item_type != 2)
                                <small class="card-subtitle text-muted m-0" title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            <small class="card-subtitle text-muted m-0"> <i class=" mx-1 bi bi-images"></i> {{ count($feed->collection)}} </small>
                        </div>
                    </div>   
                    <hr>
                    <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$feed->id}}'])" title="عرض المنشور">
                        <small class="card-text"><span>
                            {{substr($feed->item_info,0,strlen($feed->item_info) < 70 ? strlen($feed->item_info): strlen($feed->item_info)/2)}}...
                        </span></small><br>
                        
                        <div class="d-flex justify-content-evenly mt-2" >
                            @if($feed->collection[0] != 'dark-logo.png')
                                <img class="d-block glow px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                            @else 
                                <img class="glow px-1" src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                                <small class="mx-1"><span> المكان :</span> {{$feed->item_location}}</small>|
                                <small class="mx-1"><span> عروض :</span> {{$feed->requests}}</small>|
                                <small class="mx-1">شوهد : <span>{{$feed->views}}</span></small>
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
                    @if($feed->item_type == 1)
                        <div class="card-footer text-center ">    
                            <button class="sbtn sbtn-txt bg-white w-50 mb-1 mt-1" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><span>ارسل عرض</span></button>
                            <div class="modal-dialog hidden mx-auto mb-1 mt-0 ani ani_fadeIn" id="offer{{$feed->id}}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="bi bi-box "></i> <span> تقديم عرض</span></h5>
                                        <i data-bs-dismiss="modal" aria-label="Close" class="bi bi-x" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"></i>
                                    </div>
                                    <div class="modal-body">
                                        @if(count($feed->user_item) > 0)
                                        <label for="" class="form-label">اختر غرضك للتبديل</label>
                                        <select class="form-select bg-gray" wire:model.defer="req_item">
                                            <option value="null" ></option>
                                            @foreach ($feed->user_item as $myitem)
                                                <option value="{{$myitem->id}}" >{{$myitem->item_title}}</option>
                                            @endforeach
                                        </select>
                                        @else 
                                            <label for="" class="form-label">الرجاء اضافة غرض قبل ارسال الطلب</label>
                                        @endif
                                    </div>
                                    <div class="modal-footer justify-content-center {{count($feed->user_item) <= 0 ? 'hidden' : ''}}">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-success " wire:click="sendOffer('{{$feed->id}}','{{$feed->user_id}}','{{$feed->item_type}}')"><i class="bi bi-cloud-upload mx-2"></i><small>ارسال</small></button> 
                                            <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="card-footer text-center ">    
                            <button class="sbtn sbtn-txt bg-white w-50 mb-1 mt-1" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><span>أطلب</span></button>  
                            <div class="modal-dialog hidden mx-auto mb-1 mt-0 ani ani_fadeIn" id="offer{{$feed->id}}">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <label for="">سبب الطلب</label>
                                        <textarea id="" rows="3" maxlength="170" class="form-control" wire:model.defer="req_item"></textarea>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-success " wire:click="sendOffer('{{$feed->id}}','{{$feed->user_id}}','{{$feed->item_type}}')"><i class="bi bi-cloud-upload mx-2"></i><small>ارسال</small></button> 
                                            <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>   
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    @endif
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