@extends('layouts.sapp')
@section('content')
  <div>
    
    <main class="w-100 ani ani_fadeIn" style="max-height:85vh;overflow: scroll !important;padding-bottom:1rem;background: #011e39;color:#fff">
      <div id="myCarousel" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" >
          <div class="carousel-item active">
            <img src="imgs/about/ab1.png" class="ani ani_fadeIn" width="100%"  alt="swaply_images">
            <div class="container">
              <div style="color: black" class="carousel-caption text-start">
                <h1>1 ارفع</h1>
                <h5>طبعا بعد ما تحمل التطبيق <br> صور حاجتك و ارفع الصور عسوابلي</h5>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="imgs/about/ab2.png" class="ani ani_fadeIn" width="100%" alt="swaply_images">
            <div class="container">
              <div style="color: black" class="carousel-caption">
                <h1>2 اطلب</h1>
                <h5> ارسل طلبات عشان ما تستناش حد يطلب حاجتك</h5>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="imgs/about/ab3.png" class="ani ani_fadeIn" width="100%" alt="swaply_images">
            <div class="container">
              <div style="color: black" class="carousel-caption text-end">
                <h1>3 كرر الخطوات</h1>
                <h5>عشان تكسب معنا عروضات و خصومات </h5>
                {{-- <p><a class="btn btn-lg btn-outline-success mt-2" href="#">سجل الأن</a></p> --}}
              </div>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden"></span>
        </button>
      </div>

      <hr class="featurette-divider">

      <div class="mt-5">

        <div class="row col-10 m-auto  mb-5">
          <div class="col-lg-6 col-md-12">
            <h2 class="">سوابلي <span class="text-muted"> جديد جديد بس من عنا </span></h2>
            <p class="lead">سوابلي هو موقع جديد حتى تبيع و تبدل وتشتري الأغراض المستعملة لكن يفرق عن باقي المواقع بعدد من الميزات الجديدة</p>
            <ol style="list-style: arabic-indic" class="mx-5 mt-2 mb-4 ">
              <li class="mt-2 mb-2 ">تسهيل العملية عبر تمكين المستخدم من ارسال و استلام الطلبات من خلال المنصة</li>
              <li class="mt-2 mb-2 ">تمكين المستخدم من ترويج منشوراته عن طريق مشاركة رابط المنشور</li>
              <li class="mt-2 mb-2 ">تبسيط عملية النشر بتقليل المعلومات المدخلة قدر الأمكان</li>
              <li class="mt-2 mb-2 ">سوابلي يقدم مقترحات  للتبادل للمستخدم في حال كان قد نشر غرض للتبديل</li>
            </ol>
          </div>
          <div class="col-lg-6 col-md-12 text-center">
            @include('comps.logo')
          </div>
        </div>

        {{-- <div class="rate text-center">
          <hr class="rate">
          <small>قيم سوابلي و تجربتك معنا</small>
          <div class="rate mb-2 mt-2">
              <div class="form-check">
                  <input class="hidden" id="rate1" type="radio" value="1">
                  <label class="mx-2 fs-2 glow cursor form-check-label" for="rate1">😞</label>
                  <input class="hidden" id="rate2" type="radio" value="2">
                  <label class="mx-2 fs-2 glow cursor form-check-label" for="rate2">😐</label>
                  <input class="hidden" id="rate3" type="radio" value="3">
                  <label class="mx-2 fs-2 glow cursor form-check-label" for="rate3">😕</label>
                  <input class="hidden" id="rate4" type="radio" value="4">
                  <label class="mx-2 fs-2 glow cursor form-check-label" for="rate4">😃</label>
                  <input class="hidden" id="rate5" type="radio" value="5">
                  <label class="mx-2 fs-2 glow cursor form-check-label" for="rate5">😍</label>
                  <br>
                  <button class="mt-2 btn btn-outline-success w-50"><i class="bi bi-check"></i> <span>تقيم</span> </button>
              </div>                                    
          </div>
        </div>  --}}
        
        <!-- 

          <hr class="featurette-divider">

          <div class="row">
            <div class="col-2">
              <img src="imgs/new-logo.png" width="180" height="180" alt=""> 
            </div>
            <div class="col-8 mt-5">
              <h2>عنوان</h2>
              <p>تذكر دائماً أن الحاسوب لا يمتلك ذكاءً، ولكنه يكتسب الذكاء الاصطناعي من خلال ثلاثة عناصر وظيفية رئيسة، هي: القدرة على التحليل، والقدرة على التأليف، والاستدلال المنطقي.</p>
              <p><a class="btn btn-secondary" href="#">عرض التفاصيل</a></p>
            </div>
          </div>

          <hr class="featurette-divider">

          <div class="row">
            <div class="col-2">
              <img src="imgs/new-logo.png" width="180" height="180" alt=""> 
            </div>
            <div class="col-8 mt-5">
              <h2>عنوان</h2>
              <p>تذكر دائماً أن الحاسوب لا يمتلك ذكاءً، ولكنه يكتسب الذكاء الاصطناعي من خلال ثلاثة عناصر وظيفية رئيسة، هي: القدرة على التحليل، والقدرة على التأليف، والاستدلال المنطقي.</p>
              <p><a class="btn btn-secondary" href="#">عرض التفاصيل</a></p>
            </div>
          </div>
          
        -->

        <hr class="featurette-divider">

        <div class="col-12 text-center">
          <h2 class=" py-2"> صفحتنا على فيسبوك </h2>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <a href="https://www.facebook.com/Swaply.len/" target="_blank">
                <img src="imgs/about/fb.png" width="60%" alt="">
              </a> 
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="fb-page" data-href="https://fb.me/swaply.len" data-tabs="timeline" data-width="800" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://fb.me/swaply.len" class="fb-xfbml-parse-ignore">
                  <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Ffb.me%2Fswaply.len&amp;h=AT07BBLy1g5VyagnlcwpQJNvzjwgoO2YBjqNmGVHywT2T4kckWoLMp3BxdHt560xQbidzB-njqSwusvTPO51VgYn_JeGcaJ9uL1fP4lk6NDPB2QY1ILI3elqmrFvwHMCcQaNpnI_YVf0WwDd1rqqRQ" target="_blank" rel="nofollow" data-lynx-mode="asynclazy">‏سوابلي‏
                  </a>
                </blockquote>
              </div>
            </div>
          </div>          
        </div>

      </div>
      <!-- FOOTER -->
      <footer class="container text-center mt-5">
        <hr>
        <div class="rowz mt-5">
          <div class="col-lg-6z col-md-12">
            <h6 class="email"> <i class="bi bi-envelope"></i> راسلنا على البريد الألكتروني <br><a href="mailto:swaply.co@gmail.com">swaply.co@gmail.com</a></h6>
          </div>
          {{-- <div class="col-lg-6 col-md-12">
            <h6 class="phone"> <i class="bi bi-phone"></i> يسرنا سماعك على الهاتف اتصل بنا <br><a href="tel:+201006879055">اتصل</a></h6>
          </div> --}}
        </div>
        
        <p> <a href="#">Swaply &copy; 2021 </a> </p>
      </footer>
    </main>

    <header>
      <div class="alert alert-light ani ani_slideInUp w-100 m-0" role="alert">
        <h5>اشترك او سجل دخول لتحصل على مطلق الصلاحية </h5>
        <div class="row">
          @guest
            <div class="col">                
                <a class="btn btn-outline-success btn-lg" href="{{ route('login') }}">تسجيل دخول</a>
                <a class="btn btn-outline-success btn-lg" href="{{ url('/peek') }}">إطلاع</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline-success btn-lg px-4" href="{{ route('register') }}">اشتراك</a>
                @endif
            </div>
          @else 
              <a class="link-text" href="{{ url('/home') }}">الرئيسية</a>              
          @endguest            
        </div>
      </div>
    </header>
    
  </div>
@endsection
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v10.0" nonce="46CSUZS7"></script>