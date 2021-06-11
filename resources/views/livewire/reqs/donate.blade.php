<div>
    <div class="card-footer text-center ">    
        <button class="btn btn-outline-success bg-white w-50 mb-1 mt-1 py-2" onclick="document.querySelector('#offer{{$feed->id}}').classList.toggle('hidden')">
            <span>أطلب</span>
        </button>  
        <div class="modal-dialog hidden mx-auto mb-1 mt-0 ani ani_fadeIn" id="offer{{$feed->id}}">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="">سبب الطلب</label>
                    <textarea id="" rows="2" maxlength="250" class="form-control" wire:model.defer="req_why"></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="btn-group" role="group">
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
</div>
