<div>
    @if (empty($feed) && count($feed) <= 0 )
        <div class="alert alert-light mt-5px ani ani_fadeIn" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>من الممكن ان يكون قد تم حذف او ازالة المنشور </p><br>
        </div>
    @else
        <div class="col mt-5px ani ani_fadeIn " >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-10 ">
                            <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                        </div>
                        <div class="col-1 mr-1">
                            <div class="d-inline ">
                                <span class="icon-1 link-dark cursor" id="options" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </span>
                                <ul class="dropdown-menu" aria-labelledby="options">
                                    @if($feed->user_id != Auth::user()->id)
                                        <li class="cursor dropdown-item" wire:click="savePost('{{$feed->id}}')"><i class="bi bi-save"></i> <span>حفظ</span></li>
                                        <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                        <li class="cursor dropdown-item" onclick="toggleReportForm(event , {{$feed->id}})"><i class="bi bi-flag cr"></i> <span>تبليغ إساءة</span></li>
                                    @else 
                                        <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                        <li class="cursor dropdown-item" onclick="document.querySelector('#edit{{$feed->id}}').classList.toggle('hidden')" ><i class="bi bi-pencil-square"></i> <small> تعديل المنشور</small></li>
                                        <li class="cursor dropdown-item" onclick="document.querySelector('#delete{{$feed->id}}').classList.toggle('hidden')" ><i class="bi bi-trash cr"></i> <small>حذف المنشور</small></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$feed->item_type == 1 ? 'مبادلة'  :'تبرع' }}</span></small>
                            @if($feed->item_type == 1)
                                <small class="card-subtitle text-muted m-0" title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            <small class="card-subtitle text-muted m-0"> <i class="mx-1 bi bi-images"></i> {{ count($feed->collection)}} </small>
                        </div>
                    </div>  
                    <hr>
                    <div title="معرض الصور">
                        <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                        <div id="carouselExampleControls" class="carousel slide text-center carousel-fade" data-bs-ride="carousel" >
                            <div class="carousel-inner" onclick="document.querySelector('#showItemImages').classList.toggle('hidden')">
                                <div class="carousel-item px-2 py-1 active ani ani_fadeIn1 ani_slow">
                                    @if($feed->collection[0] != 'dark-logo.png')
                                        <img class="glow px-1 " src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" >
                                    @else 
                                        <img class="glow px-1 " src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" >
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <small class="mx-1"><span> المكان :</span> {{$feed->item_location}}</small>|
                            @if($feed->status != 1)
                                <small class="mx-1"><span> عروض :</span> {{$feed->requestsCount}}</small>|
                            @endif
                            <small class="mx-1">شوهد : <span>{{$feed->views}}</span></small>
                        </div>
                    </div>
                </div>
                <div class="hidden px-1" id="edit{{$feed->id}}">
                    <hr>
                    <div class="modal-dialog ani ani_fadeIn mx-auto mb-1 mt-1">
                        <div class="modal-content p-1">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label class="form-label">اسم الغرض</label>
                                    <input wire:model.defer="editedFeed.item_title" class="form-control" type="text" placeholder="{{$feed->item_title}}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">معلومات الغرض</label>
                                    <input wire:model.defer="editedFeed.item_info" class="form-control" type="text" placeholder="{{$feed->item_info}}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">مكان الغرض</label>
                                    <input wire:model.defer="editedFeed.item_location" class="form-control" type="text" placeholder="{{$feed->item_location}}">
                                </div>
                                <div class="col-6">                                    
                                    <label class="form-label">هتبدلو بايه</label>
                                    <input wire:model.defer="editedFeed.swap_with" class="form-control" type="text" placeholder="{{$feed->swap_with}}">
                                </div>                          
                            </div>
                            <div class="modal-footer justify-content-center">
                                <div class="btn-group" >
                                    <button type="button" class="btn btn-outline-success " wire:click="editItem({{$feed->id}})"><i class="bi bi-cloud-upload mx-2"></i><small>تعديل</small></button> 
                                    <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#edit{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>   
                                </div>
                            </div>
                        </div>
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

                <div id="showItemImages" class="hidden smodal ani ani_fadeIn" style="background: #e1eee0fb;z-index:12; ">
                    <div class="ani ani_fadeIn p-2 w-100">
                        <div id="showFullImage" class="carousel slide text-center carousel-fade" data-bs-ride="carousel" >
                            <i class="bi bi-x close-gallery cursor" onclick="document.querySelector('#showItemImages').classList.add('hidden')"></i>
                            <div class="carousel-inner ">
                                @foreach ($feed->collection as $img)                                  
                                    <div class="carousel-item px-2 py-1 {{ $loop->first ? "active" :''}} ani ani_fadeIn1 ani_slow text-center">
                                        @if($feed->collection[0] != 'dark-logo.png')
                                            <img class="glow px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$img)}}" alt="{{$feed->item_title}}" >
                                        @else 
                                            <img class="glow px-1" src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" >
                                        @endif
                                        <br>
                                        <br>
                                        <span class="h4 text-muted">{{$loop->index + 1}}</span>
                                    </div>                                                                                                                                     
                                @endforeach
                            </div>                            
                        </div>
                        @if(count($feed->collection) > 1)
                               <div class="text-center">
                                    <button class="sbtn sbtn-txt carousel-control-prevz mx-3" type="button" data-bs-target="#showFullImage" data-bs-slide="next">
                                        <span aria-hidden="true"><i class="bi bi-chevron-right icon-2 cb"></i></span>
                                        <span class="visually-hidden"></span>
                                    </button>
                                    <button class="sbtn sbtn-txt carousel-control-nextz mx-3" type="button" data-bs-target="#showFullImage" data-bs-slide="prev">
                                        <span aria-hidden="true"><i class="bi bi-chevron-left icon-2 cb"></i></span>
                                        <span class="visually-hidden"></span>
                                    </button>
                                </div> 
                        @endif
                    </div>
                </div>

                @if($feed->status == 1 )
                    @if($feed->user_id == Auth::id() && count($feed->requests) > 0)
                        <div class="card-footer text-centerz">
                            <div class="alert alert-success" role="alert">
                                <div class="row">
                                    <div class="col " >
                                        <small> عملية التبادل ناجحة</small>
                                        <small class="p-1">البديل
                                            <strong class="cursor" wire:click="$emit('changeBody',['showitem','{{$feed->sender_item->id}}'])">{{$feed->sender_item->item_title}}</strong>
                                        </small>
                                    </div>
                                </div>
                                <small> <span>معلومات التواصل</span></small>
                                <small> <i class="bi bi-person"></i><span> {{$feed->sender->name}} </span> </small> <br>   
                                <small> <a href="tel:+2{{$feed->sender->phone}}"><i class="bi bi-phone"></i><span> {{$feed->sender->phone}}</span></a></small> <br>
                                <small><a href="whatsapp://send?phone=+{{$feed->sender->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                            </div>
                        </div>
                    @else 
                        <div class="card-footer text-centerz">
                            <div class="alert alert-info" role="alert">
                                <p>لقد تم تبديل هذا المنشور و سوف تتم ازالته بالوقت القريب</p>         
                            </div> 
                        </div>
                    @endif
                @else
                    @if($feed->user_id == Auth::id())
                        @if(count($feed->requests) > 0 )
                            <div class="card-footer text-centerz">
                                <div class="modal-dialog ani ani_fadeIn mx-auto mb-1 mt-1">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            @if ($feed->item_type == 2)
                                                @foreach ($feed->requests as $req)
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="m-0">{{$req->sender->name}}</h6>
                                                            <small class="card-subtitle text-muted m-0">{{$req->created_at->diffForHumans()}}</small>
                                                        </div>
                                                        <div class="col btn-group" >
                                                            <button type="button" class="btn btn-outline-success btn-sm" title="قبول الطلب"><i class="bi bi-check ml-1"></i><span>قبول</span></button>
                                                        </div>
                                                    </div>                                                
                                                @endforeach
                                            @else
                                                @foreach ($feed->requests as $req)
                                                    <div class="row">    
                                                        <div class="col-8">
                                                            <div class="cursor" wire:click="$emit('changeBody',['showitem',{{$req->sender_item->id}}])" title="عرض المنشور">
                                                                <p ><strong>{{$req->sender_item->item_title}}</strong></p>
                                                                <small><span>{{$req->created_at->diffForHumans()}}</span></small>
                                                                <p class="text-muted m-0"><span>{{$req->sender_item->item_info}}</span></p>
                                                            </div>
                                                            <small class="btn btn-outline-success w-100 mt-1" wire:click="acceptRequest('{{$req->id}}','{{$req->user_id}}','{{$req->sender_id}}','{{$req->item_id}}','{{$req->sender_item->id}}')"> <i class="bi bi-check"></i> قبول</small>  
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <img src="{{asset('assets/items/'.$req->sender_item->directory.'/'.$req->sender_item->collection[0])}}" alt="" width="55" height1="60" class="glow">
                                                        </div>                                          
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else  
                            <div class="card-footer text-center">
                                <p>لايوجد عروض الى الأن</p>
                            </div>
                        @endif
                    @else 
                        @if($feed->requested != true)
                            <div class="card-footer text-center">    
                                <button class="sbtn sbtn-txt bg-white w-50 p-1" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><span>ارسل <i class="bi bi-cloud-upload"></i></span></button>  
                                <div class="modal-dialog ani ani_fadeIn hidden mx-auto mb-1 mt-1" id="offer{{$feed->id}}">
                                    @if($feed->item_type == 2)
                                        <div class="modal-content">
                                            <div class="modal-footer justify-content-center">
                                                <div class="btn-group" >
                                                    <button type="button" class="btn btn-outline-success " wire:click="sendOffer({{$feed->id}},'{{$feed->user_id}}')"><i class="bi bi-cloud-upload mx-2"></i><small>ارسال</small></button> 
                                                    <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>   
                                                </div>
                                            </div>
                                        </div>
                                    @else 
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> <i class="bi bi-box "></i> <span> تقديم عرض</span></h5>
                                                <i data-bs-dismiss="modal" aria-label="Close" class="bi bi-x" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"></i>
                                            </div>
                                            <div class="modal-body">
                                                <label for="" class="form-label">اختر غرضك للتبديل</label>
                                                <select class="form-select bg-gray" wire:model.defer="req_item">
                                                    <option value="null">اختر</option>
                                                    @foreach ($feed->user_items as $myitem)
                                                        <option value="{{$myitem->id}}" >{{$myitem->item_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <div class="btn-group" >
                                                    <button type="button" class="btn btn-outline-success " wire:click="sendOffer({{$feed->id}},'{{$feed->user_id}}','{{$feed->item_type}}')"><i class="bi bi-cloud-upload mx-2"></i><small>ارسال</small></button> 
                                                    <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-x mx-2"></i><small>أغلاق</small></button>   
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else 
                            <div class="card-footer text-centerz">
                                <div class="alert alert-info" role="alert">
                                    <p>ارسلت عرض لهذا الغرض</p>
                                </div> 
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    @endif
</div>
