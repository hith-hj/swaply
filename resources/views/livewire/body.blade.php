<div class="body ani ani_fadeIn">
    @switch($body)
        @case('feeds')
            @livewire('feeds')
            @break
        @case('items')
            @livewire('items')
            @break
        @case('showitem')
            @livewire('showitem',['g_id' => $g_id])
            @break
        @case('showitem1')
            @livewire('showitem',['g_id' => $g_id])
            @break    
        @case('swaps')
            @livewire('swaps')
            @break
        @case('requests')
            @livewire('rexust')
            @break
        @case('saves')
            @livewire('saves')
            @break 
        @case('recommends')
            @livewire('recommends')
            @break
        @case('loading')
            <div class="text-center m-4">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
            @break
        @case('reportProblem')
            <h4 class="text-center mb-2 mt-2">نأمل ان يكون اقتراح</h4>
            <div class="alert alert-light ani ani_pulse" role="alert">
                <div class="w-95 mx-auto mt-0 z-100">
                    <div class="modal-header">
                        <h5 class="modal-title m-0"><i class="bi bi-flag cr"></i> اقتراح او تبليغ مشكلة</h5>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">اختر نوع البلاغ</label>
                        <input type="text" class="form-control" list="reportTypeList" wire:model.defer="problem.type">
                        <datalist id="reportTypeList">
                            <option value="اقتراح">
                            <option value="مشكلة">
                        </datalist>
                        <label for="" class="form-label">وضح لنا لو سمحت</label>
                        <textarea class="form-control my-1" wrap="hard" rows="2" wire:model.defer="problem.info"></textarea>
                    </div>
                    <div class="modal-footer justify-content-center">                    
                        <button type="button" class="sbtn sbtn-txt mx-1" wire:click="reportProblem"><span>ارسال</span></button>
                        <button type="button" class="sbtn sbtn-txt mx-3" data-bs-dismiss="modal" wire:click="$emit('changeBody','feeds')"><span>أغلاق</span></button>
                    </div>
                </div>
            </div>
            @break
        @case('termsOfUse')
            <div class="card w-100 mt-1">
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <h3>شروط الاستخدام</h3>
                    </div>
                    <div class="px-4">
                        <ol style="list-style: arabic-indic;">
                            <li class="py-2">الرجاء التعامل بمصداقية</li>
                            <li class="py-2">الرجاء الألتزام بالقيم الأخلاقية اللازمة</li>
                            <li class="py-2">الرجاء عدم نشر اي شي يخل بالأداب العامة </li>
                            <li class="py-2">الرجاء رفع صور الغرض بشكل واضح و بدون تعديل</li>
                            <li class="py-2">الرجاء الألتزام بشروط الأستخدام لعدم التعرض لحذف الحساب</li>
                            {{-- <li></li> --}}
                        </ol>
                    </div>
                </div>
            </div>
            @break
        @default 
            <div class="text-center m-4" >
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>           
    @endswitch

    @if(Auth::user()->location == 'not-set' && Auth::user()->phone == 'not-set')
        <div class="smodal ">
            <div class="card shadow show ani ani_fadeIn p-1 min-wid-300 w-100" style="min-width: 18.4rem !important;">
                <div class="location p-2">
                    <label for=""><span>ادخل الموقع</span></label>              
                    <div class="input-group">
                        <input type="text" aria-label="governent" list="covernent-list" class="form-control w-25" wire:model.defer="user_location.covernent" placeholder="محافظة">
                        
                        <input type="text" aria-label="area"  class="form-control" wire:model.defer="user_location.area" placeholder="منطقة">
                        
                        <input type="text" aria-label="nighborhood"  class="form-control" wire:model.defer="user_location.naighbor" placeholder="حي">
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
                        <input class="form-control" type="text" inputmode="numeric" wire:model.defer="user_phone" placeholder="01-012345678" required />
                    </div> 
                    <span class="bi bi-check icon-1 cursor btn btn-outline-success mt-1 mb-1 w-100" wire:loading.class="hidden" wire:click="setLocation">حفظ</span> 
                    <div class="col text-center mspinner" wire:loading >
                        <div class="m-4" >
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </div> 
                    </div>                               
                </div>
            </div>
        </div> 
    @endif

    <div class="col text-center mspinner" wire:loading >
        <div class="m-4" >
            <div class="spinner-border" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div> 
    </div>
</div>





