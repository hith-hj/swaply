<div class="ani ani_fadeIn ani_faster">
    <div class="alert alert-light mt-5px ani ani_slideInDown" role="alert">
        <h3>الطلبات</h3>
        <p>العروض و الطلبات المرسلة</p>
    </div>
    <nav class="mt-1 ">
       {{-- <div class="w-100 btn-group bg-light mb-1" style="flex-wrapz: nowrap;font-size:12px">
            <button class="btn btn-outline-success" wire:click="$emitSelf('changeRequests','sentOffers')"  ><span>عروض مرسلة</span></button>
            <button class="btn btn-outline-success" wire:click="$emitSelf('changeRequests','sentOrders')"  ><span>الطلبات المرسلة</span></button>
        </div>
        --}}
        <div class="tab-content">
                @switch($view)
                    @case('sentOffers')
                            @forelse ($requests as $req)
                                <div class="card shadow">
                                    <div class="card-body" >
                                        <h6 class="card-title m-0">
                                            <span wire:click="$emitTo('body','changeBody',['showitem','{{$req->sender_item->id}}'])"> ارسلت {{$req->sender_item->item_title}}</span>  &lArr;  
                                            <span class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$req->item->id}}'])"> مقابل {{$req->item->item_title}}</span>
                                        </h6>
                                            
                                        <div class="row">
                                            <div class="col">
                                                <small class="mx-1"><span> <i class="bi bi-clock"></i></span> {{$req->created_at->diffForHumans()}}</small>
                                                <small class="mx-1"><span> المكان :</span> {{$req->item->item_location}}</small>
                                                <small class="mx-3 cursor" onclick="document.querySelector('#delete{{$req->id}}').classList.toggle('hidden')" ><i class="me-auto bi bi-trash"></i>حذف الطلب</small>
                                                <small class="hidden cr cursor glow" id="delete{{$req->id}}" wire:click="deleteRequest({{$req->id}})">حذف</small>
                                            </div>
                                        </div>   
                                        <hr>
                                        @switch($req->status)
                                            @case(-1)
                                                <div class="alert alert-danger" role="alert">
                                                    عذرا تم الرفض
                                                </div>
                                                @break
                                            @case(0)
                                                <div class="alert alert-dark" role="alert">
                                                    بانتظار الرد
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="alert alert-success" role="alert">
                                                    <span>تم قبول الطلب  <span>{{$req->updated_at->diffForHumans()}}</span> </span><br>                                                    
                                                    <small> <span>معلومات التواصل</span></small>
                                                    <small> <i class="bi bi-person"></i><span> {{$req->user->name}} </span> </small> <br>   
                                                    <small> <a href="tel:+2{{$req->user->phone}}"><i class="bi bi-phone"></i><span> {{$req->user->phone}}</span></a></small> <br>
                                                    <small><a href="whatsapp://send?phone=+{{$req->user->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                                                
                                                </div>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </div>
                                </div>    
                            @empty
                            <div class="alert alert-light ani ani_slideInUp" role="alert">
                                <h5>لايوجد اي عروض مرسلة حاليا</h5>
                            </div>
                            @endforelse
                        @break
                    @case('sentOrders')
                        @forelse ($requests as $req)
                            <div class="card shadow">
                                <div class="card-body" >
                                    <h6 class="card-title m-0">
                                        <span wire:click="$emitTo('body','changeBody',['showitem','{{$req->item->id}}'])">ارسلت طلب إلى  <strong class="glow">{{$req->item->item_title}}</strong> </span>
                                    </h6>
                                    <p class="card-text">{{$req->sender_item}}</p>      
                                    <div class="row">
                                        <div class="col">
                                            <small class="mx-1"><span> <i class="bi bi-clock"></i></span> {{$req->created_at->diffForHumans()}}</small>
                                            <small class="mx-1"><span> المكان :</span> {{$req->item->item_location}}</small>
                                            <small class="mx-3 cursor" onclick="document.querySelector('#delete{{$req->id}}').classList.toggle('hidden')" ><i class="me-auto bi bi-trash"></i>حذف الطلب</small>
                                            <small class="hidden cr cursor glow" id="delete{{$req->id}}" wire:click="deleteRequest({{$req->id}})">حذف</small>
                                        </div>
                                    </div>   
                                    <hr>
                                    @switch($req->status)
                                        @case(-1)
                                            <div class="alert alert-danger" role="alert">
                                                عذرا تم الرفض
                                            </div>
                                            @break
                                        @case(0)
                                            <div class="alert alert-dark" role="alert">
                                                بانتظار الرد
                                            </div>
                                            @break
                                        @case(1)
                                            <div class="alert alert-success" role="alert">
                                                <span>تم قبول الطلب  <span>{{$req->updated_at->diffForHumans()}}</span> </span><br>                                                    
                                                <small> <span>معلومات التواصل</span></small>
                                                <small> <i class="bi bi-person"></i><span> {{$req->user->name}} </span> </small> <br>   
                                                <small> <a href="tel:+2{{$req->user->phone}}"><i class="bi bi-phone"></i><span> {{$req->user->phone}}</span></a></small> <br>
                                                <small><a href="whatsapp://send?phone=+{{$req->user->phone}}&text=Swaply"><i class="bi bi-whatsapp mx-2" > Whatsapp</i></a></small><br>
                                            
                                            </div>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </div>
                            </div>   
                        @empty
                            <div class="alert alert-light ani ani_slideInUp" role="alert">
                                <h5>لايوجد اي طلبات مرسلة حاليا</h5>
                            </div>
                        @endforelse
                    @break
                    {{--@case('recivedOffers')
                        @forelse ($requests as $req)
                            <div class="card shadow">
                                <div class="card-body" >
                                    <h6 class="card-title m-0">
                                        <span wire:click="$emitTo('body','changeBody',['showitem','{{$req->sender_item->id}}'])"> استلمت {{$req->sender_item->item_title}}</span> &lArr; 
                                        <span wire:click="$emitTo('body','changeBody',['showitem','{{$req->item->id}}'])">مقابل {{$req->item->item_title}}</span>   
                                        </h6>
                                    <div class="row">
                                        <div class="col">
                                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$req->item->item_type == 1 ? 'مبادلة' : 'تبرع'}}</span></small>
                                            <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$req->created_at->diffForHumans()}}</span></small>
                                            <small class="mx-1"><span> المكان :</span> {{$req->item->item_location}}</small>
                                        </div>
                                    </div>   
                                    <hr>
                                    <div class="btn-group w-50">
                                        <button class="btn btn-outline-success" > قبول العرض</button>
                                    </div>
                                </div>
                            </div>    
                        @empty
                            <p>لايوجد اي عروض مستلمة حاليا</p>
                        @endforelse
                    @break
                    @case('recivedOrders')
                            @forelse ($requests as $req)
                                <div class="card shadow">
                                    <div class="card-body" >
                                        <h6 class="card-title m-0"> 
                                            <span wire:click="$emitTo('body','changeBody',['showitem','{{$req->item->id}}'])">{{$req->item->item_title}}</span> </h6>
                                        <div class="row">
                                            <div class="col">
                                                <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$req->item->item_type == 1 ? 'مبادلة' : 'تبرع'}}</span></small>
                                                <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$req->created_at->diffForHumans()}}</span></small>
                                                <small class="mx-1"><span> المكان :</span> {{$req->item->item_location}}</small>
                                            </div>
                                        </div>   
                                        <hr>
                                        @switch($req->status)
                                            @case(-1)
                                                <div class="alert alert-danger" role="alert">
                                                    عذرا تم الرفض
                                                </div>
                                                @break
                                            @case(0)
                                                <div class="alert alert-dark" role="alert">
                                                    بانتظار الرد
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="alert alert-success" role="alert">
                                                    تم قبول الطلب 
                                                    معلومات التواصل هي : رقم الهاتف البريد الالكتروني اسم الشخص
                                                </div>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </div>
                                </div>    
                            @empty
                                <p>لايوجد اي طلبات مستلمة حاليا</p>
                            @endforelse
                    @break --}}
                @endswitch
        </div>
    </nav>
</div>





