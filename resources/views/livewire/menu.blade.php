<div>
    <div id="navMenu" class="ver-menu text-center" onload="menuView()">
        <ul id="navList" class="ver-list ani ani_slideInRight ani_faster">            
            <li class="cursor ver-li " title="معلوماتي" >
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offsetxxx="-25,3" aria-expanded="false">
                        <i class="bi bi-person-square "></i>
                        معلوماتي
                        @if($user->location == 'not-set') 
                            <span class="bi bi-exclamation-circle red-alert icon-sm ani ani_flash ani_loop"></span>
                        @endif
                    </span>
                    <div class="dropdown-menu ani ani_fadeIn ani_faster min-wid-300 px-1 {{$user->location == 'not-set' ? 'ani ani_pulse ani_repeat-3' :''}}">
                        <div class="card shadow-sm position-relative p-1">
                            <div class="card-header row px-1">
                                <div class="col-8">
                                    <h5>{{$user->name}}</h5>
                                </div>
                                <div class="col-4 text-left">
                                    {{-- <span class="cursor icon-1 link-dark" onclick="document.querySelector('#editMyInfoModal').classList.toggle('hidden')"><i class="bi bi-pencil-square"></i></span> --}}
                                    <span id="darkTheme" class="m-1 cursor icon-1 link-dark {{$theme == 'dark' ? 'hidden' : '' }}" onclick="
                                        document.querySelector('#darkTheme').classList.add('hidden');
                                        document.querySelector('#lightTheme').classList.remove('hidden');
                                        toggleTheme('dark');" title="Night Mode"><i class="bi bi-moon-stars"></i>
                                    </span>

                                    <span id="lightTheme" class="m-1 cursor icon-1 link-dark {{$theme == 'light' || $theme == null? 'hidden' : '' }} " onclick="
                                        document.querySelector('#lightTheme').classList.add('hidden');
                                        document.querySelector('#darkTheme').classList.remove('hidden');
                                        toggleTheme('light');" title="Day Mode" style="color: #eee"><i class="bi bi-gear-wide"></i>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="text-muted row p-0">
                                    @if(strpos($user->email,"@Swaply.com") != false)
                                    <div class="row p-0">
                                        <div class="col-10">
                                            <i class="bi bi-envelope"></i> {{$user->email}}
                                        </div>
                                        <div class="col-2 text-left">
                                            <i onclick="document.querySelector('#setEmailModal').classList.toggle('hidden')" class="bi bi-pencil-square"></i>
                                        </div>
                                    </div>
                                    @else 
                                        <small><i class="bi bi-envelope"></i> {{$user->email}}</small>
                                    @endif                                    
                                </div>                                
                                <div class="text-muted"><i class="bi bi-phone"></i> {{$user->phone}}</div>
                                <div class="text-muted"><i class="bi bi-geo-alt"></i> {{$user->location}}</div>  
                                <div class="row">
                                    {{--
                                        <div class="col">
                                            <small title="مبادلاتي" class="glow mx-1"> <i class="bi bi-arrow-down-up"></i> {{$user->swaps}}</small>
                                            <small title="تبرعاتي" class="glow mx-1"> <i class="bi bi-person"></i> 0 </small> 
                                            <small title="اغراضي" class="glow mx-1"> <i class="bi bi-card-list"></i> {{count($user->items)}}  </small>
                                        </div>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="cursor ver-li" title="منشوراتي">
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <i class="bi bi-collection "></i>
                        منشوراتي
                    </span>
                    <div class="dropdown-menu ani ani_fadeIn ani_faster min-wid-300 px-1" >
                        <small wire:click="$emitTo('body','changeBody','items')" class="p-1 cursor btn btn-outline-success "> <i class="bi bi-card-list"></i> عرض الكل <span class="badge bg-green">{{count($user->items)}}</span></small>
                        @forelse($user->items as $item)
                            <div class="list-group mt-1 {{$item->status ==1 ? 'br-success' : ''}}" wire:click="$emit('changeBody',['showitem','{{$item->id}}'])">
                                <span class="list-group-item list-group-item-action" aria-current="true">
                                    <h6 class="m-0"> <i class="bi bi-card-text"></i> {{$item->item_title}}
                                        <small class="text-muted "> <i class="bi bi-calendar-day"></i> {{$item->created_at->diffForHumans()}} </small>
                                    </h6>
                                    <div class="row">
                                        <div class="col text-muted">
                                            <small class="card-subtitle m-0">
                                                <span> <i class="bi bi-distribute-horizontal"></i> {{$item->item_type == 1 ? 'مبادلة' : ($item->item_type == 2 ? 'بيع' : 'تبرع')}} |</span>
                                            </small>
                                            <small class=" {{$item->item_type != 1 ? 'hidden' : ''}}"><i class="mx-1 bi bi-arrow-down-up"></i> {{$item->swap_with}} |</small>
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
                    <span class="ver-link p-1" wire:click="$emitTo('body','changeBody','create')">                        
                        <i class="bi bi-plus-square-dotted icon-2"></i>
                        إضافة
                    </span>               
                </div>
            </li> 
            <li class="cursor ver-li" title="اشعارات" >
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <i class="bi bi-bell "></i>
                        اشعارات
                        @if(is_countable($user->notification) && count($user->notification) >0 )
                            <span class="bi bi-exclamation-circle red-alert icon-sm"></span>
                        @endif
                    </span>
                    <div class="dropdown-menu ani ani_fadeIn ani_faster min-wid-300 px-2">
                        <span class="btn btn-outline-danger text-left py-1" wire:click="removeNotis()"> 
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
            <li class="cursor ver-li" title="صفحات">
                <div class="dropend">
                    <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid-3x3-gap"></i>
                        صفحات
                    </span>
                    <div class="dropdown-menu ani ani_fadeIn ani_faster px-1">
                        <div class="card">
                            <ul class="" style="list-style: none;padding:0;">
                                <li class="cursor" wire:click="$emitTo('body','changeBody','recommends')">
                                    <span class="dropdown-item" > 
                                        @if($user->recommends > 0)
                                            <span class="bi bi-dot red-alert icon-15"></span>
                                        @endif
                                        <i class="bi bi-bookmark-plus"></i> <span>تطابقات</span> </span>
                                </li>
                                @if($user->hasSwapekia == true)
                                    <li class="cursor" wire:click="$emitTo('body','changeBody','pekias')">
                                        <span class="dropdown-item" > <i class="bi bi-megaphone"></i> <span>سوابيكيا</span> </span>
                                    </li>
                                @endif
                                <li class="cursor" wire:click="$emitTo('body','changeBody','swaps')">
                                    <span class="dropdown-item" > <i class="bi bi-arrow-down-up"></i> <span>مبادلات</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','requests')">
                                    <span class="dropdown-item" > <i class="bi bi-arrow-bar-up"></i> <span>مرسلات</span> </span>
                                </li>
                                <li class="cursor" wire:click="$emitTo('body','changeBody','saves')">
                                    <span class="dropdown-item" > <i class="bi bi-save"></i> <span>محفوظات</span> </span>
                                </li>
                                <li class="cursor">
                                    <a href="{{route('about')}}" class="dropdown-item"> <i class="bi bi-exclamation-circle"></i> <span>حول سوابلي</span> </a>
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
                                        <i class="bi bi-door-open cr "></i><small class="mx-1">خروج</small>
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
        </ul>      
    </div>

    <div id="setEmailModal" class="hidden smodal">
        <div class="card shadow show ani ani_fadeIn p-3 w-100" >
            <div class="row p-1">
                <div class="col-9">
                    <small class="form-label" >ادخل بريدك الألكتروني</small>
                </div>
                <div class="col-1 offset-1">
                    <i class="bi bi-x" onclick="document.querySelector('#setEmailModal').classList.toggle('hidden')"></i>
                </div>
            </div>
            <div class="location">
                <div class="input-group">
                    <input wire:model.defer="email" type="email" class="form-control text-right" placeholder="{{$user->email}}">
                </div>
                <span class="bi bi-check icon-1 cursor btn btn-outline-success mt-2 mb-1 w-100" wire:click="setUserEmail">حفظ</span>                                
            </div>
        </div>
    </div>

    @if(Auth::user()->location != 'not-set' && Auth::user()->phone != 'not-set')
        <div id="editMyInfoModal" class="hidden smodal">
            <div class="card shadow show ani ani_fadeIn p-2 w-100">
                <div class="row py-1">
                    <div class="col-8">
                        <label class="form-label" >تعديل معلوماتي</label>
                    </div>
                    <div class="col-1 offset-2">
                        <i class="bi bi-x icon-15" onclick="document.querySelector('#editMyInfoModal').classList.toggle('hidden')"></i>
                    </div>
                </div>
                <div class="location">
                    <label for=""><span>ادخل الموقع</span></label>
                    <div class="input-group">
                        <input type="text" aria-label="governent" list="covernent-list" class="form-control" placeholder="{{explode('-',Auth::user()->location)[0]}}" wire:model.defer="userInfo.location.covernent">
                    
                        <input type="text" aria-label="area"  class="form-control" placeholder="{{explode('-',Auth::user()->location)[1]}}" wire:model.defer="userInfo.location.area">
                    
                        <input type="text" aria-label="nighborhood"  class="form-control" placeholder="{{explode('-',Auth::user()->location)[2]}}" wire:model.defer="userInfo.location.naighbor">
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
                        <option value="الإسماعيلية">
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
                        <input class="form-control" type="text" inputmode="numeric" wire:model.defer="userInfo.phone" placeholder="{{Auth::user()->phone}}" required />
                    </div> 
                    <span class="bi bi-check icon-1 cursor btn btn-outline-success mt-2 mb-1 w-100" wire:click="updateInfo">حفظ</span>                                
                </div>
            </div>
        </div>
    @endif
</div>