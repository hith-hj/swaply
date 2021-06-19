<div>
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" role="alert">
        <h3>المطابقات</h3>
        <p>المطابقات المقترحة من قبل الموقع على منشوراتك للتبادل</p>
    </div>
    @forelse($items as $item)
        <div class="col mt-5px ani ani_fadeIn ani_faster">
            <div class="card shadow">
                <div class="card-body" > 
                    <h5>{{$item->item_title}}</h5>                    
                    <div class="row mt-1">
                        <div class="col">
                                <small class="mx-1"><span>  <i class="bi bi-calendar"></i></span> {{$item->created_at->format('D-H:m')}}</small>|
                                <small class="mx-1"><span> المكان :</span> {{$item->item_location}}</small>
                        </div>
                    </div>
                    <hr>
                    <div wire:click="$emitTo('body','changeBody',['showitem','{{$item->id}}'])" title=" عرض {{$item->item_title}}">
                        <small class="card-text"><span>{{$item->item_info}}</span></small><br>
                        {{-- 
                            <div class="d-flex justify-content-evenly mt-5px">
                                <img class=" glow" src="{{asset('assets/items/'.$item->directory.'/'.$item->collection[0])}}" width="150" height="120" alt="{{$item->item_title}}" >
                            </div> 
                        --}}
                    </div>                    
                </div>
                <div class="card-footer">
                    <small class="mx-4">مقترحات</small>
                    @foreach ($item->recommends as $reco)
                        <div class="modal-dialog cursor ani ani_fadeIn mx-auto mb-1 mt-1">
                            <div class="modal-content" title="عرض المنشور" wire:click="$emit('changeBody',['showitem','{{$reco->id}}'])">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0">{{$reco->item_title}}</h6>
                                            <p>{{$reco->item_info}}</p>
                                            <small class="card-subtitle text-muted m-0">{{$reco->created_at->diffForHumans()}}</small> 
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-evenly mt-5px">
                                                <img class=" glow" src="{{asset('assets/items/'.$reco->directory.'/'.$reco->collection[0])}}" width="50%" height="64px" alt="{{$reco->item_title}}" >
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد مقترحات للتبادل مع اغراضك في الوقت الحالي  </p>
        </div>
    @endforelse
</div>


