@extends('layouts.sadmin')
@section('content')
{{dd($strict)}}
 {{--
<div class="row h-50">
    <div class="col-4 ">
        @foreach ($strict["us"] as $user)
            {{$user}}
        @endforeach
    </div>
    <div class="col-4">
        @foreach ($strict["its"] as $item)
            {{$item}}
        @endforeach
    </div>
    <div class="col-4">
        @foreach ($strict["peks"] as $pekia)
            {{$pekia}}
        @endforeach
    </div> 
</div>
<hr>
--}}    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"> <i class="bi bi-kanban"></i> Dashboard</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض/إخفاء لوحة التنقل">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control w-100" type="text" placeholder="بحث" aria-label="بحث">
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.querySelector('#logout-form').submit();">
                <i class="bi bi-door-open cr "></i><small class="mx-1">خروج</small>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </div>
    </header>
    
    <div class="container-fluid mt-2">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse h-100vh">
          <div class="position-sticky pt-3">
            <h6 class="sidebar-heading d-flex align-items-center px-1 mt-4 mb-1 text-muted">
                <i class="bi bi-plus-circle-dotted mx-1"></i><span>جديد</span>
            </h6>
              <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                     <i class="bi bi-people"></i>
                      مستخدمين
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-collection"></i>
                        منشورات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-megaphone"></i>
                        بيكيا
                    </a>
                </li>
              </ul>
            <hr>
            <h6 class="sidebar-heading d-flex align-items-center px-1 mt-4 mb-1 text-muted">
                <i class="bi bi-files mx-1"></i><span>صفحات</span>
            </h6>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-people"></i>
                  مستخدمين
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-collection"></i>
                  منشورات
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-megaphone"></i>
                  بيكيا
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-arrow-bar-up"></i>
                  طلبات
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-arrow-down-up"></i>
                  تبادلات
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 <i class="bi bi-flag "></i>
                  بلاغات
                </a>
              </li>
            </ul>
    
            
          </div>
        </nav>
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">عنوان الصفحة</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">خيار 1</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">خيار 2</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
               <i class="bi bi-"></i>
                هذا الأسبوع
              </button>
            </div>
          </div>
    
          <h2>عنوان القسم</h2>
          <div class="table-responsive">
              some shit
          </div>
        </main>
      </div>
    </div>

@endsection