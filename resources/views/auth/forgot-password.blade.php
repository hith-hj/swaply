@extends('layouts.sapp')
@section('content')
<div class="fullpage">
    <div id="center">
        <div class="vertical-align text-center">
            <x-guest-layout>
                <x-auth-card>
                    <svg width="280" height="190" viewBox="0 0 340 202" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M136.701 69.0275L137.81 69.0159L138.388 68.0692L146.016 55.5639L147.821 52.6048L144.356 52.523C142.982 52.4906 141.628 52.4841 140.418 52.4783C139.597 52.4743 138.843 52.4707 138.194 52.4595C136.455 52.4295 135.209 52.3456 134.295 52.1324C133.419 51.9278 133.082 51.6574 132.906 51.4163C132.702 51.1386 132.457 50.552 132.457 49.2302V43.481C132.457 42.7019 132.448 42.0232 132.441 41.4212C132.427 40.3124 132.416 39.4642 132.468 38.7292C132.545 37.6331 132.742 37.4219 132.808 37.3588C132.936 37.2372 133.376 36.9533 134.918 36.774C136.405 36.6011 138.52 36.5597 141.608 36.5597H195.912H220.396C222.173 36.5597 223.147 34.4886 222.013 33.1198L197.629 3.69257C196.374 2.17793 193.912 3.06534 193.912 5.03242V19.9195H178.317H136.68C131.336 19.9195 127.252 20.1699 124.163 20.8379C121.054 21.5104 118.713 22.657 117.144 24.6343C115.603 26.5764 115.053 29.0192 114.829 31.7058C114.656 33.7919 114.668 36.2664 114.681 39.0566C114.685 39.8377 114.689 40.6435 114.689 41.4724V53.6592C114.689 57.1019 114.761 59.8971 115.223 62.057C115.706 64.3159 116.673 66.1421 118.615 67.3333C120.397 68.4263 122.747 68.812 125.54 68.9727C128.118 69.121 131.391 69.0853 135.447 69.041C135.857 69.0366 136.275 69.032 136.701 69.0275Z" fill="#73F271" stroke="#A1A1A1" stroke-width="4"/>
                        <path d="M200.581 52.2126L199.472 52.2242L198.895 53.1709L191.267 65.6762L189.462 68.6353L192.927 68.7171C194.3 68.7495 195.655 68.756 196.864 68.7618C197.686 68.7658 198.44 68.7694 199.089 68.7806C200.828 68.8106 202.074 68.8945 202.987 69.1077C203.864 69.3123 204.2 69.5827 204.377 69.8238C204.581 70.1015 204.826 70.6881 204.826 72.0099V77.7591C204.826 78.5382 204.835 79.2169 204.842 79.8189C204.856 80.9277 204.867 81.7759 204.815 82.5109C204.738 83.607 204.541 83.8182 204.474 83.8814C204.347 84.0029 203.907 84.2868 202.365 84.4661C200.878 84.639 198.762 84.6804 195.675 84.6804H141.37H116.887C115.109 84.6804 114.136 86.7515 115.27 88.1203L139.653 117.548C140.908 119.062 143.37 118.175 143.37 116.208V101.321H158.966H200.602C205.947 101.321 210.031 101.07 213.12 100.402C216.229 99.7298 218.57 98.5832 220.139 96.6058C221.68 94.6637 222.23 92.2209 222.453 89.5343C222.627 87.4482 222.615 84.9737 222.601 82.1835C222.597 81.4025 222.594 80.5966 222.594 79.7677V67.5809C222.594 64.1382 222.522 61.343 222.06 59.1831C221.576 56.9242 220.61 55.0981 218.668 53.9068C216.886 52.8138 214.536 52.4282 211.743 52.2674C209.165 52.1191 205.892 52.1548 201.836 52.1991C201.426 52.2035 201.008 52.2081 200.581 52.2126Z" fill="#F2F60A" stroke="#A2A2A2" stroke-width="4"/>
                        <path d="M165.039 70.8463H166.539V69.3463V64.4345C166.539 63.8931 166.695 63.7135 166.824 63.6138C167.028 63.4569 167.511 63.2553 168.521 63.2553H173.281C176.356 63.2553 178.629 62.6708 179.977 60.9362C181.237 59.3149 181.348 57.0542 181.348 54.8282V48.3019C181.348 46.9905 181.202 45.7898 180.733 44.7676C180.235 43.6833 179.43 42.9157 178.353 42.4089C177.334 41.9292 176.094 41.6929 174.693 41.5635C173.279 41.4328 171.573 41.4017 169.565 41.4017H157.854H152.556L157.067 44.1791L162.869 47.7513L163.231 47.974H163.656H168.521C169.018 47.974 169.49 47.967 169.926 47.9605L169.95 47.9601C170.397 47.9535 170.801 47.9476 171.175 47.9495C171.944 47.9533 172.474 47.9913 172.85 48.0793C173.197 48.1607 173.265 48.2511 173.274 48.2625L173.275 48.2631C173.289 48.2821 173.405 48.4407 173.405 48.9965V54.6298C173.405 55.403 172.989 56.0586 172.409 56.5985C172.128 56.8602 171.842 57.0617 171.624 57.1972C171.607 57.2082 171.59 57.2188 171.573 57.2288H166.919C164.461 57.2288 162.347 57.6674 160.815 58.7806C159.195 59.9584 158.456 61.7186 158.456 63.7895V69.3463V70.8463H159.956H165.039ZM166.539 76.0195V74.5195H165.039H159.956H158.456V76.0195V79.1204V80.6204H159.956H165.039H166.539V79.1204V76.0195Z" fill="url(#paint0_linear)" stroke="#A9B1A9" stroke-width="3"/>
                        <path d="M44.3432 145.229L46.6133 142.723H43.2313H14.1239C10.2536 142.723 7.07289 143.496 4.83944 145.297C2.54426 147.148 1.5 149.875 1.5 153.192V157.794C1.5 160.918 2.51631 163.492 4.74046 165.234C6.89474 166.92 9.95224 167.639 13.6604 167.639H33.1272C34.8563 167.639 35.8765 167.986 36.4411 168.429C36.9369 168.819 37.2818 169.443 37.2818 170.584V175.186C37.2818 176.42 36.8867 177.135 36.2483 177.604C35.5235 178.137 34.2546 178.522 32.2002 178.522H13.6604H13.0248L12.5828 178.978L7.82499 183.892L5.36222 186.435H8.9026H33.9615C37.9202 186.435 41.1665 185.657 43.4453 183.849C45.7903 181.988 46.8634 179.239 46.8634 175.888V169.961C46.8634 166.841 45.8581 164.267 43.6511 162.524C41.5117 160.835 38.4752 160.115 34.7957 160.115H15.329C13.5649 160.115 12.5174 159.767 11.9362 159.317C11.4281 158.924 11.0816 158.302 11.0816 157.17V153.972C11.0816 152.705 11.4692 151.985 12.0558 151.529C12.7138 151.016 13.8755 150.636 15.7925 150.636H38.7818H39.4471L39.8937 150.143L44.3432 145.229ZM65.9414 143.671L65.5664 142.723H64.5466H57.7264H55.5L56.3363 144.786L72.8367 185.499L73.2163 186.435H74.2268H80.8085H81.7879L82.1818 185.539L95.9013 154.308L109.279 185.526L109.668 186.435H110.658H117.332H118.338L118.72 185.504L135.406 144.791L136.254 142.723H134.018H127.158H126.141L125.765 143.667L113.754 173.773L100.725 143.627L100.334 142.723H99.3483H92.6739H91.7015L91.3046 143.61L77.834 173.74L65.9414 143.671ZM180.414 162.836L182.249 160.427H179.221H161.515C157.296 160.427 153.858 161.199 151.446 162.983C148.949 164.829 147.779 167.585 147.779 170.974V174.172C147.779 178.069 148.958 181.24 151.539 183.396C154.067 185.508 157.697 186.435 162.164 186.435H179.221C184.439 186.435 188.632 185.316 191.533 182.815C194.476 180.278 195.831 176.546 195.831 171.91V157.248C195.831 152.612 194.476 148.88 191.533 146.343C188.632 143.842 184.439 142.723 179.221 142.723H150.762H147.446L149.636 145.213L154.641 150.907L155.093 151.421L155.778 151.416L178.386 151.26C178.388 151.26 178.39 151.26 178.391 151.26C181.262 151.261 183.135 151.894 184.281 152.897C185.39 153.868 186.064 155.403 186.064 157.794V171.754C186.064 174.223 185.367 175.816 184.212 176.826C183.019 177.869 181.075 178.522 178.108 178.522H163.369C161.003 178.522 159.506 178.03 158.62 177.302C157.79 176.621 157.268 175.544 157.268 173.782V171.91C157.268 170.509 157.729 169.659 158.519 169.093C159.401 168.461 160.908 168.029 163.276 168.029H175.715H176.458L176.908 167.438L180.414 162.836ZM218.882 177.968L217.58 178.954V158.183C217.58 155.72 218.281 154.128 219.448 153.117C220.657 152.07 222.627 151.416 225.628 151.416H239.069C242.103 151.416 244.098 152.071 245.323 153.122C246.503 154.134 247.21 155.724 247.21 158.183V165.203C247.21 167.693 246.501 169.304 245.318 170.328C244.093 171.388 242.1 172.048 239.069 172.048H227.206H226.702L226.3 172.352L218.882 177.968ZM217.58 180.664H219.787H240.367C245.584 180.664 249.778 179.544 252.678 177.044C255.622 174.507 256.977 170.775 256.977 166.139V157.248C256.977 152.612 255.622 148.88 252.678 146.343C249.778 143.842 245.584 142.723 240.367 142.723H224.422C219.205 142.723 215.011 143.842 212.111 146.343C209.167 148.88 207.812 152.612 207.812 157.248V192.969V194.469H209.312H216.08H217.58V192.969V180.664ZM277.857 137.589V136.089H276.357H269.59H268.09V137.589V184.935V186.435H269.59H276.357H277.857V184.935V137.589ZM299.103 147.151V146.165L298.199 145.774L291.432 142.846L289.336 141.939V144.223V170.195C289.336 174.601 290.711 178.146 293.669 180.544C296.567 182.892 300.746 183.94 305.946 183.94H328.733V184.311C328.733 187.011 328.007 188.77 326.806 189.877C325.582 191.006 323.603 191.703 320.592 191.703H299.735H298.235V193.203V198.74V200.24H299.735H321.89C327.126 200.24 331.333 199.047 334.234 196.396C337.161 193.722 338.5 189.805 338.5 184.935V144.223V141.939L336.404 142.846L329.637 145.774L328.733 146.165V147.151V175.636H307.151C304.134 175.636 302.15 175.014 300.939 174.024C299.786 173.083 299.103 171.616 299.103 169.337V147.151Z" fill="url(#paint1_linear)" stroke="url(#paint2_linear)" stroke-width="3"/>
                        <defs>
                        <linearGradient id="paint0_linear" x1="157.854" y1="44.5353" x2="179.848" y2="74.9527" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#90F810" stop-opacity="0.567708"/>
                        <stop offset="1" stop-color="#F2F60A"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear" x1="37.3223" y1="168.165" x2="302.098" y2="171.999" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#73F271"/>
                        <stop offset="1" stop-color="#F2F60A"/>
                        </linearGradient>
                        <linearGradient id="paint2_linear" x1="3" y1="163.69" x2="348.837" y2="168.165" gradientUnits="userSpaceOnUse">
                        <stop offset="0.541667" stop-color="#919191"/>
                        </linearGradient>
                        </defs>
                    </svg>

                    <div class="mb-4 text-sm text-gray-600 cb fs-20">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.email') }}" class="uk-panel uk-panel-box uk-form">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="form-control-light" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-5px">
                            <x-button class="uk-button uk-button-primary">
                                {{ __('Email Password Reset Link') }}
                            </x-button>
                        </div>
                    </form>
                    <a href="{{route('login')}}"><button class="sbtn sbtn-txt w-25" >
                        {{ __('login') }}
                    </button></a>
                </x-auth-card>
            </x-guest-layout>
        </div>
    </div>
</div>
