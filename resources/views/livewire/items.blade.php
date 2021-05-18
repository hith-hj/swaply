
<div>
    @forelse ($feeds as $feed)
        <div class="col mt-5px ani ani_fadeIn {{$feed->status == 1 ? 'br-success' : ''}}" >
            <div class="card shadow">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-10 ">
                            <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$feed->item_type}}</span></small>
                            @if($feed->item_type != 'تبرع')
                                <small class="card-subtitle text-muted m-0" title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                            @endif
                            <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            @if($feed->status ==1)
                            <small class="card-subtitle text-muted mx-2 "><strong>تم التبديل</strong></small>
                            @endif
                        </div>
                    </div>  
                    <hr>
                    <div wire:click="$emitTo('body','changeBody',['showitem','{{$feed->id}}'])" data-bs-toggle="tooltip" title="عرض المنشور">
                        <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                        @if($feed->collection[0] != 'dark-logo.png')
                            <img class="glow px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                        @else 
                            <img class="glow px-1" src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                        @endif
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <small class="mx-1"><span> المكان :</span> {{$feed->item_location}}</small>|
                            <small class="mx-1"><span> عروض :</span> {{$feed->requests}}</small>|
                            <small class="mx-1">شوهد : <span>{{$feed->views}}</span></small>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    @empty
        <div class="alert alert-light mt-5px ani ani_fadeIn" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد منشورات لك في الوقت الحالي. </p>
        </div>
    @endforelse
</div>
