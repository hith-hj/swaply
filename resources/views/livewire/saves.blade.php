<div>
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" >
        <h3>المحفوظات</h3>
        <p>المنشورات التي تم حفظها</p>
    </div>
    @forelse ($saves as $save)
        <div class="card shadow p-2 mt-1 mb-1 ani ani_slideInUp">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <small onclick="document.querySelector('#delete{{$save->id}}').classList.toggle('hidden')" >
                            <i class="bi bi-trash cursor"></i>
                        </small> 
                        <small class="hidden px-1" id="delete{{$save->id}}">
                            <button type="button" class="btn btn-outline-danger" wire:click="deleteSave({{$save->id}})"> حذف </button>                                    
                        </small>
                        | <small class="mx-1" title="نوع المنشور">
                            <i class="bi bi-distribute-horizontal"></i>
                            <span>{{$save->item->item_type == 1 ? 'مبادلة' : ($save->item->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                        </small>
                        | <small>
                            <i class="bi bi-clock"></i>
                            <span>{{$save->created_at->diffForHumans()}}</span>
                        </small>
                        @if($save->item->item_type == 1)
                            | <small class="mx-1" title="بديل الغرض">
                                <i class="bi bi-arrow-down-up"></i>
                                <span>{{substr($save->item->swap_with,0,strlen($save->item->swap_with) < 30? strlen($save->item->swap_with) : strlen($save->item->swap_with)/3)}}</span> 
                            </small>
                        @endif                        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title m-0"> <span>{{$save->item->item_title}}</span> </h5>
                            </div>
                        </div>
                        <small class="card-text">
                            {{substr($save->item->item_info,0,strlen($save->item->item_info) < 70 ? strlen($save->item->item_info): strlen($save->item->item_info)/2)}}...
                        </small>
                        <br>
                        <small > <i class="bi bi-geo-alt"></i> {{$save->item->item_location}} </small> 
                    </div>
                    <div class="col-3">
                        <div class="cursor" wire:click="$emitTo('body','changeBody',['showitem','{{$save->item->id}}'])" title="عرض المنشور">                                
                            <div class="dark-border d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                @if($save->item->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$save->item->directory.'/'.$save->item->collection[0]) )
                                    @php
                                        $temp = getimagesize( 'assets/items/'.$save->item->directory.'/'.$save->item->collection[0] );
                                        $height = $temp[1] > 720 ? '45%':'100%';
                                    @endphp
                                    <img src="{{asset('assets/items/'.$save->item->directory.'/'.$save->item->collection[0])}}" alt="{{$save->item->item_type}}" width="{{$height}}}" height="64px">
                                @else 
                                    <img class="glow" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$save->item->item_type}}" width="100%" height="64px" >
                                @endif
                            </div>                    
                        </div>
                    </div>
                    <div class="py-1 {{ file_exists('assets/items/'.$save->item->directory.'/'.$save->item->collection[0]) == true ? 'hidden' : ''}}">
                        <small class="green_underline" >عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                    </div> 
                </div>
            </div>
        </div>
    @empty 
        <div class="alert alert-light ani ani_slideInUp p-0 m-0 mt-1 mb-1" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد اي محفوظات في الوقت الحالي</p>
        </div>
    @endforelse
</div>
