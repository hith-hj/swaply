{{--  --}}

<div id="navMenu" class="ver-menu">
    <ul id="navList" class="ver-list">
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="حمل التطبيق">
            <div class="install-btn">
                <a href="#" class="ver-link"><i class="bi bi-download"></i></a>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="الرئيسية">
            <a href="#" class="ver-link">
                <i class="bi bi-house"></i>
                <span class="bi bi-exclamation-circle noti icon-sm-5"></span>
            </a>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="معلوماتي">
            <div class="dropend">
                <a href="#" class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-30,5" aria-expanded="false">
                    <i class="bi bi-person "></i>
                </a>
                <div class="dropdown-menu min-wid-300">
                    <div class="text-center">
                        <div class="card-body">
                            <h5 class="card-title">أسم المستخدم</h5>
                            <p class="text-muted card-text"> موقع المستخدم </p>
                            <p class="text-muted card-text"> البريد الالكتروني </p>
                            <p class="text-muted card-text"> رقم الهاتف </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">swaps</li>
                                <!-- <li class="list-inline-item vertical-divider"></li> -->
                                <li class="list-inline-item">items</li>
                            </ul>
                        </div>
                        <hr>
                        <div class=" text-muted">
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-dark btn-sm"><i class="bi bi-gear ml-1"></i><span>اعداداتي</span></button>
                                <button type="button" class="btn btn-outline-dark btn-sm"><i class="bi bi-file-text ml-1"></i><span>معلوماتي</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="أغراضي">
            <div class="dropend">
                <a href="#" class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-50,5" aria-expanded="false">
                    <i class="bi bi-card-list "></i>
                </a>
                <div class="dropdown-menu min-wid-300">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">عنوان</h6>
                                <small>3 days ago</small>
                            </div>
                            <small>شوية محتوى هون</small>
                        </a>
                    </div>
                </div>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="اضافة غرض جديد" id="addItemForm">
            <div class="dropend dataForm">
                <a href="#" class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-100,6" data-bs-reference="parent" aria-expanded="false">
                    <i class="bi bi-plus-square-dotted icon-25"></i>
                </a>
                <div id="dataForm" class="dropdown-menu min-wid-300" role="menu">
                    <!-- onsubmit="AddItem(event) " action="{{ route( 'addItem') }} " method="POST " enctype="multipart/form-data " -->
                    <form id="add-item-form" class="text-center">
                        <input name="item_type" type="text" class="form-control mb-1" placeholder="اسم الغرض" aria-label="location" aria-describedby="location-input">
                        <div class="input-group mb-1">
                            <a id="setLocation" class="btn btn-outline-link glow bi bi-geo-alt" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="اضف موقعي " onclick=" 
                                document.querySelector('#location-input').value='{{ Auth::user()->location }}' ;
                                document.querySelector('#location-input').setAttribute('disabled','true'); 
                                document.querySelector('#setLocation').setAttribute('hidden','true');
                                document.querySelector('#resetLocation').removeAttribute('hidden'); "></a>
                            <a id="resetLocation" class="btn btn-outline-link glow bi bi-arrow-repeat" hidden href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="إعادة ضبط" onclick=" 
                                document.querySelector('#location-input').value='' ; 
                                document.querySelector('#location-input').removeAttribute('disabled'); 
                                document.querySelector('#setLocation').removeAttribute('hidden'); 
                                document.querySelector('#resetLocation').setAttribute('hidden','true'); "></a>
                            <input name="item_location" class="form-control" id="location-input" type="text" list="location-list" xrequired placeholder="المحافظة-الحي">
                            <datalist id="location-list" style="text-align: right ">
                                <option value="القاهرة ">
                                <option value="الاسكندرية ">
                                <option value="اسيوط ">
                                <option value="اسماعيلية ">
                                <option value="طنطة ">
                                <option value="سوهاج ">
                                <option value="اسوان ">
                                <option value="جينه ">
                            </datalist>
                        </div>
                        <input name="swap_with" type="text" placeholder="عايز تبدل الغرض بأيه " class="form-control mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="واضح" xrequired>

                        <textarea name="item_description" wrap="hard" class="form-control mb-1" rows="2" data-bs-toggle="tooltip" data-bs-placement="top" title="اختياري" placeholder="وصف عن الغرض"></textarea>
                        <div id="imgs_collection" hidden>
                        </div>
                        <div class="js-upload upload mb-1" uk-form-custom>
                            <input name="item_imgs[]" multiple type="file" id="itemgs" onchange="displayUploadedImages(event)" hidden>
                            <label for="itemgs" class="cursor sbtn-txt "> <i class="bi bi-images"></i>
                                أختر صور</label>
                        </div>
                        <button id="submit-form" type="submit" name="submit_btn" class="sbtn sbtn-txt">
                            <i class="bi bi-cloud-arrow-up icon-15"></i> رفع</button>
                    </form>
                </div>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="اشعارات">
            <div class="dropend">
                <a href="#" class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-50,6" aria-expanded="false">
                    <i class="bi bi-bell "></i>
                </a>
                <div class="dropdown-menu min-wid-300">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">عنوان</h6>
                                <small>3 days ago</small>
                            </div>
                            <small>شوية محتوى هون</small>
                        </a>
                    </div>
                </div>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="صفحات">
            <div class="dropend">
                <a href="#" class="ver-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="-50,6" aria-expanded="false">
                    <i class="bi bi-collection "></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#"> <i class="bi bi-arrow-bar-down"></i> <span>طلبات</span> </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"> <i class="bi bi-arrow-down-up"></i> <span>مبادلات</span> </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"> <i class="bi bi-save"></i> <span>محفوظات</span> </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"> <i class="bi bi-bookmark-plus"></i> <span>مقترحات</span> </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="ver-li" bs-toggle="tooltip" bs-placement="top" title="خروج (خليك معنا)">
            <a href="#" class="ver-link">
                <i class="bi bi-box-arrow-right "></i>
            </a>
        </li>
    </ul>
    <label id="cir-icon" class="centar cursor"><i class="bi bi-list"></i></label>
</div>
