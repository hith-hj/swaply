<div class="body">
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
            @livewire('showitem1',['g_id' => $g_id])
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
            <hr>
            <div class="alert alert-light ani ani_flash" role="alert">
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
        @default 
            <div class="text-center m-4" >
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>           
    @endswitch

    @if(Auth::user()->location == 'not-set' && Auth::user()->phone == 'not-set')
        <div class="smodal ">
            <div class="card shadow show ani ani_fadeIn p-1 min-wid-300 w-100" >
                <div class="location p-2">
                    <label for=""><span>ادخل الموقع</span></label>               
                    <table>
                        <tr>
                            <td class="px-2 px-sm-1" ><small>المحافظة</small></td>
                            <td class="px-3 px-sm-4" ><small>المنطقة</small></td>
                            <td class="px-2 px-sm-1" ><small>الحي</small></td>
                        </tr>
                    </table>                
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
                    <div class="mt-5px" >                                        
                        <label for=""><span>ادخل رقم الهاتف</span></label><br>
                        <label for=""><small>(0201-01234567)</small></label>
                        <input class="form-control" type="text" inputmode="numeric" wire:model.defer="user_phone" required />
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





