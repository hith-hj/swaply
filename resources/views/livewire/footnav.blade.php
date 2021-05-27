<footer class="footer mt-0 py-1 bg-light float text-center ani ani_slideInUp ani_faster">
    <div class="container">
        
        <div class="">
            <i class="glow mx-1 fs-2 bi bi-arrow-right" title="next" wire:click="$emitTo('body','goNext')" role="button" tabindex="0"></i>
            {{-- <svg width="120" height="30" viewBox="0 0 185 47" fill="#81CB99" xmlns="http://www.w3.org/2000/svg" class="cursor" wire:click="$emitTo('body','changeBody','feeds')">
                <path d="M26.4227 6.74658L27.0346 5.94355H26.025H8.25678C5.92143 5.94355 4.07718 6.50274 2.81802 7.70943C1.55489 8.91992 0.96637 10.6993 0.96637 12.951V16.2897C0.96637 18.3946 1.53364 20.0626 2.75265 21.1968C3.96485 22.3247 5.73622 22.8444 7.97385 22.8444H19.8571C20.9387 22.8444 21.6569 23.0978 22.1045 23.5161C22.5458 23.9285 22.8089 24.5808 22.8089 25.5699V28.9085C22.8089 29.9819 22.5047 30.7011 21.9756 31.1632C21.4335 31.6365 20.5687 31.9169 19.2912 31.9169H7.97385H7.73626L7.5862 32.1011L4.68189 35.666L4.01726 36.4818H5.06953H20.3664C22.7564 36.4818 24.642 35.9189 25.9295 34.7046C27.2226 33.4851 27.8265 31.6906 27.8265 29.4178V25.1172C27.8265 23.0135 27.2647 21.346 26.056 20.2115C24.8533 19.0826 23.0954 18.5624 20.8756 18.5624H8.99241C7.89009 18.5624 7.15659 18.3082 6.69953 17.888C6.25041 17.4751 5.98403 16.8237 5.98403 15.837V13.5169C5.98403 12.4349 6.27454 11.7124 6.77145 11.2526C7.27569 10.786 8.07944 10.5085 9.27535 10.5085H23.3089H23.5565L23.7066 10.3115L26.4227 6.74658ZM35.7989 6.28568L35.685 5.94355H35.3244H31.1612H30.4624L30.6879 6.60493L40.7604 36.1432L40.8758 36.4818H41.2336H45.2513H45.5995L45.7203 
                36.1552L54.4691 12.4851L63.0019 36.1514L63.121 36.4818H63.4722H67.5465H67.9029L68.0191 36.1448L78.2048 6.60655L78.4334 5.94355H77.7321H73.5447H73.1851L73.0707 6.28445L65.3773 29.2043L57.0385 6.27268L56.9188 5.94355H56.5686H52.4944H52.1483L52.0264 6.26751L43.4128 29.1659L35.7989 6.28568ZM100.607 19.5586L101.1 18.7888H100.186H89.3776C86.8255 18.7888 84.818 19.3481 83.4455 20.5542C82.0607 21.7712 81.4082 23.5697 81.4082 25.8528V28.1729C81.4082 30.8539 82.0837 32.9562 83.5223 34.3844C84.9602 35.812 87.0757 36.4818 89.7737 36.4818H100.186C103.34 36.4818 105.798 35.673 107.461 33.9686C109.123 32.2664 109.909 29.7559 109.909 26.5319V15.8935C109.909 12.6695 109.123 10.159 107.461 8.45681C105.798 6.75235 103.34 5.94355 100.186 5.94355H82.8136H81.8218L82.4116 6.7409L85.4673 10.8717L85.6187 11.0765L85.8734 11.0744L99.6764 10.9612C99.6771 10.9612 99.6778 10.9612 99.6785 10.9612C101.463 10.9616 102.71 11.4248 103.518 12.2648C104.329 13.1088 104.779 14.4191 104.779 16.2897V26.4187C104.779 28.3457 104.315 29.6983 103.475 30.5706C102.639 31.4394 101.349 31.9169 99.5067 31.9169H90.5094C89.0367 31.9169 88.0246 31.5576 87.3785 30.9273C86.7346
                30.2991 86.3693 29.3187 86.3693 27.8899V26.5319C86.3693 25.3303 86.7181 24.5133 87.3394 23.9841C87.976 23.4418 88.9842 23.1274 90.4528 23.1274H98.0457H98.3191L98.4666 22.8972L100.607 19.5586ZM119.76 31.4227L118.791 32.2944H120.095H132.657C135.812 32.2944 138.269 31.4856 139.933 29.7812C141.594 28.079 142.381 25.5685 142.381 22.3444V15.8935C142.381 12.6695 141.594 10.159 139.933 8.45681C138.269 6.75235 135.812 5.94355 132.657 5.94355H122.924C119.769 5.94355 117.312 6.75235 115.649 8.45681C113.987 10.159 113.2 12.6695 113.2 15.8935V41.8103V42.3103H113.7H117.831H118.331V41.8103V16.5726C118.331 14.6467 118.799 13.2948 119.647 12.4224C120.492
                11.5526 121.798 11.0744 123.66 11.0744H131.865C133.747 11.0744 135.067 11.5533 135.922 12.4241C136.778 13.2967 137.25 14.6479 137.25 16.5726V21.6654C137.25 23.6101 136.777 24.9761 135.92 25.858C135.065 26.7372 133.746 27.2202 131.865 27.2202H124.623H124.431L124.289 27.3485L119.76 31.4227ZM150.844 1.63098V1.13098H150.344H146.213H145.713V1.63098V35.9818V36.4818H146.213H150.344H150.844V35.9818V1.63098ZM159.815 8.5679V8.26279L159.544 8.12325L155.413 5.99891L154.684 5.62418V6.44355V25.2869C154.684 28.3303 155.475 30.7034 157.143 32.3102C158.808 33.9135 161.261 34.6711 164.408 34.6711H178.734V35.5292C178.734 37.6132 178.257 39.0829 177.393 40.0303C176.537 40.9691 175.221 41.4801 173.349 41.4801H160.617H160.117V41.9801V45.9977V46.4977H160.617H174.141C177.304 46.4977 179.764 45.6372 181.426 43.8325C183.081 42.0355 183.865 39.3878 183.865 35.9818V6.44355V5.62418L183.136 5.99891L179.005 8.12325L178.734 8.26279V8.5679V29.8232H165.144C163.274 29.8232 161.965 29.3693 161.121 28.5498C160.279 27.7329 159.815 26.4698 159.815 24.6645V8.5679Z" 
                stroke="#81cb99" stroke-width="2"/>
            </svg> --}}
            <i class="glow bi bi-house mx-4 fs-2 cursor" wire:click="$emitTo('body','changeBody','feeds')" role="button" tabindex="0"></i>
            <i class="glow mx-1 fs-2 bi bi-arrow-left" title="back" wire:click="$emitTo('body','goBack')" role="button" tabindex="0"></i>
            {{-- <br>
             <small>
                swaply 
                &copy; 
                <script> 
                    var d = new Date();
                    document.write(d.getFullYear())
                </script>
            </small> --}}
        </div>

        {{-- <div class="cursor"  title="خروج (خليك معنا)" style="position: fixed;bottom: 1.65%;left: 3%;transform: scale(1);">
            <span class="ver-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-box-arrow-left icon-15"></i>
            </span>                    
            <div class="dropdown-menu px-1">
                <div class="card">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.querySelector('#logout-form').submit();">
                        <i class="bi bi-door-open cr"></i><span>خروج</span>
                    </a>
                </div>
            </div>                        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div> --}}
        
    </div>
</footer>
