<div id="navMenu" class="ver-menu" onload="menuView()">
    <ul id="navList" class="ver-list">
        <li class="cursor ver-li" title="الرئيسية" wire:click="$emitTo('body','changeBody','feeds')">
            <span class="ver-link">
                <i class="bi bi-house"></i>
            </span>
        </li>
        <li class="cursor ver-li" title="معلوماتي">
            <div class="dropend">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-30,5" aria-expanded="false">
                    <i class="bi bi-person "></i>
                    @if($user->location == 'not-set') 
                        <span class="bi bi-exclamation-circle red-alert icon-sm-5"></span>
                    @endif
                </span>
                <div class="dropdown-menu min-wid-300 px-1">
                    <div class="card shadow-sm position-relative text-center">
                        <div class="p-1 position-static">
                            <div class="card-header">
                                <h5 class="mb-0"> {{$user->name}}</h5>
                            </div>
                            <hr>                            
                            <div class="mb-0 text-muted"> <i class="bi bi-envelope"></i> {{$user->email}}</div>
                            <div class="mb-0 text-muted"> <i class="bi bi-phone"></i> {{$user->phone}}</div>
                            @if($user->location == 'not-set')
                                <div class="location border rounded border-info">
                                    <label for=""><span>ادخل الموقع</span></label>
                                    <input type="text" class="form-control" placeholder=" المحافظة-المنطقة/المركز-الحي/القرية" readonly>
                                    <div class="input-group">
                                        <input type="text" aria-label="governent" list="covernent-list" class="form-control" wire:model.defer="user_location.covernent">
                                        <input type="text" aria-label="area"  class="form-control" wire:model.defer="user_location.area">
                                        <input type="text" aria-label="nighborhood"  class="form-control" wire:model.defer="user_location.naighbor">
                                    </div>
                                    <datalist id="covernent-list">
                                        <option value="القاهرة">
                                        <option value="الاسكندرية">
                                        <option value="اسيوط">
                                        <option value="اسماعيلية">
                                        <option value="طنطا">
                                        <option value="سوهاج">
                                        <option value="اسوان">
                                        <option value="جينه">
                                    </datalist>
                                    <i class="bi bi-check cursor" wire:click="setLocation('{{$user->id}}')"></i>                                    
                                </div>
                            @else
                                <div class="mb-0 text-muted"> <i class="bi bi-geo-alt"></i> {{$user->location}}</div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <small title="مبادلاتي" class="glow mx-1"> <i class="bi bi-arrow-down-up"></i> {{$user->swaps}}</small>
                                    {{-- <small title="تبرعاتي" class="glow mx-1"> <i class="bi bi-person"></i> 0 </small> --}}
                                    <small title="اغراضي" class="glow mx-1"> <i class="bi bi-card-list"></i> {{count($user->items)}}  </small>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer text-muted text-center">
                            <div class="btn-group py-1" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-dark btn-sm"><i class="bi bi-gear ml-1"></i><span>اعداداتي</span></button>
                                <button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-pencil-square mx-1"></i><span>معلوماتي</span></button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </li>
        <li class="cursor ver-li" title="أغراضي">
            <div class="dropend">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-50,5" aria-expanded="false" >
                    <i class="bi bi-collection "></i>
                </span>
                <div class="dropdown-menu min-wid-300 px-1" >
                    <small wire:click="$emitTo('body','changeBody','items')" class="p-2 cursor glow"> <i class="bi bi-card-list"></i> عرض الكل <span class="badge bg-green">{{count($user->items)}}</span></small>
                    @forelse($user->items as $item)
                        <div class="list-group mt-1 {{$item->status ==1 ? 'br-success' : ''}}" wire:click="$emit('changeBody',['showitem','{{$item->id}}'])">
                            <span class="list-group-item list-group-item-action" aria-current="true">
                                <h6 class="m-0"> <i class="bi bi-card-text"></i> {{$item->item_title}}
                                    <small class="text-muted "> <i class="bi bi-calendar-day"></i> {{$item->created_at->diffForHumans()}} </small>
                                </h6>
                                <div class="row">
                                    <div class="col text-muted">
                                        <small class="card-subtitle m-0">
                                            <span> <i class="bi bi-distribute-horizontal"></i> {{$item->item_type == 1? 'مبادلة':'تبرع'}} |</span>
                                        </small>
                                        <small class=" {{$item->item_type == 2 ? 'hidden' : ''}}"><i class="mx-1 bi bi-arrow-down-up"></i> {{$item->swap_with}} |</small>
                                        <small class=""> عروض : {{$item->requests}}</small> 
                                    </div>
                                </div>                                
                                <small> <i class="bi bi-justify-right"></i> {{substr($item->item_info,0,strlen($item->item_info) < 40? strlen($item->item_info): strlen($item->item_info)/2)}}</small> 
                            </span>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @empty
                        <div class="list-group">
                            <p><span>لايوجد لك اي اغراض حاليا</span></p>
                        </div>
                    @endforelse
                </div>
            </div>
        </li>
        {{-- <li class="cursor ver-li" title="اضافة غرض جديد" id="addItemForm">
            <div class="dropend dataForm">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-150,6" aria-expanded="false">
                    <i class="bi bi-plus-square-dotted icon-25"></i>
                </span>
                <div id="dataForm" class="dropdown-menu min-wid-300 px-1" role="menu">
                    <form id="add-item-form" class="text-centerz" onsubmit="AddItem(event)" method="POST" enctype="multipart/form-data">
                        <!-- <select required name="item_type" id="" class="form-select mb-1"  onchange="
                            if(this.value == 'تبرع'){
                                document.querySelector('#swap_with').value = 'give';
                                document.querySelector('#swap_with').classList.add('hidden');
                            }else{
                                document.querySelector('#swap_with').value = '';
                                document.querySelector('#swap_with').classList.remove('hidden');
                                // document.querySelector('#swap_with').classList.add('ani','ani_slideInDown');
                            }" >
                            <option value="مبادلة" selected disabled><small class="text-right" >نوع المنشور</small></option>
                            <option value="1" class="glow"> <span>مبادلة</span></option>
                            <option value="2" class="glow"> <span>تبرع</span></option>
                        </select> -->
                        <label class="form-label" >مكان الغرض</label>
                        <small id="setLocation" class="cursor btn glow" title="اضف موقعي" onclick="setItemLocation('{{Auth::user()->location}}')"> <i class="bi bi-geo-alt "></i> </small>
                        <small id="resetLocation" class="cursor btn glow hidden" title="إعادة ضبط" onclick="resetItemLocation()"> <i class="bi bi-arrow-repeat "></i> </small>
                        <br>
                        <small><span>محافظة-المنطقة او المركز-الحي او القرية</span></small>
                        <div id="location-group" class="input-group mb-1" title="محافظة-المنطقة او المركز-الحي او القرية">
                            <select name="item_location_covernent"  required class="form-select">
                                <option id="location-inputz" ></option>
                                <option value="القاهرة"> <span>القاهرة</span> </option>
                                <option value="الاسكندرية"> <span>الاسكندرية</span> </option>
                                <option value="اسيوط"> <span>اسيوط</span> </option>
                                <option value="اسماعيلية"> <span>اسماعيلية</span> </option>
                                <option value="طنطا"> <span>طنطا</span> </option>
                                <option value="سوهاج"> <span>سوهاج</span> </option>
                                <option value="اسوان"> <span>اسوان</span> </option>
                                <option value="جينه"> <span>جينه</span> </option>
                            </select>
                            <input type="text" name="item_location_area" aria-label="Last name" required class="form-control">
                            <input type="text" name="item_location_naighbor" aria-label="Last name" required class="form-control">
                        </div>
                        <input type="text" id="location-input" class="form-control hidden mb-1" name="item_location" readonly>
                        
                        <input name="item_title" type="text" class="form-control mb-1" required placeholder="اسم الغرض" aria-label="location" aria-describedby="location-input">
                        
                        <input id="swap_with" name="swap_with" type="text" placeholder="عايز تبدل الغرض بأيه" class="form-control mb-1" title="الاسم واضح" required>

                        <textarea name="item_description" wrap="hard" class="form-control mb-1" rows="2" title="اختياري" placeholder="وصف عن الغرض"></textarea>
                        <div id="imgs_collection" hidden>
                        </div>
                        <div class="js-upload upload mb-1" uk-form-custom>
                            <input name="item_imgs[]" multiple required type="file" id="itemgs" onchange="displayUploadedImages(event)" hidden>
                            <label for="itemgs" class="cursor sbtn-txt " tabindex="0"> <i class="bi bi-images"></i>
                                أختر صور</label>
                        </div>
                        <div class="text-center">
                            <button id="submit-form" type="submit" name="submit_btn" class="sbtn sbtn-txt">
                                <i class="bi bi-cloud-arrow-up icon-15"></i> رفع</button>
                        </div>
                            @csrf
                    </form>
                </div>
                
            </div>
        </li> --}}
        <li class="cursor ver-li" title="اضافة غرض جديد" id="addItemForm">
            <div class="dataForm">
                <span class="ver-link" onclick="document.querySelector('#myModal').classList.toggle('hidden')">
                    <i class="bi bi-plus-square-dotted icon-25"></i>
                </span>               
            </div>
        </li> 
        <li class="cursor ver-li" title="صفحات">
            <div class="dropend">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-50,6" aria-expanded="false">
                    <i class="bi bi-files "></i>
                </span>
                <div class="dropdown-menu px-1">
                    <div class="card">
                        <ul class="" style="list-style: none;padding:0;">
                            <li class="cursor" wire:click="$emitTo('body','changeBody','requests')">
                                <span class="dropdown-item" > <i class="bi bi-arrows-expand"></i> <span>عروض</span> </span>
                            </li>
                            <li class="cursor" wire:click="$emitTo('body','changeBody','swaps')">
                                <span class="dropdown-item" > <i class="bi bi-arrow-down-up"></i> <span>مبادلات</span> </span>
                            </li>
                            <li class="cursor" wire:click="$emitTo('body','changeBody','saves')">
                                <span class="dropdown-item" > <i class="bi bi-save"></i> <span>محفوظات</span> </span>
                            </li>
                            <li class="cursor" wire:click="$emitTo('body','changeBody','recommends')">
                                <span class="dropdown-item" > <i class="bi bi-bookmark-plus"></i> <span>مقترحات</span> </span>
                            </li>
                            <li class="cursor" wire:click="$emitTo('body','changeBody','reportProblem')">
                                <span class="dropdown-item" > <i class="bi bi-flag cr"></i> <span>تبليغ مشكلة</span> </span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </li>
        <li class="cursor ver-li" title="اشعارات" >
            <div class="dropend">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                    <i class="bi bi-bell "></i>
                    @if(count($user->notification) >0 )
                        <span class="bi bi-exclamation-circle red-alert icon-sm-5"></span>
                    @endif
                </span>
                <div class="dropdown-menu min-wid-300 px-2">
                    <span class="link-dark text-left py-1" wire:click="removeNotis()"> 
                        <small>
                            <i class="bi bi-x"></i>
                            <span>إزالة الكل</span>
                        </small>
                        <small class="badge bg-green">{{count($user->notification)}}</small>
                    </span>
                    <div class="list-group mt-1 ">
                        @forelse($user->notification as $noti)
                            <span class="list-group-item list-group-item-action " wire:click="$emit('changeBody',['showitem','{{$noti->on_id}}'])" aria-current="true" >
                                <div class="d-flex w-100 justify-content-between" wire:click.prefetch="clearNotification('{{$noti->id}}')">
                                    <h6 class="mb-1">{{$noti->data}}</h6>
                                    <small class="text-muted">{{$noti->created_at->diffForHumans()}}</small>
                                </div>
                                <small >{{$noti->item->item_title}}</small>
                            </a>
                        @empty 
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">لايوجد اشعارات جديدة</h6>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </li>
        <li class="cursor ver-li" title="خروج (خليك معنا)">
            <div class="dropend">
                <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- <i class="bi bi-box-arrow-right "></i> --}}
                        <i class="bi bi-chevron-left "></i>
                </span>
                
                <div class="dropdown-menu px-1">
                    <div class="card">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.querySelector('#logout-form').submit();">
                            <i class="bi bi-door-open cr"></i><span>طلعني برا </span>
                        </a>
                        {{-- <div class="dropdown-item"><i class="bi bi-door-closed "></i><span>خليك هون</span></div> --}}
                    </div>
                </div>
                    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <div id="myModal" class="hidden smodal ">
        <div id="dataForm" class="show ani ani_slideInUp px-1 min-wh" role="menu" style="position: initial">
            <form id="add-item-form" class="text-centerz" onsubmit="AddItem(event)" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-10">
                        <label class="form-label" >مكان الغرض</label>
                        <small id="setLocation" class="cursor btn glow" title="اضف موقعي" onclick="setItemLocation('{{Auth::user()->location}}')"> <i class="bi bi-geo-alt "></i> </small>
                        <small id="resetLocation" class="cursor btn glow hidden" title="إعادة ضبط" onclick="resetItemLocation()"> <i class="bi bi-arrow-repeat "></i> </small>
                    </div>
                    <div class="col-1">
                        <i class="bi bi-x icon-15" onclick="document.querySelector('#myModal').classList.toggle('hidden')"></i>
                    </div>
                </div>
                <small><span>محافظة-المنطقة او المركز-الحي او القرية</span></small>
                <div id="location-group" class="input-group mb-1" title="محافظة-المنطقة او المركز-الحي او القرية">
                    <select name="item_location_covernent"  required class="form-select">
                        <option id="location-inputz" ></option>
                        <option value="القاهرة"> <span>القاهرة</span> </option>
                        <option value="الاسكندرية"> <span>الاسكندرية</span> </option>
                        <option value="اسيوط"> <span>اسيوط</span> </option>
                        <option value="اسماعيلية"> <span>اسماعيلية</span> </option>
                        <option value="طنطا"> <span>طنطا</span> </option>
                        <option value="سوهاج"> <span>سوهاج</span> </option>
                        <option value="اسوان"> <span>اسوان</span> </option>
                        <option value="جينه"> <span>جينه</span> </option>
                    </select>
                    <input type="text" name="item_location_area" aria-label="Last name" required class="form-control">
                    <input type="text" name="item_location_naighbor" aria-label="Last name" required class="form-control">
                </div>
                <input type="text" id="location-input" class="form-control hidden mb-1" name="item_location" readonly>
                
                <input name="item_title" type="text" class="form-control mb-1" required placeholder="اسم الغرض" aria-label="location" aria-describedby="location-input">
                
                <input id="swap_with" name="swap_with" type="text" placeholder="عايز تبدل الغرض بأيه" class="form-control mb-1" title="الاسم واضح" required>

                <textarea name="item_description" wrap="hard" class="form-control mb-1" rows="2" title="اختياري" placeholder="وصف عن الغرض"></textarea>
                <div id="imgs_collection" hidden></div>
                <div class="js-upload upload mb-1" uk-form-custom>
                    <input name="item_imgs" multiple required type="file" id="itemgs" onchange="displayUploadedImages(event)" hidden>
                    <label for="itemgs" class="cursor sbtn-txt " tabindex="0"> <i class="bi bi-images"></i>
                        أختر صور</label>
                </div>
                <div class="text-center">
                    <button id="submit-form" type="submit" name="submit_btn" class="sbtn sbtn-txt">
                        <i class="bi bi-cloud-arrow-up icon-15"></i> رفع</button>
                </div>
                    @csrf
            </form>
        </div>
    </div> 
    <label id="cir-icon" class="cursor"><i class="bi bi-list"></i></label>
</div>