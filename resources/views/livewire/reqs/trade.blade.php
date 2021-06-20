<div>
    <div class="card-footer text-center ">    
        <button class="btn btn-outline-success bg-white w-50 w-100 mb-1 mt-1 py-1" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')">
            <span>طلب شراء</span>
        </button>  
        <div class="modal-dialog hidden mx-auto mb-1 mt-0 ani ani_fadeIn" id="offer{{$feed->id}}">
            <div class="modal-content">
                <div class="modal-body">
                    <small> بأمكانك تقديم طلب تبديل  لهذا المنشور  <strong class="cursor" onclick="document.querySelector('#tradeWith{{$feed->id}}').classList.toggle('hidden')">أضف غرض</strong></small>
                    <div id="tradeWith{{$feed->id}}" class="hidden">
                        @if(isset($feed->user_items) && count($feed->user_items) > 0)
                            <div class="modal-body ">                    
                                <label for="" class="form-label"></label>
                                <select class="form-select bg-gray" wire:model.defer="req_item">
                                    <option value="{{$feed->user_items[0]->id}}">اختر</option>
                                    @foreach ($feed->user_items as $myitem)
                                        <option value="{{$myitem->id}}" >{{$myitem->item_type == 1 ? 'مبادلة' : ($myitem->item_type == 2 ? 'بيع' : 'تبرع')}} - {{$myitem->item_title}}</option>
                                    @endforeach
                                </select>                   
                            </div>
                        @else 
                            <label for="" class="form-label">الرجاء اضافة غرض  قبل ارسال الطلب</label>
                            <small onclick="document.querySelector('#newItemModal').classList.toggle('hidden')" class="w-50 m-auto py-1 mt-2 mb-2 btn btn-outline-success"> <span>اضغط للإضافة</span></small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-center btn-group">
                    <button type="button" class="btn btn-outline-success " wire:click="sendOffer('{{$feed->id}}','{{$feed->user_id}}','{{$feed->item_type}}')">
                        <i class="bi bi-cloud-upload mx-2"></i>
                        <small>ارسال</small>
                    </button> 
                    <button type="button" class="btn btn-outline-dark " onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')">
                        <i class="bi bi-x mx-2"></i>
                        <small>أغلاق</small>
                    </button>
                </div>
            </div>
        </div>                      
    </div>
</div>
