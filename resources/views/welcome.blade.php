<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <link rel="manifest" href="./manifest.webmanifest">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#9decae" />
    <meta property="og:url"           content="https://www.swap-ly.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Swaply" />
    <meta property="og:description"   content="swaply Emall" />
    <meta property="og:locale"   content="ar_EG" />
    <meta property="og:image"         content="{{asset('favicon.ico')}}" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}" />
    <title>swaply</title>
    <link href="css/welani.css" rel="stylesheet" />
</head>

<body onload="localStorage.setItem('logAte',0)">
    <div id="welcome-canvas"></div>
    <div class="rowz">
        <a class="top" href="{{route('about')}}"><small>سوابلي</small></a>
    </div>
    <div class="fullPage">
        
        <div id="centerz">
            <div class="welcom" style="overflow: hidden; overflow-x: hidden; padding:1rem 0">
                <div class="svgs" style="opacity: .7">
                                          
                    <svg id="logo"  width="189" height="102" style="margin-top: .5rem" viewBox="0 0 189 202" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M39.5117 113.821L40.6207 113.81L41.1982 112.863L54.3642 91.2791L56.1692 88.32L52.704 88.2382C50.3239 88.182 48.0427 88.1714 45.9825 88.1618C44.5628 88.1551 43.2481 88.149 42.0783 88.1288C39.0749 88.0769 36.786 87.933 35.0441 87.5264C33.3392 87.1285 32.3884 86.5313 31.8046 85.7351C31.1939 84.9023 30.7485 83.5322 30.7485 81.1033V71.1803C30.7485 69.9011 30.7344 68.759 30.7216 67.7286C30.6972 65.763 30.6779 64.2041 30.7715 62.8765C30.9116 60.891 31.285 60.0584 31.8063 59.5619C32.3889 59.007 33.5624 58.478 36.2809 58.1619C38.9444 57.8521 42.68 57.7822 47.9951 57.7822H141.724H184.136C185.914 57.7822 186.888 55.7113 185.753 54.3423L143.441 3.27729C142.186 1.76265 139.724 2.65006 139.724 4.61714V31.9654H111.355H39.4908C30.2867 31.9654 23.3658 32.3989 18.1927 33.5177C12.999 34.641 9.32647 36.5059 6.90819 39.5537C4.5179 42.5662 3.6009 46.4313 3.223 50.9767C2.92945 54.5074 2.94961 58.6901 2.97276 63.4925C2.9793 64.8502 2.98609 66.2574 2.98609 67.7135V88.7477C2.98609 94.7127 3.11498 99.3845 3.87537 102.938C4.65693 106.591 6.16276 109.329 9.06909 111.111C11.8152 112.796 15.5545 113.453 20.3455 113.729C24.7424 113.982 30.3386 113.921 37.3612 113.844C38.0637 113.837 38.7805 113.829 39.5117 113.821Z" stroke="#73F271" stroke-width="4"/>
                        <path d="M149.798 87.7027L148.689 87.7143L148.112 88.661L134.946 110.245L133.141 113.204L136.606 113.286C138.986 113.342 141.267 113.353 143.328 113.362C144.747 113.369 146.062 113.375 147.232 113.395C150.235 113.447 152.524 113.591 154.266 113.998C155.971 114.396 156.922 114.993 157.506 115.789C158.116 116.622 158.562 117.992 158.562 120.421V130.344C158.562 131.623 158.576 132.765 158.588 133.795C158.613 135.761 158.632 137.32 158.539 138.647C158.398 140.633 158.025 141.466 157.504 141.962C156.921 142.517 155.748 143.046 153.029 143.362C150.366 143.672 146.63 143.742 141.315 143.742H47.5857H5.17378C3.39622 143.742 2.42245 145.813 3.55675 147.182L45.8686 198.247C47.1236 199.761 49.5857 198.874 49.5857 196.907V169.559H77.9553H149.819C159.023 169.559 165.944 169.125 171.117 168.006C176.311 166.883 179.984 165.018 182.402 161.97C184.792 158.958 185.709 155.093 186.087 150.547C186.381 147.017 186.36 142.834 186.337 138.032C186.331 136.674 186.324 135.267 186.324 133.81V112.776C186.324 106.811 186.195 102.139 185.435 98.5856C184.653 94.9328 183.147 92.1954 180.241 90.4126C177.495 88.7281 173.756 88.0707 168.965 87.7951C164.568 87.542 158.971 87.603 151.949 87.6795C151.246 87.6872 150.53 87.695 149.798 87.7027Z" stroke="#F2F70A" stroke-width="4"/>
                        <path d="M88.4375 117.323H89.9375V115.823V107.346C89.9375 106.156 90.3037 105.49 90.8545 105.066C91.4797 104.585 92.5938 104.221 94.4463 104.221H102.663C107.895 104.221 111.36 103.214 113.36 100.64C115.273 98.1782 115.498 94.6602 115.498 90.7654V79.5011C115.498 77.3012 115.248 75.4112 114.535 73.8548C113.792 72.2364 112.599 71.0899 110.953 70.3151C109.365 69.5675 107.374 69.1743 105 68.955C102.613 68.7343 99.713 68.6804 96.249 68.6804H76.0352H70.7376L75.2488 71.4578L85.2636 77.6234L85.6252 77.8461H86.05H94.4463C95.2961 77.8461 96.1048 77.834 96.8591 77.8228L96.8973 77.8222C97.6672 77.8108 98.375 77.8005 99.0335 77.8038C100.371 77.8105 101.391 77.8747 102.167 78.0567C102.922 78.2335 103.297 78.4873 103.514 78.7686C103.739 79.0606 103.965 79.6038 103.965 80.6999V90.4228C103.965 92.1806 103.015 93.5802 101.9 94.6179C101.352 95.1285 100.798 95.5173 100.38 95.778C100.237 95.8676 100.111 95.9409 100.01 95.9977H91.6822C87.5393 95.9977 84.1611 96.7425 81.787 98.468C79.3241 100.258 78.1645 102.937 78.1645 106.232V115.823V117.323H79.6645H88.4375ZM99.7364 96.1426L99.7365 96.1425L99.7364 96.1426ZM89.9375 127.341V125.841H88.4375H79.6645H78.1645V127.341V132.693V134.193H79.6645H88.4375H89.9375V132.693V127.341Z" stroke="url(#paint0_linear)" stroke-width="3"/>
                        <defs>
                        <linearGradient id="paint0_linear" x1="76.0352" y1="74.4544" x2="106.847" y2="109.176" gradientUnits="userSpaceOnUse">
                        <stop offset="0.145833" stop-color="#73F271"/>
                        <stop offset="0.921875" stop-color="#F4F908" stop-opacity="0.8"/>
                        </linearGradient>
                        </defs>
                    </svg>                        
                        
                        
                    <br>

                    <svg id="text-logo" width="246" height="85" viewBox="0 0 586 115" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M75.6815 17.4011L78.7083 14.0587H74.199H23.9599C17.3436 14.0587 12.0107 15.3838 8.30479 18.372C4.51658 21.4264 2.76025 25.9433 2.76025 31.5396V39.4819C2.76025 44.7399 4.46416 48.9921 8.12733 51.8597C11.6973 54.6545 16.8205 55.8859 23.1599 55.8859H56.7593C59.8049 55.8859 61.7202 56.4937 62.8431 57.3764C63.8743 58.1872 64.5191 59.4549 64.5191 61.559V69.5014C64.5191 71.7798 63.777 73.2074 62.495 74.1493C61.0979 75.1758 58.7599 75.8476 55.1593 75.8476H23.1599H22.3125L21.7231 76.4564L13.5112 84.9372L10.2276 88.3285H14.9481H58.1993C64.97 88.3285 70.4176 86.9943 74.2022 83.9913C78.075 80.9183 79.8789 76.3652 79.8789 70.7129V60.4821C79.8789 55.2303 78.1927 50.9794 74.5585 48.1095C71.0144 45.3107 65.9283 44.0781 59.6393 44.0781H26.0399C22.9355 44.0781 20.9748 43.4683 19.8237 42.5779C18.77 41.7629 18.12 40.4975 18.12 38.405V32.8857C18.12 30.5642 18.84 29.1296 20.0287 28.2042C21.3124 27.2046 23.471 26.5395 26.8399 26.5395H66.5191H67.4062L68.0016 25.882L75.6815 17.4011ZM112.849 15.3231L112.349 14.0587H110.989H99.2173H96.2487L97.3638 16.8099L125.843 87.0797L126.349 88.3285H127.697H139.057H140.362L140.888 87.1329L165.113 31.9871L188.737 87.1162L189.257 88.3285H190.576H202.095H203.437L203.946 87.0869L232.746 16.8171L233.876 14.0587H230.895H219.055H217.7L217.197 15.3176L195.942 68.5969L172.892 15.2652L172.37 14.0587H171.056H159.536H158.24L157.71 15.2424L133.89 68.522L112.849 15.3231ZM310.506 47.8286L312.953 44.6166H308.915H278.355C271.128 44.6166 265.344 45.9422 261.327 48.9123C257.197 51.9659 255.236 56.5282 255.236 62.2321V67.7514C255.236 74.356 257.23 79.6407 261.513 83.2191C265.728 86.7399 271.833 88.3285 279.475 88.3285H308.915C317.849 88.3285 324.924 86.4093 329.78 82.2231C334.693 77.9878 336.994 71.7333 336.994 63.8475V38.5396C336.994 30.6538 334.693 24.3993 329.78 20.164C324.924 15.9778 317.849 14.0587 308.915 14.0587H259.796H255.374L258.294 17.3792L266.933 27.2062L267.536 27.8919L268.449 27.8856L307.475 27.6164C307.477 27.6164 307.479 27.6164 307.482 27.6164C312.51 27.6174 315.909 28.7243 318.037 30.5877C320.116 32.4074 321.314 35.2427 321.314 39.4819V63.5783C321.314 67.9514 320.077 70.8874 317.918 72.7747C315.708 74.7068 312.187 75.8476 306.995 75.8476H281.555C277.405 75.8476 274.664 74.9879 272.984 73.6094C271.381 72.2929 270.435 70.2442 270.435 67.0783V63.8475C270.435 61.2743 271.296 59.6134 272.841 58.5067C274.508 57.3118 277.254 56.559 281.395 56.559H302.864H303.854L304.455 55.771L310.506 47.8286ZM377.725 74.7722L374.533 77.1892V40.155C374.533 35.7879 375.78 32.854 377.962 30.965C380.198 29.0283 383.762 27.8857 389.012 27.8857H412.212C417.519 27.8857 421.126 29.03 423.39 30.9712C425.595 32.862 426.852 35.794 426.852 40.155V52.2705C426.852 56.6823 425.591 59.6499 423.383 61.5613C421.119 63.5206 417.515 64.6745 412.212 64.6745H391.736H391.064L390.529 65.0799L377.725 74.7722ZM374.533 78.3669H378.932H414.452C423.387 78.3669 430.461 76.4477 435.317 72.2615C440.23 68.0262 442.531 61.7717 442.531 53.8859V38.5396C442.531 30.6538 440.23 24.3993 435.317 20.164C430.461 15.9778 423.387 14.0587 414.452 14.0587H386.932C377.998 14.0587 370.923 15.9778 366.067 20.164C361.154 24.3993 358.853 30.6538 358.853 38.5396V100.194V102.194H360.853H372.533H374.533V100.194V78.3669ZM478.571 4.60986V2.60986H476.571H464.892H462.892V4.60986V86.3285V88.3285H464.892H476.571H478.571V86.3285V4.60986ZM515.241 21.1124V19.7985L514.035 19.2768L502.355 14.2231L499.561 13.0141V16.0587V60.8859C499.561 68.3634 501.888 74.2929 506.822 78.2909C511.675 82.2237 518.729 84.0207 527.641 84.0207H567.56V85.2515C567.56 90.0152 566.276 93.2325 564.044 95.291C561.781 97.3778 558.197 98.5978 552.92 98.5978H516.921H514.921V100.598V110.156V112.156H516.921H555.16C564.119 112.156 571.212 110.113 576.069 105.675C580.96 101.206 583.24 94.6279 583.24 86.3285V16.0587V13.0141L580.445 14.2231L568.766 19.2768L567.56 19.7985V21.1124V70.8668H529.721C524.449 70.8668 520.866 69.782 518.626 67.9525C516.464 66.1862 515.241 63.4652 515.241 59.4052V21.1124Z" 
                        stroke="url(#textpaint0_linear)" stroke-width="4"/>
                        <defs>
                        <linearGradient id="textpaint0_linear" x1="4.76026" y1="49.6599" x2="601.67" y2="57.3827" gradientUnits="userSpaceOnUse">
                        <stop offset="0.259355" stop-color="#73F271"/>
                        <stop offset="0.709849" stop-color="#F2F70A"/>
                        </linearGradient>
                        </defs>
                    </svg>                     
                </div> 
                <div style="margin-top: -20px">
                    <h1 id="slogan-header">سوابلي</h1>
                    <p id="slogan">الكل بيستفيد</p>
                </div>    
    
                @guest
                    <div class="row">
                        <a class="link-text" href="{{ route('login') }}">دخول</a>
                        <a class="link-text" href="{{ url('/peek') }}">إطلاع</a>
                        @if (Route::has('register'))
                            <a class="link-text" href="{{ route('register') }}">إشتراك</a>
                        @endif
                    </div>
                @else 
                    <a class="link-text" href="{{ url('/home') }}">الرئيسية</a>              
                @endguest
            </div>
        </div>

       
        
    </div>
    <footer >
        <h6>
            راسلنا على البريد الألكتروني <br>
            <a href="mailto:swaply.co@gmail.com">swaply.co@gmail.com</a>
        </h6>
        <small>Swaply &copy; 2021 </small>
    </footer>
</body>
</html>
