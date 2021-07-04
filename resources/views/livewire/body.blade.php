<div class="body ani ani_fadeIn" id="pagesBody">
    @switch($body)
        @case('create')
            @livewire('create')
            @break
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
        @case('pekias')
            @livewire('pekias')
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
        @case('searchResult')
            @livewire('search-result',['query' => $g_id])
            @break
        @case('reportProblem')
            <div class="alert alert-light ani ani_slideInUp p-0 m-0 mt-1 mb-1">
                <h4 class="text-center">نأمل ان يكون اقتراح</h4>
            </div>
            <div class="alert alert-light ani ani_pulse m-0" role="alert">
                <div class="w-100 mx-auto mt-0">
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
                    <div class="modal-footer justify-content-center btn-group">                    
                        <button type="button" class="btn btn-outline-danger " wire:click="reportProblem"><span>ارسال</span></button>
                        <button type="button" class="btn btn-outline-dark " data-bs-dismiss="modal" wire:click="$emit('changeBody','feeds')"><span>أغلاق</span></button>
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
                            <li class="py-2">
                                حرصا منا على سلامتك نرجو منك اتباعك هذة التعليمات : 
                                <ol style="list-style: arabic-indic;" class="px-4">
                                    <li class="py-2">قابل البائع في مكان عام  <strong> هام جدا </strong> </li>
                                    <li class="py-2">خد حد معاك وانت رايح تقابل اي حد</li>
                                    <li class="py-2">افحص الغرض جيدا قبل ان تتم العملية وتأكد منه</li>
                                </ol>
                            </li>
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
                        <select class="form-control w-25" wire:model.defer="user_location.covernent">
                            <option value="القاهرة"><span> القاهرة</span></option>
                            <option value="الجيزة"><span> الجيزة</span></option>
                            <option value="القليوبية"><span> القليوبية</span></option>
                            <option value="الشرقية"><span> الشرقية</span></option>
                            <option value="المنوفية"><span> المنوفية</span></option>
                            <option value="الغربية"><span> الغربية</span></option>
                            <option value="كفر الشيخ"><span> كفر الشيخ</span></option> 
                            <option value="الدقهلية"><span> الدقهلية</span></option>
                            <option value="دمياط"><span> دمياط</span></option>
                            <option value="البحيرة"><span> البحيرة</span></option>
                            <option value="الأسكندرية"><span> الأسكندرية</span></option>
                            <option value="مرسي مطروح"><span> مرسي مطروح</span></option> 
                            <option value="بور سعيد"><span> بور سعيد</span></option> 
                            <option value="الإسماعيلية"><span> الإسماعيلية</span></option>
                            <option value="السويس"><span> السويس</span></option>
                            <option value="البحر الاحمر"><span> البحر الاحمر</span></option> 
                            <option value="شمال سيناء"><span> شمال سيناء</span></option>
                            <option value="جنوب سيناء"><span> جنوب سيناء</span></option> 
                            <option value="شرم الشيخ"><span> شرم الشيخ</span></option> 
                            <option value="الوادي الجديد"><span> الوادي الجديد</span></option>
                            <option value="الفيوم"><span> الفيوم</span></option>
                            <option value="بني سويف"><span> بني سويف</span></option> 
                            <option value="المنيا"><span> المنيا</span></option>
                            <option value="أسيوط"><span> أسيوط</span></option>
                            <option value="سوهاج"><span> سوهاج</span></option>
                            <option value="قنا"><span> قنا</span></option>
                            <option value="الأقصر"><span> الأقصر</span></option>
                            <option value="أسوان"><span> أسوان</span></option>
                        </select>

                        <input type="text" aria-label="area"  class="form-control" wire:model.defer="user_location.area" placeholder="منطقة">
                        
                        <input type="text" aria-label="nighborhood"  class="form-control" wire:model.defer="user_location.naighbor" placeholder="حي">
                    </div>
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
