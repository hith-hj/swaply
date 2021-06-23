<div>
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" role="alert">
        <h3>المطابقات</h3>
        <p>المطابقات المقترحة من قبل الموقع على منشوراتك </p>
        <small>الرجاء معاينة و عرض المنشور قبل ارسال اي طلب</small>
    </div>
    @forelse($items as $item)
        <div class="col mt-5px ani ani_fadeIn ani_faster">
            <div class="card shadow">
                <div class="card-body" > 
                    <h5 class="cursor glow px-2" wire:click="$emitTo('body','changeBody',['showitem','{{$item->id}}'])" title=" عرض {{$item->item_title}}">{{$item->item_title}}</h5>
                    <div>
                        <div class="row mx-1">
                            <div class="col p-0"> 
                                <small class="green_underline mx-1" title="نوع المنشور">
                                    <i class="bi bi-distribute-horizontal"></i>
                                    <span>{{$item->item_type == 1 ? 'مبادلة' : ($item->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                                </small> |
                                <small class="card-subtitle text-muted"> <i class="bi bi-check2-all"></i> <span> {{$item->views}}</span></small> |
                                <small class="card-subtitle text-muted"><span> <i class="bi bi-cart-plus"></i></span> {{$item->requests}}</small> |
                                <small class="mx-1"><span> <i class="bi bi-geo-alt"></i></span> {{$item->item_location}}</small>                        
                                @if($item->amount > 0)
                                    | <small class="card-subtitle text-muted mt-1" title="الفرق"><i class="bi bi-cash"></i> <span>{{$item->amount}}</span></small>
                                @endif
                            </div>
                        </div>
                    </div>                   
                </div>
                <div class="card-footer">
                    <small class="mx-2">مقترحات</small>                    
                    @foreach ($item->recommends as $reco)
                        <div class="modal-dialog cursor ani ani_fadeIn mx-auto mb-1 mt-1 glow">
                            <div class="modal-content" title="عرض المنشور" wire:click="$emit('changeBody',['showitem','{{$reco->id}}'])">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6 class="m-0 px-2">{{$reco->item_title}}</h6>
                                            <div class="row mx-1">
                                                <div class="col p-0">
                                                    <small class="green_underline mx-1" title="نوع المنشور">
                                                        <i class="bi bi-distribute-horizontal"></i>
                                                        <span>{{$reco->item_type == 1 ? 'مبادلة' : ($reco->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                                                    </small> |
                                                    @if($reco->rates > 0 )
                                                        <small class="card-subtitle text-muted"> <i class="bi bi-stars"></i> <span> {{$reco->rates > 10 ? round($reco->rates/5) : $reco->rates}}</span></small> |
                                                    @endif
                                                    <small class="card-subtitle text-muted"><span> <i class="bi bi-cart-plus"></i></span> {{$reco->requests}}</small> |
                                                    <small class="mx-1"><span> <i class="bi bi-geo-alt"></i></span> {{$reco->item_location}}</small>                        
                                                    @if($reco->amount > 0)
                                                        | <small class="card-subtitle text-muted mt-1" title="الفرق"><i class="bi bi-cash"></i> <span>{{$reco->amount}}</span></small>
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex justify-content-evenly mt-5px">
                                                <img class=" glow" src="{{asset('assets/items/'.$reco->directory.'/'.$reco->collection[0])}}" width="100%" height="64px" alt="{{$reco->item_title}}" >
                                            </div>
                                        </div>
                                    </div> 
                                    @switch($reco->item_type)
                                        @case('1')
                                                @livewire('reqs.swap', ['feed' => $reco], key($reco->id))
                                            @break
                                        @case('2')
                                                @livewire('reqs.trade', ['feed' => $reco], key($reco->id))
                                            @break
                                        @case('3')
                                                @livewire('reqs.donate', ['feed' => $reco], key($reco->id))
                                            @break                    
                                    @endswitch                               
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light ani ani_slideInUp p-0 m-0 mt-1 mb-1" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد مقترحات للتبادل مع اغراضك في الوقت الحالي  </p>
        </div>
    @endforelse
</div>


