@extends('layouts.sapp')
@section('content')
    @auth
        <div class="fullPage">
            <div id="center">
                @livewire('search')
                @livewire('body',['dest'=>$dest ?? 'feeds'])                
            </div>            
            @livewire('footnav')
        </div>
        @livewire('menu')
    @else 
    <div class="fullPage">
        <div id="center">
            <div class="body" style="min-height: 99vh">
                <div class="alert alert-light ani ani_slideInUp w-100 m-0" role="alert">
                    <h5>اشترك او سجل دخول لتحصل على مطلق الصلاحية </h5>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-success" href="{{ route('login') }}">تسجيل دخول</a>
                            @if (Route::has('register'))
                                <a class="btn btn-outline-success px-3" href="{{ route('register') }}">اشتراك</a>
                            @endif
                        </div>                        
                    </div>
                </div>
                <div id="feedsBody">
                    @forelse ($feeds as $feed)
                        <div class="col mt-5px ani ani_fadeIn ani_faster" >
                            <div class="card shadow">
                                <div class="card-body" >
                                    <div class="row mb-2">
                                        <div class="col">
                                            <small class="card-subtitle text-muted  green_underline" title="نوع المنشور">
                                                <i class="mx-1 bi bi-distribute-horizontal"></i>
                                                <span>{{$feed->item_type == 1 ? 'مبادلة' : ($feed->item_type == 2 ? 'بيع' : 'تبرع')}}</span>
                                            </small>
                                            @if($feed->item_type == 1)
                                                <small class="card-subtitle text-muted " title="بديل الغرض">
                                                    <i class="mx-1 bi bi-arrow-down-up"></i>
                                                    <span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span>
                                                </small>
                                            @endif
                                            <small class="card-subtitle text-muted " title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                                            @if($feed->amount > 0)
                                                <small class="card-subtitle text-muted mt-1" title="الفرق"><i class="mx-1 bi bi-cash"></i><span>{{$feed->amount}}</span></small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3" style="padding-left:0;">
                                            <div class="cursor" title="عرض المنشور">                                
                                                <div class="dark-border d-flex justify-content-evenly mt-1" style="max-height:5.2rem">
                                                    @if($feed->collection[0] != 'dark-logo.png' && file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) )
                                                        <img class="" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" width="100%" >
                                                    @else 
                                                        <img class="glow px-1" src="{{asset('assets/fto/dark-logo.png')}}" alt="{{$feed->item_type}}" width="100%" >
                                                    @endif
                                                </div>                    
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="col-10 ">
                                                    <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                                                </div>
                                            </div>
                                            <small class="card-text">
                                                <span>
                                                    {{substr($feed->item_info,0,strlen($feed->item_info) < 70 ? strlen($feed->item_info): strlen($feed->item_info)/2)}}...
                                                </span>
                                            </small> 
                                        </div>
                                        <div class="py-1 {{ file_exists('assets/items/'.$feed->directory.'/'.$feed->collection[0]) == true ? 'hidden' : ''}}">
                                            <small class="green_underline" >عذرا عزيزي المشترك ,لايوجد صور صالحة لهذا المنشور</small>
                                        </div> 
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <small class="mx-1"><span> <i class="bi bi-cart-plus"></i></span> {{$feed->requests}}</small>|
                                            <small class="mx-1"> <i class="bi bi-check2-all mx-1"></i> <span> {{$feed->views}}</span></small>
                                        </div>
                                    </div>            
                                </div>            
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
                            <h3>عذرا عزيزي المشترك</h3>
                            <p>لايوجد منشورات في الوقت الحالي ,الرجاء المحاولة لاحقا. </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endauth
    
@endsection
