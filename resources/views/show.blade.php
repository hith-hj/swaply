@extends('layouts.sapp')

@section('content')
<div class="fullPage">
    <footer class="header mt-0 py-1 bg-light float text-center">
        <div class="container">
            
            <div class="">
                <svg id="logo" width="82" height="40" viewBox="0 0 67 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.80411 21.8597C1.80411 30.6204 7.07572 30.4108 18.185 30.287V22.4038C12.5832 22.2633 9.96949 22.9128 9.96949 19.0677V15.4434C9.96949 10.2156 9.303 9.81951 16.5831 9.81951H56.0727L63.0493 1.85126H13.6608C1.04881 1.85126 1.80411 4.39614 1.80411 14.1772V21.8597Z" stroke="#81CB80" stroke-width="1.5"/>
                    <path d="M65.0407 31.0354C65.0407 22.2746 59.7691 22.4842 48.6599 22.608V30.4912C54.2616 30.6317 56.8753 29.9823 56.8753 33.8273V37.4516C56.8753 42.6794 57.5418 43.0755 50.2617 43.0755H10.7721L3.79547 51.0438H53.184C65.796 51.0438 65.0407 48.4989 65.0407 38.7178V31.0354Z" stroke="#81CB80" stroke-width="1.5"/>
                    <path d="M30.48 32.4987H31.23V31.7487V28.6523C31.23 28.2491 31.3459 28.0685 31.4711 27.9661C31.6251 27.8401 31.9397 27.7133 32.5448 27.7133H36.6744C38.5203 27.7133 40.044 27.3368 41.1153 26.4557C42.2146 25.5516 42.7103 24.2235 42.7103 22.6159V19.7072C42.7103 17.997 42.164 16.5965 40.9714 15.6484C39.8116 14.7264
                    38.1578 14.3282 36.1376 14.3282H24.8845H22.3686L24.4738 15.7058L27.9151 17.9577L28.1022 18.0802H28.3258H35.5182C36.6078 18.0802 37.2861 18.3019 37.6816 18.619C38.0454 18.9107 38.2783 19.3717 38.2783 20.1451V22.4908C38.2783 23.1856 38.0731 23.5851 37.7691 23.8335C37.4361 24.1056 36.853 24.3055 35.8898 24.3055H31.595C30.1428
                    24.3055 28.9159 24.5823 28.0393 25.2595C27.126 25.965 26.7154 27.0075 26.7154 28.2457V31.7487V32.4987H27.4654H30.48ZM31.23 35.9553V35.2053H30.48H27.4654H26.7154V35.9553V37.9101V38.6601H27.4654H30.48H31.23V37.9101V35.9553Z" stroke="#81CB80" stroke-width="1"/>
                </svg>
                <br>    
                <small>
                    <p>بدل غرضك الي مابتستخدمو بغرض تستخدمو</p>
                </small>
            </div>
            
        </div>
    </footer>
    <div id="center">
        <div class="body">
            @if(empty($feed))
            <div class="alert alert-light mt-5px ani ani_slideInUp" role="alert">
                <h3>عذرا عزيزي الزائر</h3>
                <p>من الممكن ان يكون قد تم حذف او ازالة المنشور </p><br>
                <p>اشترك او سجل دخول للمزيد من الاغراض</p>
                <div class="btn-group">
                    <a class="link-text btn btn-outline-success" href="{{ route('login') }}">تسجيل دخول</a>
                </div>
            </div>
            @else 
            <div class="col mt-5px ani ani_fadeIn " >
                <div class="card shadow">
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-10 ">
                                <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <small class="card-subtitle text-muted m-0" title="نوع المنشور"><i class="mx-1 bi bi-distribute-horizontal"></i><span>{{$feed->item_type == 1 ? 'مبادلة'  :'تبرع' }}</span></small>
                                @if($feed->item_type == 1)
                                    <small class="card-subtitle text-muted m-0" title="بديل الغرض"><i class="mx-1 bi bi-arrow-down-up"></i><span>{{substr($feed->swap_with,0,strlen($feed->swap_with) < 30? strlen($feed->swap_with) : strlen($feed->swap_with)/3)}}</span></small>
                                @endif
                                <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>
                            </div>
                        </div>  
                        <hr>
                        <div title="معرض الصور">
                            <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                            <div id="carouselExampleControls" class="carousel slide text-center carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($feed->collection as $img)
                                        <div class="carousel-item {{ $loop->first ? "active" :''}} ani ani_fadeIn1 ani_slow">
                                            <img class="d-block glow" width="180" height="180" src="{{asset('assets/items/'.$feed->directory.'/'.$img)}}" width="120"  alt="{{$feed->item_type}}" >
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span aria-hidden="true"><i class="bi bi-chevron-right cb"></i></span>
                                <span class="visually-hidden"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span aria-hidden="true"><i class="bi bi-chevron-left cb"></i></span>
                                <span class="visually-hidden"></span>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <small class="mx-1"><span> المكان :</span> {{$feed->item_location}}</small>|
                                <small class="mx-1"><span> عروض :</span> {{$feed->requestsCount}}</small>|
                                <small class="mx-1">شوهد : <span>{{$feed->views}}</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center py-2">
                        <div class="btn-group">
                            <a class="link-text btn btn-outline-success" href="{{ route('login') }}">تسجيل دخول</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <footer class="footer mt-0 py-1 bg-light float text-center">
        <div class="container">
            
            <div class="">
                <svg width="120" height="30" viewBox="0 0 185 47" fill="#81CB99" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.4227 6.74658L27.0346 5.94355H26.025H8.25678C5.92143 5.94355 4.07718 6.50274 2.81802 7.70943C1.55489 8.91992 0.96637 10.6993 0.96637 12.951V16.2897C0.96637 18.3946 1.53364 20.0626 2.75265 21.1968C3.96485 22.3247 5.73622 22.8444 7.97385 22.8444H19.8571C20.9387 22.8444 21.6569 23.0978 22.1045 23.5161C22.5458 23.9285 22.8089 24.5808 22.8089 25.5699V28.9085C22.8089 29.9819 22.5047 30.7011 21.9756 31.1632C21.4335 31.6365 20.5687 31.9169 19.2912 31.9169H7.97385H7.73626L7.5862 32.1011L4.68189 35.666L4.01726 36.4818H5.06953H20.3664C22.7564 36.4818 24.642 35.9189 25.9295 34.7046C27.2226 33.4851 27.8265 31.6906 27.8265 29.4178V25.1172C27.8265 23.0135 27.2647 21.346 26.056 20.2115C24.8533 19.0826 23.0954 18.5624 20.8756 18.5624H8.99241C7.89009 18.5624 7.15659 18.3082 6.69953 17.888C6.25041 17.4751 5.98403 16.8237 5.98403 15.837V13.5169C5.98403 12.4349 6.27454 11.7124 6.77145 11.2526C7.27569 10.786 8.07944 10.5085 9.27535 10.5085H23.3089H23.5565L23.7066 10.3115L26.4227 6.74658ZM35.7989 6.28568L35.685 5.94355H35.3244H31.1612H30.4624L30.6879 6.60493L40.7604 36.1432L40.8758 36.4818H41.2336H45.2513H45.5995L45.7203 
                    36.1552L54.4691 12.4851L63.0019 36.1514L63.121 36.4818H63.4722H67.5465H67.9029L68.0191 36.1448L78.2048 6.60655L78.4334 5.94355H77.7321H73.5447H73.1851L73.0707 6.28445L65.3773 29.2043L57.0385 6.27268L56.9188 5.94355H56.5686H52.4944H52.1483L52.0264 6.26751L43.4128 29.1659L35.7989 6.28568ZM100.607 19.5586L101.1 18.7888H100.186H89.3776C86.8255 18.7888 84.818 19.3481 83.4455 20.5542C82.0607 21.7712 81.4082 23.5697 81.4082 25.8528V28.1729C81.4082 30.8539 82.0837 32.9562 83.5223 34.3844C84.9602 35.812 87.0757 36.4818 89.7737 36.4818H100.186C103.34 36.4818 105.798 35.673 107.461 33.9686C109.123 32.2664 109.909 29.7559 109.909 26.5319V15.8935C109.909 12.6695 109.123 10.159 107.461 8.45681C105.798 6.75235 103.34 5.94355 100.186 5.94355H82.8136H81.8218L82.4116 6.7409L85.4673 10.8717L85.6187 11.0765L85.8734 11.0744L99.6764 10.9612C99.6771 10.9612 99.6778 10.9612 99.6785 10.9612C101.463 10.9616 102.71 11.4248 103.518 12.2648C104.329 13.1088 104.779 14.4191 104.779 16.2897V26.4187C104.779 28.3457 104.315 29.6983 103.475 30.5706C102.639 31.4394 101.349 31.9169 99.5067 31.9169H90.5094C89.0367 31.9169 88.0246 31.5576 87.3785 30.9273C86.7346
                    30.2991 86.3693 29.3187 86.3693 27.8899V26.5319C86.3693 25.3303 86.7181 24.5133 87.3394 23.9841C87.976 23.4418 88.9842 23.1274 90.4528 23.1274H98.0457H98.3191L98.4666 22.8972L100.607 19.5586ZM119.76 31.4227L118.791 32.2944H120.095H132.657C135.812 32.2944 138.269 31.4856 139.933 29.7812C141.594 28.079 142.381 25.5685 142.381 22.3444V15.8935C142.381 12.6695 141.594 10.159 139.933 8.45681C138.269 6.75235 135.812 5.94355 132.657 5.94355H122.924C119.769 5.94355 117.312 6.75235 115.649 8.45681C113.987 10.159 113.2 12.6695 113.2 15.8935V41.8103V42.3103H113.7H117.831H118.331V41.8103V16.5726C118.331 14.6467 118.799 13.2948 119.647 12.4224C120.492
                    11.5526 121.798 11.0744 123.66 11.0744H131.865C133.747 11.0744 135.067 11.5533 135.922 12.4241C136.778 13.2967 137.25 14.6479 137.25 16.5726V21.6654C137.25 23.6101 136.777 24.9761 135.92 25.858C135.065 26.7372 133.746 27.2202 131.865 27.2202H124.623H124.431L124.289 27.3485L119.76 31.4227ZM150.844 1.63098V1.13098H150.344H146.213H145.713V1.63098V35.9818V36.4818H146.213H150.344H150.844V35.9818V1.63098ZM159.815 8.5679V8.26279L159.544 8.12325L155.413 5.99891L154.684 5.62418V6.44355V25.2869C154.684 28.3303 155.475 30.7034 157.143 32.3102C158.808 33.9135 161.261 34.6711 164.408 34.6711H178.734V35.5292C178.734 37.6132 178.257 39.0829 177.393 40.0303C176.537 40.9691 175.221 41.4801 173.349 41.4801H160.617H160.117V41.9801V45.9977V46.4977H160.617H174.141C177.304 46.4977 179.764 45.6372 181.426 43.8325C183.081 42.0355 183.865 39.3878 183.865 35.9818V6.44355V5.62418L183.136 5.99891L179.005 8.12325L178.734 8.26279V8.5679V29.8232H165.144C163.274 29.8232 161.965 29.3693 161.121 28.5498C160.279 27.7329 159.815 26.4698 159.815 24.6645V8.5679Z" 
                    stroke="#81cb99" stroke-width="2"/>
                </svg>
                <br>    
                <small>
                    swaply 
                    &copy; 
                    <script> 
                        var d = new Date();
                        document.write(d.getFullYear())
                    </script>
                </small>
            </div>
            
        </div>
    </footer>
</div>

@endsection