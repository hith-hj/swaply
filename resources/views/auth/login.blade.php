@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    <img src="/imgs/new-logo.png" class="mt-5px" width="120" alt="swaply logo">
                    <h5 class="mb-5" style="margin: 0">
                        <svg id="text-logo" class="mt20" width="247" height="82" viewBox="0 0 347 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M46.984 13.1627L49.3755 10.0239H45.4294H15.9733C11.94 10.0239 8.55247 10.9889 6.17823 13.2643C3.78847 15.5544 2.76183 18.8474 2.76183 22.7663V28.3011C2.76183 31.9858 3.75849 35.0983 6.08192 37.2601C8.3788 39.3972
                            11.6406 40.2931 15.5043 40.2931H35.2042C36.8422 40.2931 37.7067 40.6783 38.1617 41.1034C38.5917 41.5052 38.9722 42.2399 38.9722 43.6858V49.2206C38.9722 50.784 38.5369 51.6208 37.976 52.1106C37.3645 52.6446 36.2452 53.0824
                            34.2661 53.0824H15.5043H14.5756L13.9891 53.8024L9.1743 59.7123L6.57648 62.9011H10.6895H36.0485C40.1683 62.9011 43.6217 61.9319 46.0433 59.6481C48.4865 57.344 49.5414 54.0236 49.5414 50.0649V42.9353C49.5414 39.2554 48.5553
                            36.145 46.251 33.9821C43.9699 31.8411 40.7291 30.9434 36.8928 30.9434H17.1928C15.5165 30.9434 14.6238 30.5546 14.1534 30.1222C13.7141 29.7184 13.331 28.9875 13.331 27.5506V23.7044C13.331 22.1075 13.7554 21.2579 14.2753 20.7767C14.8239
                            20.2691 15.8321 19.8426 17.6619 19.8426H40.9266H41.8945L42.4812 19.0727L46.984 13.1627ZM68.8544 11.3612L68.4094 10.0239H67H60.0982H57.3669L58.2484 12.609L74.9464 61.5775L75.3978 62.9011H76.7962H83.4567H84.8179L85.2898 61.6243L98.7248
                            25.2757L111.825 61.6096L112.29 62.9011H113.663H120.418H121.811L122.265 61.5838L139.151 12.6154L140.044 10.0239H137.303H130.361H128.956L128.509 11.3564L116.779 46.3007L104.055 11.3104L103.587 10.0239H102.219H95.4643H94.1114L93.6351 11.2902L80.4738
                            46.278L68.8544 11.3612ZM184.693 34.3277L186.622 31.3186H183.048H165.13C160.759 31.3186 157.115 32.2735 154.553 34.5254C151.942 36.8197 150.793 40.156 150.793 44.1549V48.001C150.793 52.6211 151.958 56.4444 154.63 59.0972C157.3 61.7475 161.143 62.9011 165.787 62.9011H183.048C188.458
                            62.9011 192.872 61.5123 195.915 58.3953C198.948 55.287 200.293 50.7921 200.293 45.2806V27.6444C200.293 22.1328 198.948 17.638 195.915 14.5297C192.872 11.4127 188.458 10.0239 183.048 10.0239H154.248H150.372L152.677 13.1405L157.743 19.9886L158.335 20.7888L159.33 20.7806L182.203 20.5931C182.206 20.5931 182.209 20.5931 182.211 20.5931C184.981 20.5944 186.705 21.3116 187.76 22.4086C188.829 23.5211 189.536 25.3626 189.536 28.3011V45.093C189.536
                            48.1247 188.806 50.0363 187.69 51.1957C186.588 52.3411 184.791 53.0824 181.922 53.0824H167.006C164.732 53.0824 163.387 52.5273 162.602 51.7617C161.826 51.0047 161.268 49.7199 161.268 47.532V45.2806C161.268 43.5135 161.772 42.5174 162.481 41.9137C163.25 41.2588 164.611 40.7621 166.913 40.7621H179.5H180.569L181.145 39.8624L184.693 34.3277ZM222.793 52.552L222.302 52.9936V28.7701C222.302 25.743 223.038 23.8341 224.165 22.6743C225.282 21.5248 227.105 20.7807 230.01 20.7807H243.613C246.554 20.7807 248.403 21.5276 249.535 22.681C250.673 23.8413 251.415 25.7475 251.415 28.7701V37.213C251.415 40.2713 250.671 42.2035 249.528 43.379C248.396
                            44.5442 246.549 45.2962 243.613 45.2962H231.607H230.858L230.3 45.7977L222.793 52.552ZM222.302 55.9592H224.1H244.926C250.337 55.9592 254.751 54.5704 257.793 51.4534C260.827 48.3451 262.171 43.8503 262.171 38.3387V27.6444C262.171 22.1328 260.827 17.638 257.793 14.5297C254.751 11.4127 250.337 10.0239 244.926 10.0239H228.791C223.381 10.0239 218.967 11.4127 215.924 14.5297C212.89 17.638 211.546 22.1328 211.546 27.6444V70.6091V72.5635H213.5H220.348H222.302V70.6091V55.9592ZM283.302 4V2.04564H281.348H274.5H272.546V4V60.9467V62.9011H274.5H281.348H283.302V60.9467V4ZM304.802
                            15.5V14.3074L303.742 13.762L296.894 10.2403L294.046 8.77555V11.9783V43.2168C294.046 48.4464 295.407 52.7231 298.467 55.6704C301.513 58.6046 305.911 59.8992 311.291 59.8992H333.915V60.1963C333.915 63.5019 333.157 65.6165 331.986 66.8998C330.846 68.1491 329.015 68.9362 326.113 68.9362H305.006H303.051V70.8905V77.551V79.5054H305.006H327.426C332.868 79.5054 337.296 78.0207 340.332 74.7238C343.34 71.4575 344.671 66.7446 344.671 60.9467V11.9783V8.77556L341.823 10.2403L334.975 13.762L333.915 14.3074V15.5V49.6114H312.51C309.577 49.6114 307.738 48.8988 306.625 47.8184C305.523 46.7483 304.802 44.9957 304.802 42.1849V15.5Z"
                            stroke="#555" fill="#81cb80" stroke-width="3.90872"/>
                            </svg>
                    </h5>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4 danger" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}" class="form-group">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="name" :value="__('أسم المستخدم')" />

                            <x-input id="name" class="form-control-light" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('كلمة المرور')" />

                            <x-input id="password" class="form-control-light"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                        </div>

                        <div class="row text-small mt-5px">
                            <label for="remember_me" class="float-left col-sm sbtn-txt">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600 cb">{{ __('تذكرني') }}</span>
                            </label>

                            @if(Route::has('password.request'))
                                <a class="float-right link-dark col-sm sbtn-txt" href="{{ route('password.request') }}">
                                    {{ __('نسيت كلمة المرور؟') }}
                                </a>
                            @endif

                            <a class="float-center link-dark col-sm sbtn-txt"  href="{{ route('register') }}">
                                {{ __('اشتراك') }}
                            </a>

                        </div>

                        <div class="form-row text-small mt-3">
                            <x-button class="rounded bg-light sbtn-txt w-50">
                                {{ __('دخول') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
@endsection



            {{-- <form >
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-input" type="text" placeholder="Username">
                </div>
                <div class="uk-form-row mt-5px">
                    <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Password">
                </div>
                <div class="uk-form-row mt-5px">
                    <a class="uk-width-1-1 uk-button uk-button-primary" href="#">Login</a>
                </div>
                <div class="uk-form-row uk-text-small mt-5px">
                    <label class="uk-float-left"><input type="checkbox"> Remember Me</label>
                    <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
                    <a class="uk-float-center uk-link uk-link-muted" href="sign-up.html">Sing up</a>
                </div>
            </form> --}}

