<div>
    @forelse ($saves as $save)
        <div class="alert alert-light mt-5px ani ani_slideInUp ani_faster" role="alert">
            <div class="row cursor" wire:click="$emit('changeBody',['showitem','{{$save->item->id}}'])">
                <div class="col-8">
                    <h6 class="m-0 glow">{{$save->item->item_title}}</h6>
                    <small class="card-subtitle text-muted m-0">{{$save->created_at->diffForHumans()}}</small>
                    <p>{{$save->item->item_info}}</p>
                </div>
                <div class="col-4">
                    <img src="{{asset('assets/items/'.$save->item->directory.'/'.$save->item->collection[0])}}" width="60" height="60" alt="post_img">
                </div>       
            </div>
        </div>
    @empty 
        <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
            <h3>عذرا عزيزي المشترك</h3>
            <p>لايوجد اي محفوظات في الوقت الحالي</p>
        </div>
    @endforelse
</div>