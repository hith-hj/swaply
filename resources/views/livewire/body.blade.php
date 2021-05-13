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
                        <h5 class="modal-title m-0"><i class="bi bi-flag cr"></i> تبليغ مشكلة</h5>
                    </div>
                    <div class="modal-body">
                        <!-- <label for="" class="form-label">نوع المشكلة</label>
                        <input type="text" class="form-control" wire:model.defer="problem.type"> -->
                        <label for="" class="form-label">وضح لنا المشكلة لو سمحت</label>
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
    <div class="col text-center mspinner" wire:loading >
        <div class="m-4" >
            <div class="spinner-border" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div> 
    </div>
</div>





