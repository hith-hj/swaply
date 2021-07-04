@extends('layouts.sapp')
@section('content')
<div class="fullPage pb-2 " style="min-height: 90vh;overflow:auto;padding-bottom:10rem" >
   <div id="center">
    <div class="card shadow text-center ani ani_slideInUp w-100 m-0 mt-1" role="alert">
        <div class="row">
            <h6>عودة إلى</h6>
            <div class="col-12 w-100 py-3">
                <a class="btn btn-outline-success" href="{{ route('login') }}">تسجيل دخول</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline-success px-3" href="{{ route('register') }}">اشتراك</a>
                @endif
            </div>
        </div>
    </div>
    <div id="createItem" class="col mb-2 mt-1 ani ani_fadeIn">
        @if ($errors->any())
        <div class="alert alert-danger text-center ani ani_slideInUp w-100 m-0" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
                <br>
            @endforeach
        </div>
        @endif
       
        <div class="card shadow">
            <div class="card-body" >
                <form id="add-item-form" action="{{url('/guestAdd/item')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-8 py-1">
                            <label class="px-2 ">إضافة غرض</label>
                        </div>
                    </div>

                    <div id="imgs_collection" class="hidden"></div>
                    <div class="js-upload upload mb-1" uk-form-custom>
                        <input name="item_imgs[]" multiple type="file" id="itemgs" accept="image/*" tabindex="0" onchange="image_resizer(event,'item')" hidden>
                        <button name="anunimus1" tabindex="0" type="button" onclick="document.querySelector('#itemgs').click()" class="cursor sbtn sbtn-txt light ani ani_flash">
                            <i class="bi bi-images mx-2"></i>إختر صور
                        </button>
                    </div>

                    <select required name="item_type" id="item_type" class="form-control mb-1 ani ani_flash" style="font-family: cairo" value="{{old('item_type')}}" onchange="
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

                    <input name="item_title" type="text" class="form-control mb-1" placeholder="اسم الغرض" autocomplete="off" value="{{old('item_title')}}" required>

                    <textarea name="item_description" wrap="hard" class="form-control mb-1" rows="2" maxlength="250" placeholder="وصف الغرض" autocomplete="off" required>{{old('item_description')}}</textarea>

                    <input name="swap_with" type="text" id="swap_with" placeholder="بديل الغرض" class="form-control mb-1 ani ani_fadeIn" title="الاسم واضح" value="{{old('swap_with')}}" autocomplete="off" required>

                    <input id="item_price" type="text" inputmode="numeric" name="amount" class="form-control  ani ani_fadeIn" title="اختياري" placeholder="فرق السعر (اختياري)" value="{{old('amount')}}"  autocomplete="off" >
                    
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
                    @guest
                    <hr class="mt-2">
                    <label class="px-2 ">معلومات الحساب</label>
                    <p class="cr">{{session()->get('error')}}</p>
                    <input name="name" type="text" class="form-control mb-1" placeholder="الأسم" value="{{old('name')}}" autocomplete="off" required>
                    <input name="password" type="password" class="form-control mb-1" placeholder="كلمة المرور 8 احرف على الأقل" autocomplete="off" required>
                    <div class="input-group">
                        <label for="">هل انت مستخدم جديد ؟</label>
                        <input type="radio" required name="new_user" value="1"  class="m-1" id=""> نعم                       
                        <input type="radio" name="new_user" value="0"  class="m-1" id="">   لا                     
                    </div>
                    @endguest
                    <hr class="mb-2">
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
</div> 
</div>
@endsection

