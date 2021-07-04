<div>
    <div class="alert alert-light ani ani_slideInDown p-0 m-0 mt-1 mb-1" role="alert">
        <h3>سوابيكياتي</h3>
    </div>
    @forelse ($pekias as $pekia)
    <div class="col mb-2 {{$loop->first ? 'mt-1':''}} ani ani_fadeIn ani_faster" wire:key="{{$pekia->id}}" >
        <div class="card shadow">
            <div class="card-body mb-1" >
                <div class="row mb-2">
                    <div class="col-10">
                        <small class="mx-1" title="تاريخ النشر"><i class="bi bi-calendar-day"></i>
                            <span>{{$pekia->created_at->diffForHumans()}}</span>
                        </small> |
                        <small class="card-subtitle text-muted mt-1" title="الفرق">
                            <i class="bi bi-cash"></i> 
                            <span>{{$pekia->pekia_price}}</span>
                        </small>
                    </div>
                    <div class="col-2 text-left">
                        {{-- <small class="mt-1" >
                            <i class="bi bi-pencil-square"></i> 
                        </small> --}}
                        @if($pekia->status == 0)
                            <small class="mt-1" onclick="document.querySelector('#deletePekia{{$pekia->id}}').classList.toggle('hidden')">
                                <i class="bi bi-trash"></i> 
                            </small>
                            <button wire:click="deletePekia('{{$pekia->id}}')" id="deletePekia{{$pekia->id}}" class="btn btn-outline-danger hidden" role="button" tabindex="0">حذف</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3" style="padding-left:0;" onclick="document.querySelector('#showPekiaImages{{$pekia->id}}').classList.toggle('hidden')">
                        <div class="cursor"  title="عرض المنشور">                                
                            <div class="dark-border d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                @if($pekia->collection[0] != 'dark-logo.png' && file_exists('assets/pekias/'.$pekia->directory.'/'.$pekia->collection[0]) )
                                    @php
                                        $temp = getimagesize( 'assets/pekias/'.$pekia->directory.'/'.$pekia->collection[0] );
                                        $height = $temp[1] > 720 ? '45%':'100%';
                                    @endphp
                                    <img src="{{asset('assets/pekias/'.$pekia->directory.'/'.$pekia->collection[0])}}" alt="{{$pekia->pekia_title}}" width="{{$height}}}" height="64px">
                                @else 
                                    <img class="glow" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$pekia->pekia_title}}" width="100%" height="64px" >
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-10 ">
                                <h5 class="card-title m-0"> <span>{{$pekia->pekia_title}}</span> </h5>
                            </div>
                        </div>
                        <br>
                        <small id="showPekiaLocation{{$pekia->id}}" class="cursor glow" onclick="getLocationImage('{{$pekia->pekia_coordinates}}','{{$pekia->id}}')">
                            <i class="bi bi-geo-alt" ></i> عرض الموقع 
                        </small>
                        <small id="hidePekiaLocation{{$pekia->id}}" class="cursor glow" onclick="removeLocationImage('{{$pekia->id}}')" hidden>
                            <i class="bi bi-arrow-clockwise" ></i> اخفاء الموقع 
                        </small>
                        | <small class="card-subtitle text-muted"> <i class="bi bi-images"></i> {{count($pekia->collection)}} </small>
                    </div>
                    <div class="py-1 {{ file_exists('assets/pekias/'.$pekia->directory.'/'.$pekia->collection[0]) == true ? 'hidden' : ''}}">
                         <small class="green_underline" >عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                    </div> 
                </div>
                @if($pekia->swaply_price != '0' || $pekia->swaply_msg != 'no-msg')
                    <div class="row mx-1">
                        <hr>
                        <div class="col p-0">                        
                            
                        </div>
                    </div>
                @endif
            </div>  
            <div id="pekiaLocation{{$pekia->id}}" class="px-3" style="max-height: 300px;max-width:520px;"></div>
            <div class="card-footer">
                <div class="mt-1">
                    @switch($pekia->status)
                        @case('-1')
                            <div class="alert alert-danger" role="alert">
                                عذرا تم الرفض
                            </div>
                            @break
                        @case('0')
                            <div class="alert alert-light" role="alert">
                                بانتظار الرد
                            </div>
                            @break
                        @case('1')
                            <div class="alert alert-success" role="alert">
                                <span>تم قبول الطلب  <span>{{$pekia->updated_at->diffForHumans()}}</span> </span><br>                                                    
                            </div>
                            @break
                        @default
                    @endswitch
                </div>
            </div> 
        </div>
    </div>
    <div id="showPekiaImages{{$pekia->id}}" class="hidden smodal ani ani_fadeIn text-center" style="background: #373736fa;z-index:12; ">
        <div class="ani ani_fadeIn p-1 w-100">
            <div id="showFullImage" class="carousel slide text-center carousel-fade" data-bs-ride="carousel" >
                <i class="bi bi-x close-gallery fs-2 cursor" onclick="document.querySelector('#showPekiaImages{{$pekia->id}}').classList.add('hidden')"></i>
                <div class="carousel-inner ">
                    @foreach ($pekia->collection as $img)
                        <div class="carousel-item {{ $loop->first ? "active" :''}} text-center" style="max-width:75vw; max-height:80vh">
                            @if($pekia->collection[0] != 'dark-logo.png')
                                @php
                                    $temp = getimagesize( 'assets/pekias/'.$pekia->directory.'/'.$img );
                                    $height = $temp[1] > 700 ? '65%':'90%';
                                @endphp
                                <img class="glow" src="{{asset('assets/pekias/'.$pekia->directory.'/'.$img)}}" alt="{{$pekia->item_title}}" width="{{$height}}" >
                            @else 
                                <img class="glow" src="{{asset('assets/fto/'.$pekia->collection[0])}}" alt="{{$pekia->item_title}}" >
                            @endif
                            <br>
                            <span class="h4 text-muted ani ani_fadeIn" style="position: fixed;top: 15%;left: 50%;transform:translate(-50%)">{{$loop->index + 1}}</span>
                        </div>                                                                                                                                     
                    @endforeach
                </div>
            </div>
            @if(is_countable($pekia->collection) && count($pekia->collection) > 1)
                <div class="text-center" style="z-index: 13">
                    <button class="sbtn sbtn-txt carousel-control-prevz mx-5" type="button" data-bs-target="#showFullImage" data-bs-slide="next"
                        style="position: fixed; top: 25%; right: 8%; z-index: 1; height: 50%; width:2rem;">
                        <span aria-hidden="true"><i class="bi bi-chevron-right fs-2 cw"></i></span>
                        <span class="visually-hidden"></span>
                    </button>
                    <button class="sbtn sbtn-txt carousel-control-nextz mx-5" type="button" data-bs-target="#showFullImage" data-bs-slide="prev"
                        style="position: fixed; top: 25%; left: 8%; z-index: 1; height: 50%; width:2rem;">
                        <span aria-hidden="true"><i class="bi bi-chevron-left fs-2 cw"></i></span>
                        <span class="visually-hidden"></span>
                    </button>
                </div>
            @endif
        </div>
    </div> 
@empty
    <div class="alert alert-light ani ani_slideInUp p-0 m-0 mt-1 mb-1" role="alert">
        <h3>عذرا عزيزي المشترك</h3>
        <p>لايوجد طلبات سوابيكيا </p>
    </div>
@endforelse
</div>