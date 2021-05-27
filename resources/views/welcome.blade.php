<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <link rel="manifest" href="./manifest.webmanifest">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#9decae" />
    <link rel="shortcut icon" href="imgs/new-logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="imgs/new-logo.png" />
    <title>swaply</title>
    <!-- Styles -->
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
                                
                    {{-- <svg id="logo" width="182" height="120" viewBox="0 0 67 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.80411 21.8597C1.80411 30.6204 7.07572 30.4108 18.185 30.287V22.4038C12.5832 22.2633 9.96949 22.9128 9.96949 19.0677V15.4434C9.96949 10.2156 9.303 9.81951 16.5831 9.81951H56.0727L63.0493 1.85126H13.6608C1.04881 1.85126 1.80411 4.39614 1.80411 14.1772V21.8597Z" stroke="#81CB80" stroke-width="1.5"/>
                        <path d="M65.0407 31.0354C65.0407 22.2746 59.7691 22.4842 48.6599 22.608V30.4912C54.2616 30.6317 56.8753 29.9823 56.8753 33.8273V37.4516C56.8753 42.6794 57.5418 43.0755 50.2617 43.0755H10.7721L3.79547 51.0438H53.184C65.796 51.0438 65.0407 48.4989 65.0407 38.7178V31.0354Z" stroke="#81CB80" stroke-width="1.5"/>
                        <path d="M30.48 32.4987H31.23V31.7487V28.6523C31.23 28.2491 31.3459 28.0685 31.4711 27.9661C31.6251 27.8401 31.9397 27.7133 32.5448 27.7133H36.6744C38.5203 27.7133 40.044 27.3368 41.1153 26.4557C42.2146 25.5516 42.7103 24.2235 42.7103 22.6159V19.7072C42.7103 17.997 42.164 16.5965 40.9714 15.6484C39.8116 14.7264
                        38.1578 14.3282 36.1376 14.3282H24.8845H22.3686L24.4738 15.7058L27.9151 17.9577L28.1022 18.0802H28.3258H35.5182C36.6078 18.0802 37.2861 18.3019 37.6816 18.619C38.0454 18.9107 38.2783 19.3717 38.2783 20.1451V22.4908C38.2783 23.1856 38.0731 23.5851 37.7691 23.8335C37.4361 24.1056 36.853 24.3055 35.8898 24.3055H31.595C30.1428
                        24.3055 28.9159 24.5823 28.0393 25.2595C27.126 25.965 26.7154 27.0075 26.7154 28.2457V31.7487V32.4987H27.4654H30.48ZM31.23 35.9553V35.2053H30.48H27.4654H26.7154V35.9553V37.9101V38.6601H27.4654H30.48H31.23V37.9101V35.9553Z" stroke="#81CB80" stroke-width="1"/>
                    </svg> --}}
                    <svg id="logo"  width="189" height="202" viewBox="0 0 189 202" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    {{-- <svg id="text-logo" width="247" height="82" viewBox="0 0 347 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M46.984 13.1627L49.3755 10.0239H45.4294H15.9733C11.94 10.0239 8.55247 10.9889 6.17823 13.2643C3.78847 15.5544 2.76183 18.8474 2.76183 22.7663V28.3011C2.76183 31.9858 3.75849 35.0983 6.08192 37.2601C8.3788 39.3972 11.6406 40.2931 15.5043 40.2931H35.2042C36.8422 40.2931 37.7067 40.6783 38.1617 41.1034C38.5917 41.5052 38.9722 42.2399 38.9722 43.6858V49.2206C38.9722 50.784 38.5369 51.6208 37.976 52.1106C37.3645 52.6446 36.2452 53.0824 34.2661 53.0824H15.5043H14.5756L13.9891 53.8024L9.1743 59.7123L6.57648 62.9011H10.6895H36.0485C40.1683 62.9011 43.6217 61.9319 46.0433 59.6481C48.4865 57.344 49.5414 54.0236 49.5414 50.0649V42.9353C49.5414 39.2554 48.5553 36.145 46.251 33.9821C43.9699 31.8411 40.7291 30.9434 36.8928 30.9434H17.1928C15.5165 30.9434 14.6238 30.5546 14.1534 30.1222C13.7141 29.7184 13.331 28.9875 13.331 27.5506V23.7044C13.331 22.1075 13.7554 21.2579 14.2753 20.7767C14.8239 20.2691 15.8321 19.8426 17.6619 19.8426H40.9266H41.8945L42.4812 19.0727L46.984 13.1627ZM68.8544 11.3612L68.4094 10.0239H67H60.0982H57.3669L58.2484 12.609L74.9464 61.5775L75.3978 62.9011H76.7962H83.4567H84.8179L85.2898 61.6243L98.7248 25.2757L111.825 61.6096L112.29 62.9011H113.663H120.418H121.811L122.265 61.5838L139.151 12.6154L140.044
                        10.0239H137.303H130.361H128.956L128.509 11.3564L116.779 46.3007L104.055 11.3104L103.587 10.0239H102.219H95.4643H94.1114L93.6351 11.2902L80.4738 46.278L68.8544 11.3612ZM184.693 34.3277L186.622 31.3186H183.048H165.13C160.759 31.3186 157.115 32.2735 154.553 34.5254C151.942 36.8197 150.793 40.156 150.793 44.1549V48.001C150.793 52.6211 151.958 56.4444 154.63 59.0972C157.3 61.7475 161.143 62.9011 165.787 62.9011H183.048C188.458 62.9011 192.872 61.5123 195.915 58.3953C198.948 55.287 200.293 50.7921 200.293 45.2806V27.6444C200.293 22.1328 198.948 17.638 195.915 14.5297C192.872 11.4127 188.458 10.0239 183.048 10.0239H154.248H150.372L152.677 13.1405L157.743 19.9886L158.335 20.7888L159.33 20.7806L182.203 20.5931C182.206 20.5931 182.209 20.5931 182.211 20.5931C184.981 20.5944 186.705 21.3116 187.76 22.4086C188.829 23.5211 189.536 25.3626 189.536 28.3011V45.093C189.536 48.1247 188.806 50.0363 187.69 51.1957C186.588 52.3411 184.791 53.0824 181.922 53.0824H167.006C164.732 53.0824 163.387 52.5273 162.602 51.7617C161.826 51.0047 161.268 49.7199 161.268 47.532V45.2806C161.268 43.5135 161.772 42.5174 162.481 41.9137C163.25 41.2588 164.611 40.7621 166.913 40.7621H179.5H180.569L181.145 39.8624L184.693 34.3277ZM222.793 52.552L222.302 52.9936V28.7701C222.302 25.743
                        223.038 23.8341 224.165 22.6743C225.282 21.5248 227.105 20.7807 230.01 20.7807H243.613C246.554 20.7807 248.403 21.5276 249.535 22.681C250.673 23.8413 251.415 25.7475 251.415 28.7701V37.213C251.415 40.2713 250.671 42.2035 249.528 43.379C248.396 44.5442 246.549 45.2962 243.613 45.2962H231.607H230.858L230.3 45.7977L222.793 52.552ZM222.302 55.9592H224.1H244.926C250.337 55.9592 254.751 54.5704 257.793 51.4534C260.827 48.3451 262.171 43.8503 262.171 38.3387V27.6444C262.171 22.1328 260.827 17.638 257.793 14.5297C254.751 11.4127 250.337 10.0239 244.926 10.0239H228.791C223.381 10.0239 218.967 11.4127 215.924 14.5297C212.89 17.638 211.546 22.1328 211.546 27.6444V70.6091V72.5635H213.5H220.348H222.302V70.6091V55.9592ZM283.302 4V2.04564H281.348H274.5H272.546V4V60.9467V62.9011H274.5H281.348H283.302V60.9467V4ZM304.802 15.5V14.3074L303.742 13.762L296.894 10.2403L294.046 8.77555V11.9783V43.2168C294.046 48.4464 295.407 52.7231 298.467 55.6704C301.513 58.6046 305.911 59.8992 311.291 59.8992H333.915V60.1963C333.915 63.5019 333.157 65.6165 331.986 66.8998C330.846 68.1491 329.015 68.9362 326.113 68.9362H305.006H303.051V70.8905V77.551V79.5054H305.006H327.426C332.868 79.5054 337.296 78.0207 340.332 74.7238C343.34 71.4575 344.671 66.7446 344.671 60.9467V11.9783V8.77556L341.823
                        10.2403L334.975 13.762L333.915 14.3074V15.5V49.6114H312.51C309.577 49.6114 307.738 48.8988 306.625 47.8184C305.523 46.7483 304.802 44.9957 304.802 42.1849V15.5Z"
                        stroke="#81CB80"
                        stroke-width="3.5"/>
                    </svg> --}}

                    <svg id="text-logo" width="386" height="115" viewBox="0 0 586 115" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <div>
                    <h1 id="slogan-header">سوابلي</h1>
                    <p id="slogan">بدل اللي مش محتاجه</p>
                    <p id="slogan">علشان الكل يستفيد</p>
                </div>    
    
                @if (Route::has('login'))
                    <div class="row">
                        @auth
                            <a class="link-text" href="{{ url('/home') }}">الرئيسية</a>
                        @else
                            <a class="link-text" href="{{ route('login') }}">تسجيل دخول</a>
    
                            @if (Route::has('register'))
                                <a class="link-text" href="{{ route('register') }}">اشتراك</a>
                            @endif
                        @endauth
                    </div>                
                @endif
            </div>
            {{-- @if(count($items)>1)
                <div class="taste row">
                    @foreach ($items as $feed)
                        <div class="card mb-2">
                            <div class="card-body" >
                                <div>
                                    <h5 class="card-title m-0"> <span>{{$feed->item_title}}</span> </h5>                                    
                                    <small class="card-subtitle text-muted m-0" title="تاريخ النشر"><i class="mx-1 bi bi-calendar-day"></i><span>{{$feed->created_at->diffForHumans()}}</span></small>  
                                </div>
                                <hr>
                                <div style="align-content: center" data-bs-toggle="tooltip" title="عرض المنشور">
                                    <small class="card-text"><span>{{$feed->item_info}}</span></small><br>
                                    <div style="display: grid;place-items:center;place-content:center;">
                                        @if($feed->collection[0] != 'dark-logo.png')
                                            <img class="glow px-1" src="{{asset('assets/items/'.$feed->directory.'/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                                        @else 
                                            <img class="glow px-1" src="{{asset('assets/fto/'.$feed->collection[0])}}" alt="{{$feed->item_type}}" >
                                        @endif
                                    </div>
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
                    @endforeach
                </div>
            @endif --}}
        </div>
        
    </div>
    <script>
        let paths =  document.querySelectorAll("svg[id='logo'] path")
        for(path of paths){
            console.log(path.getTotalLength());
        }
    </script>
</body>
</html>
