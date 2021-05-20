<div>
    <div id="navMenu" class="ver-menu" onload="menuView()">
        <ul id="navList" class="ver-list">
            {{-- <li class="cursor ver-li" title="الرئيسية" wire:click="$emitTo('body','changeBody','feeds')">
                <span class="ver-link">
                    <i class="bi bi-house"></i>
                </span>
            </li> --}}
            <li class="cursor ver-li " title="معلوماتي" >
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-60,5" aria-expanded="false">
                        <i class="bi bi-person "></i>
                        @if($user->location == 'not-set') 
                            <span class="bi bi-exclamation-circle red-alert icon-sm ani ani_flash ani_loop"></span>
                        @endif
                    </span>
                    <div class="dropdown-menu min-wid-300 px-1 {{$user->location == 'not-set' ? 'show ani ani_pulse ani_repeat-3' :''}}">
                        <div class="card shadow-sm position-relative p-1">
                            <div class="card-header row px-1">
                                <div class="col-8">
                                    <h5>{{$user->name}}</h5>
                                </div>
                                <div class="col-2 offset-1">
                                    <span class="cursor icon-1 link-dark" onclick="document.querySelector('#editMyInfoModal').classList.toggle('hidden')"><i class="bi bi-pencil-square"></i></span>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="mb-0 text-muted"> <i class="bi bi-geo-alt"></i> {{$user->location}}</div>
                                <div class="mb-0 text-muted"> <i class="bi bi-envelope"></i> {{$user->email}}</div>
                                <div class="mb-0 text-muted"> <i class="bi bi-phone"></i> {{$user->phone}}</div>
                                <div class="row">
                                    <div class="col">
                                        <small title="مبادلاتي" class="glow mx-1"> <i class="bi bi-arrow-down-up"></i> {{$user->swaps}}</small>
                                        {{-- <small title="تبرعاتي" class="glow mx-1"> <i class="bi bi-person"></i> 0 </small> --}}
                                        <small title="اغراضي" class="glow mx-1"> <i class="bi bi-card-list"></i> {{count($user->items)}}  </small>
                                    </div>
                                </div>
                            </div>
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
                                            <small class=""> شوهد : {{$item->views}}</small> 
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
            <li class="cursor ver-li" title="اضافة غرض جديد" id="addItemForm">
                <div class="dataForm">
                    <span class="ver-link p-1" onclick="document.querySelector('#newItemModal').classList.toggle('hidden')">
                        <i class="bi bi-plus-square-dotted icon-2"></i>
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
                                
                                <li class="cursor" wire:click="$emitTo('body','changeBody','swaps')">
                                    <span class="dropdown-item" > <i class="bi bi-arrow-down-up"></i> <span>مبادلات</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','saves')">
                                    <span class="dropdown-item" > <i class="bi bi-save"></i> <span>محفوظات</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','recommends')">
                                    <span class="dropdown-item" > 
                                        @if($user->recommends > 0)
                                            <span class="bi bi-dot red-alert icon-15"></span>
                                        @endif
                                        <i class="bi bi-bookmark-plus"></i> <span>مقترحات</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','requests')">
                                    <span class="dropdown-item" > <i class="bi bi-arrow-bar-up"></i> <span> العروض المرسلة</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','termsOfUse')">
                                    <span class="dropdown-item" > <i class="bi bi-ui-checks"></i> <span>شروط الاستخدام</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','reportProblem')">
                                    <span class="dropdown-item" > <i class="bi bi-flag cr"></i> <span>اقتراحات و مشاكل</span> </span>
                                </li>
                                <li class="cursor">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.querySelector('#logout-form').submit();">
                                        <i class="bi bi-door-open cr"></i><small >تسجيل خروج</small>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </li>
            <li class="cursor ver-li" title="اشعارات" >
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-15,10" aria-expanded="false" >
                        <i class="bi bi-bell "></i>
                        @if(count($user->notification) >0 )
                            <span class="bi bi-exclamation-circle red-alert icon-sm"></span>
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
                                </span>
                            @empty 
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">لايوجد اشعارات جديدة</h6>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>
            {{-- <li class="cursor ver-li" title="خروج (خليك معنا)">
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-chevron-left "></i>
                    </span>                    
                    <div class="dropdown-menu px-1">
                        <div class="card">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.querySelector('#logout-form').submit();">
                                <i class="bi bi-door-open cr"></i><span>طلعني برا </span>
                            </a>
                        </div>
                    </div>                        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li> --}}
        </ul>

        <div id="newItemModal" class="hidden smodal ">
            <div id="dataForm" class="itemCard shadow show ani ani_fadeIn p-2" >
                <form id="add-item-form" class="width-auto" onsubmit="AddItem(event)" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-8 ">
                            <label class="p-2">أضافة</label><br>
                        </div>
                        <div class="col-1 offset-2 cursor">
                            <i class="bi bi-x fs-2" onclick="document.querySelector('#newItemModal').classList.toggle('hidden')"></i>
                        </div>
                    </div>

                    <div id="imgs_collection " hidden></div>
                    <div class="js-upload upload mb-1" uk-form-custom>
                        <input name="item_imgs[]" multiple required type="file" id="itemgs" tabindex="0" onchange="displayUploadedImages(event)" hidden>
                        <button class="cursor sbtn sbtn-txt" tabindex="0" type="button" onclick="document.querySelector('#itemgs').click()"> <i class="bi bi-images"></i>
                            أختر صور</button>
                    </div>

                    <input name="item_title" type="text" class="form-control mb-1" placeholder="الأسم" required>

                    <input name="swap_with" type="text" id="swap_with" placeholder="هتبدل بأيه" class="form-control mb-1" title="الاسم واضح" required>

                    <textarea name="item_description" wrap="hard" class="form-control" rows="2" title="اختياري" placeholder="اوصف حاجتك"></textarea>

                    {{-- <div class="location mb-1">
                        <button id="setLocation" type="button" class="btn text-muted cursor glow" tabindex="0" onclick="setItemLocation()">إضافة عنوان اخر</button>
                        <span id="resetLocation" class="hidden cursor glow " tabindex="0" onclick="resetItemLocation()"><i class="bi bi-x"></i></span>
                        <div id="addLocationBio" class="hidden">
                            <small>اضف هذا العنوان في حال كان عنوانك يختلف عن عنوان الحاجة التي تنشرها</small>
                        </div>
                        <div id="location-group" class="input-group mb-1 hidden" title="محافظة-المنطقة او المركز-الحي او القرية">
                            <select name="item_location_covernent" tabindex="0" class="form-select" disabled="true">
                                <option selected>المحافظة</option>
                                <option value="القاهرة"> <span>القاهرة</span> </option>
                                <option value="الجيزة"> <span>الجيزة</span> </option>
                                <option value="القليوبية"> <span>القليوبية</span> </option>
                                <option value="الشرقية"> <span>الشرقية</span> </option>
                                <option value="المنوفية"> <span>المنوفية</span> </option>
                                <option value="الغربية"> <span>الغربية</span> </option>
                                <option value="كفر الشيخ"> <span>كفر الشيخ</span> </option>
                                <option value="الدقهلية"> <span>الدقهلية</span> </option>
                                <option value="دمياط"> <span>دمياط</span> </option>
                                <option value="البحيرة"> <span>البحيرة</span> </option>
                                <option value="الأسكندرية"> <span>الأسكندرية</span> </option>
                                <option value="مرسي مطروح"> <span>مرسي مطروح</span> </option>
                                <option value="بور سعيد"> <span>بور سعيد</span> </option>
                                <option value="الإسماعيلة"> <span>الإسماعيلة</span> </option>
                                <option value="السويس"> <span>السويس</span> </option>
                                <option value="البحر الاحمر"> <span>البحر الاحمر</span> </option>
                                <option value="شمال سيناء"> <span>شمال سيناء</span> </option>                            
                                <option value="جنوب سيناء"> <span>جنوب سيناء</span> </option>
                                <option value="شرم الشيخ"> <span>شرم الشيخ</span> </option>
                                <option value="الوادي الجديد"> <span>الوادي الجديد</span> </option>
                                <option value="الفيوم"> <span>الفيوم</span> </option>
                                <option value="بني سويف"> <span>بني سويف</span> </option>
                                <option value="المنيا"> <span>المنيا</span> </option>
                                <option value="أسيوط"> <span>أسيوط</span> </option>
                                <option value="سوهاج"> <span>سوهاج</span> </option>
                                <option value="قنا"> <span>قنا</span> </option>
                                <option value="الأقصر"> <span>الأقصر</span> </option>                            
                                <option value="أسوان"> <span>أسوان</span> </option>                      
                            </select>
                            <input name="item_location_area"  type="text" tabindex="0" class="form-control" placeholder="المنطقة"  disabled="true">
                            <input name="item_location_naighbor"  type="text" tabindex="0" class="form-control" placeholder="الحي"  disabled="true">
                        </div>
                    </div> --}}

                    
                    <div class="text-center">
                        <button id="submit-form" type="submit" name="submit_btn" class="btn btn-outline-success w-100 mt-2">
                            <div class="spinner-border m-2 hidden" id="formLoading" style="height: 1rem;width:1rem"> 
                                <span class="visually-hidden"></span>
                            </div>
                            <i class="bi bi-cloud-arrow-up fs-15"></i> رفع
                        </button>
                    </div>

                    @csrf
                </form>
            </div>
        </div>

        <div id="editMyInfoModal" class="hidden smodal">
            <div class="card shadow show ani ani_fadeIn p-2 w-100">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label" >تعديل معلوماتي</label>
                        </div>
                        <div class="col-1 offset-2">
                            <i class="bi bi-x icon-15" onclick="document.querySelector('#editMyInfoModal').classList.toggle('hidden')"></i>
                        </div>
                    </div> 
                    <div class="location">
                        <label for=""><span>ادخل الموقع</span></label>               
                        <table>
                            <tr>
                                <td class="px-2 px-sm-1" ><small>المحافظة</small></td>
                                <td class="px-3 px-sm-4" ><small>المنطقة</small></td>
                                <td class="px-2 px-sm-1" ><small>الحي</small></td>
                            </tr>
                        </table>                
                        <div class="input-group">
                            <input type="text" aria-label="governent" list="covernent-list" class="form-control" zwire:model.defer="user_location.covernent">
                            
                            <input type="text" aria-label="area"  class="form-control" zwire:model.defer="user_location.area">
                            
                            <input type="text" aria-label="nighborhood"  class="form-control" zwire:model.defer="user_location.naighbor">
                        </div>
                        <datalist id="covernent-list">
                            <option value="القاهرة">
                            <option value="الجيزة">
                            <option value="القليوبية">
                            <option value="الشرقية">
                            <option value="المنوفية">
                            <option value="الغربية">
                            <option value="كفر الشيخ"> 
                            <option value="الدقهلية">
                            <option value="دمياط">
                            <option value="البحيرة">
                            <option value="الأسكندرية">
                            <option value="مرسي مطروح"> 
                            <option value="بور سعيد"> 
                            <option value="الإسماعيلة">
                            <option value="السويس">
                            <option value="البحر الاحمر"> 
                            <option value="شمال سيناء">                             
                            <option value="جنوب سيناء"> 
                            <option value="شرم الشيخ"> 
                            <option value="الوادي الجديد"> 
                            <option value="الفيوم">
                            <option value="بني سويف"> 
                            <option value="المنيا">
                            <option value="أسيوط">
                            <option value="سوهاج">
                            <option value="قنا">
                            <option value="الأقصر">                            
                            <option value="أسوان"> 
                        </datalist>
                        <div class="mt-5px" >                                        
                            <label for=""><span>ادخل رقم الهاتف</span></label><br>
                            <label for=""><small>(0201-01234567)</small></label>
                            <input class="form-control" type="text" inputmode="numeric" zwire:model.defer="user_phone" required />
                        </div> 
                        <span class="bi bi-check icon-1 cursor btn btn-outline-success mt-1 mb-1 w-100" zwire:click="setLocation">حفظ</span>                                
                    </div>
            </div>
        </div>
        
        
    </div>

    <span  id="cir-icon" class="cursor" >
        <i class="bi bi-list"></i>
        @if(count($user->notification) > 0)
            <span class="bi bi-dot red-alert icon-15"></span>
        @endif
    </span>
</div>