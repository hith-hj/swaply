<div>
    <div id="createItem" class="col mb-2 mt-1 ani ani_fadeIn ani_faster">
        <div class="card shadow">
            <div class="card-body" >
                <form id="add-item-form" onsubmit="AddNew(event,'item')" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-8 py-1">
                            <label class="px-2 ">إضافة منشور</label><br>
                            <small class="glow cursor" onclick="
                            document.querySelector('#createItem').classList.toggle('hidden');
                            document.querySelector('#createPekia').classList.toggle('hidden');
                            "><i class="bi bi-plus" ></i>  سوابيكيا بيع لسوابلي </small>
                        </div>
                        <div class="col-4 text-left cursor">
                            <i class="bi bi-x fs-2" onclick="resetForm();" wire:click="$emitTo('body','changeBody','feeds')"></i>
                        </div>
                    </div>

                    <div id="imgs_collection" class="hidden"></div>
                    <div class="js-upload upload mb-1" uk-form-custom>
                        <input name="item_imgs[]" multiple type="file" id="itemgs" accept="image/*" tabindex="0" onchange="image_resizer(event,'item')" hidden>
                        <button name="anunimus1" tabindex="0" type="button" onclick="document.querySelector('#itemgs').click()" class="cursor sbtn sbtn-txt light ani ani_flash">
                            <i class="bi bi-images mx-2"></i>إختر صور
                        </button>
                    </div>

                    <select required name="item_type" id="item_type" class="form-control mb-1 ani ani_flash" style="font-family: cairo" onchange="
                            let swap =  document.querySelector('#swap_with');
                            let price = document.querySelector('#item_price');
                            let note = document.querySelector('#swaply_percent');
                            if(this.value == 1){
                                swap.classList.remove('hidden');
                                swap.value = '';
                                price.placeholder = 'فرق السعر (اختياري)';
                                price.hidden = false;
                                // note.hidden = true;
                            }else if(this.value == 2){
                                swap.classList.add('hidden');
                                swap.value = 'trade';
                                price.placeholder = 'سعر الغرض';
                                price.hidden = false;
                                // note.hidden = false;  
                                let oldperc = document.querySelector('#percent')
                                if(oldperc != null) swaply_percent.removeChild(oldperc);                          
                            }else{
                                swap.classList.add('hidden');
                                swap.value = 'donation';
                                price.hidden = true;
                                // note.hidden = true;
                            }">
                            <option value="">إختر نوع المنشور</option>
                            <option value="1">مبادلة</option>
                            <option value="2">مبيع</option>
                            <option value="3">تبرع</option>
                    </select>

                    <input name="item_title" type="text" class="form-control mb-1" placeholder="اسم الغرض" autocomplete="off" required>

                    <textarea name="item_description" wrap="hard" class="form-control mb-1" rows="2" maxlength="250" placeholder="وصف الغرض" autocomplete="off" required></textarea>

                    <input name="swap_with" type="text" id="swap_with" placeholder="بديل الغرض" class="form-control mb-1 ani ani_fadeIn" title="الاسم واضح"  autocomplete="off" required>

                    <input id="item_price" type="text" inputmode="numeric" name="amount" class="form-control  ani ani_fadeIn" title="اختياري" placeholder="فرق السعر (اختياري)"  autocomplete="off" >
                    
                    {{-- <input id="item_price" type="text" inputmode="numeric" name="amount" class="form-control  ani ani_fadeIn" title="اختياري" placeholder="فرق السعر (اختياري)"  autocomplete="off" 
                    onchange="
                        setTimeout(()=>{
                            let item_type = document.querySelector('#item_type');
                            let swaply_precent = document.querySelector('#swaply_percent')
                            if(item_type.value == 2 && this.value.length > 0)
                            {
                                if(!isNaN(parseInt(this.value))){
                                    let percent = Math.ceil(parseInt(this.value) + parseInt(this.value) * 0.05)
                                    let oldperc = document.querySelector('#percent')
                                    if(oldperc != null) swaply_percent.removeChild(oldperc);
                                    let span = document.createElement('span');
                                    span.setAttribute('id','percent');
                                    span.textContent =` ( السعر بعد الإضافة ${percent} ) `;
                                    swaply_percent.appendChild(span);
                                }else{
                                    let strong = document.createElement('strong');
                                    strong.setAttribute('id','percent');
                                    strong.textContent =` القيمة المدخلة خاطئة`;
                                    swaply_percent.appendChild(strong);
                                }
                            }
                        },300);
                    ">
                    <small id="swaply_percent" style="font-size: 10px" class=" ani ani_fadeIn" hidden> سوابلي سوف يضيف 5% على سعر الغرض</small> --}}
                    
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
                            <i class="bi bi-cloud-arrow-up fs-15"></i> إضافة
                        </button>
                    </div>

                    @csrf
                </form>
            </div>
        </div>
    </div>

    <div id="createPekia" class="col mb-2 mt-1 ani ani_fadeIn ani_faster hidden">
        <div class="card shadow">
            <div class="card-body" >
                <form id="add-pekia-form" onsubmit="AddNew(event,'pekia')" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-8 py-1">
                            <label class="px-2 ">طلب سوابيكيا </label><br>
                            <small style="font-size: 10px" class="px-3 ani ani_fadeIn" >الرجاء تحقق بأستمرار من طلبك </small>  
                        </div>
                        <div class="col-4 text-left cursor">
                            <small>
                                <i class="bi bi-arrow-right fs-2" onclick="
                                document.querySelector('#createItem').classList.toggle('hidden');
                                document.querySelector('#createPekia').classList.toggle('hidden');
                                resetPekiaForm();"></i>
                            </small>
                            <small>
                                <i class="bi bi-x fs-2" onclick="resetForm();" wire:click="$emitTo('body','changeBody','feeds')"></i>
                            </small>                      
                        </div>
                    </div>
                    <div id="pekia_collection" class="hidden"></div>
                    <div class="js-upload upload mb-1" uk-form-custom>
                        <input name="pekia_imgs[]" multiple type="file" id="pekiaimgs" accept="image/*" tabindex="0" onchange="image_resizer(event,'pekia')" hidden>
                        <button name="anunimus2" class="cursor sbtn sbtn-txt light ani ani_flash" tabindex="0" type="button" onclick="document.querySelector('#pekiaimgs').click()" autofocus>
                            <i class="bi bi-images mx-2"></i>إختر صور
                        </button>
                    </div>

                    <div class="input-group">
                        <input name="pekia_title" type="text" class="form-control mb-1" placeholder="اسم الغرض" autocomplete="off" required>
                        <input name="pekia_price" id="pekia_price" type="text" inputmode="numeric" class="form-control mb-1" placeholder="السعر" autocomplete="off" >
                    </div>
                    <label class="" > 
                        <span onclick="getLocation()"> <i class="bi bi-geo"></i> تحديد الموقع </span>
                        <i class="bi bi-exclamation" onclick="document.querySelector('#whyNeedLocation').classList.toggle('hidden')"></i> 
                    </label>
                    <br>
                    <div>                    
                        <label id="geoInfo" style="font-size: 12px" class=" ani ani_fadeIn" >                        
                            يرجا ادخال الموقع الدقيق من اجل اتمام العملية
                        </label>
                        <br><label class="hidden" id="whyNeedLocation" style="font-size: 12px">يتم طلب الموقع بدقة لاننا نحتاجة لارسال مندوبينا الي مكان الغرض</label>
                    </div>
                    

                    <div id="mapholder" class="px-3" style="max-height: 300px;max-width:520px;"></div>

                    <div class="text-center">
                        <button id="submit-pekia-form" type="submit" name="pekia_submit_btn" class="btn btn-outline-success w-100 mt-2">
                            <div class="spinner-border m-2 hidden" id="pekiaFormLoading" style="height: 1rem;width:1rem"> 
                                <span class="visually-hidden"></span>
                            </div>
                            <i class="bi bi-cloud-arrow-up fs-15"></i> إرسال
                        </button>
                    </div>

                    <input type="hidden" name="user_exact_location" id="user_exact_location" value="null" required>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
