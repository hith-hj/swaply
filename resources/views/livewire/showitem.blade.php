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
                                @if($feed->status == 0)
                                    <span class="icon-1 link-dark cursor" id="options" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="options">
                                        @if($feed->user_id != Auth::user()->id)
                                            <li class="cursor dropdown-item" wire:click="savePost('{{$feed->id}}')"><i class="bi bi-save"></i> <span>حفظ</span></li>
                                            <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                            <li class="cursor dropdown-item" onclick="document.querySelector('#report{{$feed->id}}').classList.toggle('hidden')"><i class="bi bi-flag cr"></i> <span>تبليغ إساءة</span></li>
                                        @else 
                                            <li class="cursor dropdown-item" wire:click="$emit('copyUrl',['{{$feed->id}}'])"><i class="bi bi-clipboard-plus"></i> <span>نسخ الرابط</span></li>
                                            @if($feed->status == 0)
                                                <li class="cursor dropdown-item" onclick="document.querySelector('#edit{{$feed->id}}').classList.toggle('hidden')" ><i class="bi bi-pencil-square"></i> <small> تعديل المنشور</small></li>
                                                <li class="cursor dropdown-item" onclick="document.querySelector('#delete{{$feed->id}}').classList.toggle('hidden')" ><i class="bi bi-trash cr"></i> <small>حذف المنشور</small></li>
                                            @endif
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            @if($feed->status ==1)
                                <small class="card-subtitle text-muted mx-1 green_underline"><strong>تم التبديل</strong></small>
                            @endif
                            <small class="card-subtitle text-muted green_underline" title="نوع المنشور">
                                <i class="mx-1 bi bi-distribute-horizontal"></i>
                                <span>{{$feed->item_type == 1 ? 'مبادلة' : ($feed->item_type == 2 ? 'بيع' : 'تبرع')}}</span></small>
                            @if($feed->item_type == 1)
                                <small class="card-subtitle text-muted " title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted " title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            @if($feed->amount > 0)
                                <small class="card-subtitle text-muted " title="الفرق"><i class="mx-1 bi bi-cash"></i><span>{{$feed->amount}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted "> <i class="mx-1 bi bi-images"></i> {{ count($feed->collection)}} </small>
                        </div>
                    </div>  
                    <hr>

                    <div title="معرض الصور">
                        <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                        <div id="carouselExampleControls" class="carousel slide text-center carousel-fade" data-bs-ride="carousel" >
                            @if(file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true )
                                <div class="carousel-inner" onclick="document.querySelector('#showItemImages').classList.toggle('hidden')">
                            @else 
                                <div class="carousel-inner">
                            @endif
                                    <div class="carousel-item px-1 py-1 active ani ani_fadeIn1 ani_slow">
                                        @if($feed->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]))
                                            <img class="glow" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" width="100%">
                                        @else 
                                            <img class="glow" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$feed->item_title}}" width="100%">
                                        @endif
                                    </div>                                
                                </div>
                                <div class="py-1 {{ file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true ? 'hidden' : ''}}">
                                    <small class="green_underline">عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <small class="mx-1"><span> <i class="bi bi-geo-alt"></i> </span> {{$feed->item_location}}</small>|
                                @if($feed->status != 1)
                                    <small class="mx-1"><span> عروض :</span> {{$feed->requestsCount}}</small>|
                                @endif
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
                                    @if($feed->item_type == 1)
                                        <div class="col-6">                                    
                                            <label class="form-label">هتبدلو بايه</label>
                                            <input wire:model.defer="editedFeed.swap_with" class="form-control" type="text" placeholder="{{$feed->swap_with}}">
                                        </div>
                                    @endif                         
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

                    <div id="report{{$feed->id}}" class="hidden w-95 mx-auto mt-0 z-100">
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

                    <div id="showItemImages" class="hidden smodal ani ani_fadeIn text-center" style="background: #373736fa;z-index:12; ">
                        <div class="ani ani_fadeIn p-1 w-100">
                            <div id="showFullImage" class="carousel slide text-center carousel-fade" data-bs-ride="carousel" >
                                <i class="bi bi-x close-gallery cursor" onclick="document.querySelector('#showItemImages').classList.add('hidden')"></i>
                                <div class="carousel-inner ">
                                    @foreach ($feed->collection as $img)
                                        <div class="carousel-item {{ $loop->first ? "active" :''}} text-center" style="max-width:75vw; max-height:75vh">
                                            @if($feed->collection[0] != 'dark-logo.png')
                                                <img class="glow" src="{{asset('assets/items/'.$feed->directory.'/'.$img)}}" alt="{{$feed->item_title}}" width="100%" >
                                            @else 
                                                <img class="glow" src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_title}}" >
                                            @endif
                                            <br>
                                            <span class="h4 text-muted ani ani_fadeIn" style="position: fixed;top: 15%;left: 50%;transform:translate(-50%)">{{$loop->index + 1}}</span>
                                        </div>                                                                                                                                     
                                    @endforeach
                                </div>
                            </div>
                            @if(count($feed->collection) > 1)
                                <div class="text-center" style="z-index: 13">
                                    <button class="sbtn sbtn-txt carousel-control-prevz mx-5" type="button" data-bs-target="#showFullImage" data-bs-slide="next"
                                        style="position: fixed; top: 25%; right: 8%; z-index: 1; height: 50%; width:2rem;">
                                        <span aria-hidden="true"><i class="bi bi-chevron-right fs-2 cw"></i></span>
                                        <span class="visually-hidden"></span>
                                    </button>
                                    <button class="sbtn sbtn-txt carousel-control-nextz mx-5" type="button" data-bs-target="#showFullImage" data-bs-slide="prev"
                                        style="position: fixed; top: 25%; left: 8%; z-index: 1; height: 50%; width:2rem;">
                                        <span aria-hidden="true"><i class="bi bi-chevron-left fs-2 cw"></i></span>
                                        <span class="visually-hidden"></span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($feed->user_id == Auth::id())
                        @if($feed->status == '1')
                            @switch($feed->item_type)
                                @case('1')
                                    <div class="card-footer text-centerz">
                                        <div class="alert alert-success" role="alert">
                                            <div class="row">
                                                <div class="col">
                                                    <small> عملية التبادل ناجحة</small>
                                                    <small class="p-1">البديل
                                                        <strong class="cursor" wire:click="$emit('changeBody',['showitem','{{$feed->sender_item->id}}'])">{{$feed->sender_item->item_title}}</strong>
                                                    </small>
                                                </div>
                                            </div>
                                            <small> <span>معلومات التواصل</span></small>
                                            <small> <i class="bi bi-person"></i><span> {{$feed->sender->name}} </span> </small> <br>   
                                            <small> <a href="tel:+2{{$feed->sender->phone}}"><i class="bi bi-phone"></i><span> {{$feed->sender->phone}}</span></a></small> <br>
                                            <small> <a href="whatsapp://send?phone=+{{$feed->sender->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                                        </div>
                                    </div>
                                    @break
                                @case('2')
                                    <div class="card-footer text-centerz">
                                        <div class="alert alert-success" role="alert">
                                            <div class="row">
                                                <div class="col">
                                                    @if($feed->sender_item != 'trade')
                                                        <small>عملية البيع تمت كعملية مبادلة ناجحة</small>
                                                        <small class="p-1">البديل
                                                            <strong class="cursor" wire:click="$emit('changeBody',['showitem','{{$feed->sender_item->id}}'])">{{$feed->sender_item->item_title}}</strong>
                                                        </small>
                                                    @else 
                                                        <small> عملية البيع ناجحة</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <small> <span>معلومات التواصل</span></small>
                                            <small> <i class="bi bi-person"></i><span> {{$feed->sender->name}} </span> </small> <br>   
                                            <small> <a href="tel:+2{{$feed->sender->phone}}"><i class="bi bi-phone"></i><span> {{$feed->sender->phone}}</span></a></small> <br>
                                            <small> <a href="whatsapp://send?phone=+{{$feed->sender->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                                        </div>
                                    </div>
                                    @break
                                @case('3')
                                    <div class="card-footer text-centerz">
                                        <div class="alert alert-success" role="alert">
                                            <div class="row">
                                                <div class="col " >
                                                    <small> عملية تبرع ناجحة</small>
                                                </div>
                                            </div>
                                            <small> <span>معلومات التواصل</span></small>
                                            <small> <i class="bi bi-person"></i><span> {{$feed->sender->name}} </span> </small> <br>   
                                            <small> <a href="tel:+2{{$feed->sender->phone}}"><i class="bi bi-phone"></i><span> {{$feed->sender->phone}}</span></a></small> <br>
                                            <small><a href="whatsapp://send?phone=+{{$feed->sender->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                                        </div>
                                    </div>
                                    @break                    
                            @endswitch
                        @else 
                            @if($feed->payment != false)
                                <div class="card-footer text-centerz">
                                    <div class="alert alert-light" role="alert">
                                        <p>{{$feed->paid == false ? "لم يتم الدفع": ""}}</p>
                                        <small>يمكنك الدفع عن طريق قنوات فوري </small><br>
                                        <small>القيمة : {{$feed->payment->payment_amount}} جنيه</small><br>
                                        <p><span>رمز العملية</span> : {{$feed->payment->merchantCode}}</p>
                                        <strong>الوقت المتبقي قبل الغاء العملية</strong><br>
                                        <p> {{ timeRemain($feed->payment->payment_expire_date)}} </p>         
                                    </div> 
                                </div>
                            @else
                                @if(count($feed->requests) > 0)
                                    <div class="card-footer text-centerz">
                                        <div class="modal-dialog ani ani_fadeIn mx-auto mb-1 mt-1">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @foreach($feed->requests as $req)
                                                        @if($req->viewed != '1')
                                                            <div class="row {{$req->viewed == '0' ? 'new' : ''}}" wire:click.prefetch="setRequestViewed('{{$req->id}}')">
                                                        @else 
                                                            <div class="row {{$req->viewed == '0' ? 'new' : ''}}">
                                                        @endif 
                                                                @switch($feed->item_type)
                                                                    @case('1')
                                                                        <div class="col-8">
                                                                            <div class="cursor" wire:click="$emit('changeBody',['showitem',{{$req->sender_item->id}}])" title="عرض المنشور">
                                                                                <p > غرض طلب المبادلة <strong>{{$req->sender_item->item_title}}</strong></p>
                                                                                <small class="text-muted m-0"><span>{{$req->created_at->diffForHumans()}}</span></small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 text-center">
                                                                            <img src="{{asset('assets/items/'.$req->sender_item->directory.'/'.$req->sender_item->collection[0])}}" alt="" width="50%" class="glow">
                                                                        </div> 
                                                                        @break
                                                                    @case('2')
                                                                        @if($req->sender_item != 'trade')    
                                                                            <div class="col-8">
                                                                                <div class="cursor" wire:click="$emit('changeBody',['showitem',{{$req->sender_item->id}}])" title="عرض المنشور">
                                                                                    <small class="cr">طلب تبديل</small><br>
                                                                                    <p>غرض طلب التبديل <strong>{{$req->sender_item->item_title}}</strong> </p>
                                                                                    <small class="text-muted m-0"><span>{{$req->created_at->diffForHumans()}}</span></small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <img src="{{asset('assets/items/'.$req->sender_item->directory.'/'.$req->sender_item->collection[0])}}" alt="" width="50%" class="glow">
                                                                            </div>                                                        
                                                                        @else 
                                                                            <div class="col-12">
                                                                                <div class="cursor">
                                                                                    <p ><strong>طلب شراء</strong></p>
                                                                                    <small><span>{{$req->created_at->diffForHumans()}}</span></small>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @break
                                                                    @case('3')
                                                                        <small>سبب الطلب</small>
                                                                        <h6 class="m-0">{{$req->sender_item}}</h6>
                                                                        <small class="card-subtitle text-muted m-0">{{$req->created_at->diffForHumans()}}</small><br>
                                                                        @break
                                                                    @default                                                            
                                                                @endswitch
                                                                <small onclick="document.querySelector('#requestAcc{{$req->id}}').classList.toggle('hidden')" class="sbtn sbtn-txt w-100 mt-1">
                                                                    قبول
                                                                </small>
                                                                <small wire:click="acceptRequest('{{$feed->id}}','{{$req->id}}')" id="requestAcc{{$req->id}}" class="hidden btn btn-outline-success w-100 mt-1">
                                                                    <i class="bi bi-check"></i> نعم
                                                                </small>
                                                            </div>
                                                            @if(!$loop->last)
                                                            <hr class="mb-1 mt-1">
                                                            @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else 
                                    <div class="card-footer text-center">
                                        <p>لايوجد عروض الى الأن</p>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @else 
                        @if($feed->status == '1')
                            <div class="card-footer text-centerz">
                                <div class="alert alert-info" role="alert">
                                    <p>لقد تم تبديل هذا المنشور و سوف تتم ازالته بالوقت القريب</p>         
                                </div> 
                            </div>
                        @else
                            @if($feed->requested == true)
                                <div class="card-footer text-centerz">
                                    <div class="alert alert-info" role="alert">
                                        <p>ارسلت طلب لهذا المنشور</p>
                                    </div> 
                                </div>
                            @elseif($feed->recived == true)
                                <div class="card-footer text-centerz">
                                    <div class="alert alert-info" role="alert">
                                        <p>استلمت طلب من هذا المنشور</p>
                                    </div> 
                                </div>
                            @else
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
                        @endif
                    @endif
                
                </div>
            </div>
        </div>
    @endif
</div>
