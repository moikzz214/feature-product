<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Gallega Demo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/spritespin@4.0.11/release/spritespin.js"></script>

    <link rel="stylesheet" href="{{ asset('css/pannellum.css') }}" />
    <script type="text/javascript" src="{{ asset('js/libpannellum.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pannellum.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        * {
            font-family: "Lato", sans-serif;
        }

        body {
            background-color: aliceblue;
        }

        .container {
            text-align: center;
            width: 90%;
            max-width: 1366px;
            margin: 0 auto;
            min-height: 100vh;
        }

        .spritespin {
            width: 100%;
        }

        .spritespin-wrapper {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .action-wrapper {
            position: absolute;
            left: auto;
            right: auto;
            top: auto;
            bottom: 34px;
            width: 100%;
        }

        .spritespin-buttons-wrapper {
            /* margin-top: 30px; */
            display: flex;
            justify-content: center;
            width: 200px;
            margin: 0 auto;
        }

        .spritespin-slider {
            width: 100%;
        }

        .spritespin-buttons-wrapper .button {
            font-size: 24px;
            line-height: 24px;
            padding: 0 10px 5px;
            margin: 0 10px;
            cursor: pointer;
            color: #fff;
            background-color: #191e47;
        }

        .content-action {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .open-exterior,
        .open-interior {
            text-transform: uppercase;
            cursor: pointer;
            color: #fff;
            padding: 13px 20px;
            background-color: #191e47;
            font-size: 24px;
            line-height: 24px;
        }

        .active {
            background-color: #fbad18;
        }

        /* HotSpot */
        .cd-img-replace {
            /* replace text with background images */
            display: inline-block;
            overflow: hidden;
            text-indent: 100%;
            white-space: nowrap;
        }

        ul {
            list-style: none;
        }

        .hotspot {
            position: absolute;
            display: block;
        }

        .hotspot--title {
            display: inline-block;
            padding-right: 10px;
            color: #ff0000;
            text-transform: uppercase;
            line-height: 50px;
            font-size: 12px;
            letter-spacing: 1px;
            transition: all cubic-bezier(0.8, 0, 0.2, 1) 0.4s;
        }

        .hotspot--title__right {
            float: right;
            padding-right: 0;
            padding-left: 10px;
        }

        .hotspot--cta {
            position: relative;
            float: right;
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ff0000;
            transition: all cubic-bezier(0.8, 0, 0.2, 1) 0.4s;
        }

        .hotspot--cta::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            margin: auto;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #fff;
            z-index: 2;
            transition: opacity 0.6s;
            animation: pulse 1.5s cubic-bezier(0.8, 0, 0.2, 1) 0s infinite;
        }

        .hotspot:hover .hotspot--cta {
            transform: scale(0.6);
        }

        .hotspot:hover .hotspot--cta:after {
            opacity: 0;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.4);
            }

            33% {
                transform: scale(1);
            }

            66% {
                transform: scale(0.4);
            }

            100% {
                transform: scale(0.4);
            }
        }

        .hotspot--iphone {
            top: 62%;
            right: 68%;
        }

        .hotspot--macbook {
            top: 22%;
            right: 48%;
        }

        .hotspot--watch {
            top: 72%;
            left: 45%;
        }

        @media screen and (max-width: 640px) {
            .hotspot--title {
                line-height: 40px;
                font-size: 10px;
            }

            .hotspot--cta {
                width: 40px;
                height: 40px;
            }
        }

        @media screen and (max-width: 420px) {
            .hotspot--title {
                line-height: 30px;
                font-size: 9px;
            }

            .hotspot--cta {
                width: 30px;
                height: 30px;
            }
        }

        @media screen and (max-width: 320px) {
            .hotspot--title {
                display: none;
            }

            .hotspot--cta {
                width: 20px;
                height: 20px;
            }

            .hotspot--cta::after {
                width: 5px;
                height: 5px;
            }
        }

        .cd-product {
            text-align: center;
        }

        .cd-product-wrapper {
            display: inline-block;
            position: relative;
            margin: 0 auto;
            width: 90%;
            max-width: 800px;
        }

        .cd-product-wrapper>img {
            display: block;
        }

        .cd-single-point {
            position: absolute;
            border-radius: 50%;
        }

        .cd-single-point>a {
            position: relative;
            z-index: 2;
            display: block;
            width: 25px;
            height: 25px;
            border-radius: inherit;
            background: #d95353;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            -webkit-transition: background-color 0.2s;
            -moz-transition: background-color 0.2s;
            transition: background-color 0.2s;
        }

        .cd-single-point>a::after,
        .cd-single-point>a:before {
            /* rotating plus icon */
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            bottom: auto;
            right: auto;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            background-color: #ffffff;
            -webkit-transition-property: -webkit-transform;
            -moz-transition-property: -moz-transform;
            transition-property: transform;
            -webkit-transition-duration: 0.2s;
            -moz-transition-duration: 0.2s;
            transition-duration: 0.2s;
        }

        .cd-single-point>a::after {
            height: 2px;
            width: 12px;
        }

        .cd-single-point>a::before {
            height: 12px;
            width: 2px;
        }

        .cd-single-point::after {
            /* this is used to create the pulse animation */
            content: "";
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: inherit;
            background-color: transparent;
            -webkit-animation: cd-pulse 2s infinite;
            -moz-animation: cd-pulse 2s infinite;
            animation: cd-pulse 2s infinite;
        }

        .cd-single-point.hotspot-1 {
            bottom: 54%;
            right: 23%;
        }

        .cd-single-point.hotspot-2 {
            bottom: 45%;
            right: 38%;
        }

        .cd-single-point:nth-of-type(3) {
            top: 47%;
            left: 44%;
        }

        .cd-single-point:nth-of-type(4) {
            top: 80%;
            right: 25%;
        }

        .cd-single-point.is-open>a {
            background-color: #191e47;
        }

        .cd-single-point.is-open>a::after,
        .cd-single-point.is-open>a::before {
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(135deg);
            -moz-transform: translateX(-50%) translateY(-50%) rotate(135deg);
            -ms-transform: translateX(-50%) translateY(-50%) rotate(135deg);
            -o-transform: translateX(-50%) translateY(-50%) rotate(135deg);
            transform: translateX(-50%) translateY(-50%) rotate(135deg);
        }

        .cd-single-point.is-open::after {
            /* remove pulse effect */
            display: none;
        }

        .cd-single-point.is-open .cd-more-info {
            visibility: visible;
            opacity: 1;
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
            -webkit-transition: opacity 0.3s 0s, visibility 0s 0s,
                -webkit-transform 0.3s 0s, top 0.3s 0s, bottom 0.3s 0s, left 0.3s 0s,
                right 0.3s 0s;
            -moz-transition: opacity 0.3s 0s, visibility 0s 0s, -moz-transform 0.3s 0s,
                top 0.3s 0s, bottom 0.3s 0s, left 0.3s 0s, right 0.3s 0s;
            transition: opacity 0.3s 0s, visibility 0s 0s, transform 0.3s 0s, top 0.3s 0s,
                bottom 0.3s 0s, left 0.3s 0s, right 0.3s 0s;
        }

        /* .cd-single-point.visited > a {
  background-color: #475f74;
  background-color: #fff;
}
.cd-single-point.visited > a::after,
.cd-single-point.visited > a::before {
  background-color: #191e47;
} */
        .cd-single-point.visited::after {
            /* pulse effect no more active on visited elements */
            display: none;
        }

        @media only screen and (min-width: 600px) {
            .cd-single-point.is-open .cd-more-info.cd-left {
                right: 140%;
            }

            .cd-single-point.is-open .cd-more-info.cd-right {
                left: 140%;
            }

            .cd-single-point.is-open .cd-more-info.cd-top {
                bottom: 140%;
            }

            .cd-single-point.is-open .cd-more-info.cd-bottom {
                top: 140%;
            }
        }

        @-webkit-keyframes cd-pulse {
            0% {
                -webkit-transform: scale(1);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            50% {
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            100% {
                -webkit-transform: scale(1.6);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0);
            }
        }

        @-moz-keyframes cd-pulse {
            0% {
                -moz-transform: scale(1);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            50% {
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            100% {
                -moz-transform: scale(1.6);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0);
            }
        }

        @keyframes cd-pulse {
            0% {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            50% {
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0.8);
            }

            100% {
                -webkit-transform: scale(1.6);
                -moz-transform: scale(1.6);
                -ms-transform: scale(1.6);
                -o-transform: scale(1.6);
                transform: scale(1.6);
                box-shadow: inset 0 0 1px 1px rgba(217, 83, 83, 0);
            }
        }

        .cd-single-point .cd-more-info {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 3;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            text-align: left;
            line-height: 1.5;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2em 1em 1em;
            visibility: hidden;
            opacity: 0;
            -webkit-transform: scale(0.8);
            -moz-transform: scale(0.8);
            -ms-transform: scale(0.8);
            -o-transform: scale(0.8);
            transform: scale(0.8);
            -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s,
                -webkit-transform 0.3s 0s, top 0.3s 0s, bottom 0.3s 0s, left 0.3s 0s,
                right 0.3s 0s;
            -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s, -moz-transform 0.3s 0s,
                top 0.3s 0s, bottom 0.3s 0s, left 0.3s 0s, right 0.3s 0s;
            transition: opacity 0.3s 0s, visibility 0s 0.3s, transform 0.3s 0s,
                top 0.3s 0s, bottom 0.3s 0s, left 0.3s 0s, right 0.3s 0s;
        }

        .cd-single-point .cd-more-info::before {
            /* triangle next to the interest point description - hidden on mobile */
            content: "";
            position: absolute;
            height: 0;
            width: 0;
            display: none;
            border: 8px solid transparent;
        }

        .cd-single-point .cd-more-info h2 {
            font-size: 22px;
            font-size: 1.375rem;
            margin-bottom: 0.6em;
        }

        .cd-single-point .cd-more-info p {
            color: #758eb1;
        }

        @media only screen and (min-width: 600px) {
            .cd-single-point .cd-more-info {
                position: absolute;
                width: 430px;
                height: 260px;
                padding: 1em;
                overflow-y: visible;
                line-height: 1.4;
                border-radius: 0.25em;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            }

            .cd-single-point .cd-more-info::before {
                display: block;
            }

            .cd-single-point .cd-more-info.cd-left,
            .cd-single-point .cd-more-info.cd-right {
                top: 50%;
                bottom: auto;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
            }

            .cd-single-point .cd-more-info.cd-left::before,
            .cd-single-point .cd-more-info.cd-right::before {
                top: 50%;
                bottom: auto;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
            }

            .cd-single-point .cd-more-info.cd-left {
                right: 160%;
                left: auto;
            }

            .cd-single-point .cd-more-info.cd-left::before {
                border-left-color: rgba(255, 255, 255, 0.95);
                left: 100%;
            }

            .cd-single-point .cd-more-info.cd-right {
                left: 160%;
            }

            .cd-single-point .cd-more-info.cd-right::before {
                border-right-color: rgba(255, 255, 255, 0.95);
                right: 100%;
            }

            .cd-single-point .cd-more-info.cd-top,
            .cd-single-point .cd-more-info.cd-bottom {
                left: 50%;
                right: auto;
                -webkit-transform: translateX(-50%);
                -moz-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                -o-transform: translateX(-50%);
                transform: translateX(-50%);
            }

            .cd-single-point .cd-more-info.cd-top::before,
            .cd-single-point .cd-more-info.cd-bottom::before {
                left: 50%;
                right: auto;
                -webkit-transform: translateX(-50%);
                -moz-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                -o-transform: translateX(-50%);
                transform: translateX(-50%);
            }

            .cd-single-point .cd-more-info.cd-top {
                bottom: 160%;
                top: auto;
            }

            .cd-single-point .cd-more-info.cd-top::before {
                border-top-color: rgba(255, 255, 255, 0.95);
                top: 100%;
            }

            .cd-single-point .cd-more-info.cd-bottom {
                top: 160%;
            }

            .cd-single-point .cd-more-info.cd-bottom::before {
                border-bottom-color: rgba(255, 255, 255, 0.95);
                bottom: 100%;
            }

            .cd-single-point .cd-more-info h2 {
                font-size: 20px;
                font-size: 1.25rem;
                margin-bottom: 0;
            }

            .cd-single-point .cd-more-info p {
                font-size: 14px;
                font-size: 0.875rem;
            }
        }

        /* close the interest point description - only on mobile */
        .cd-close-info {
            position: fixed;
            top: 0;
            right: 0;
            height: 44px;
            width: 44px;
        }

        .cd-close-info::after,
        .cd-close-info:before {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            bottom: auto;
            right: auto;
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(45deg);
            -moz-transform: translateX(-50%) translateY(-50%) rotate(45deg);
            -ms-transform: translateX(-50%) translateY(-50%) rotate(45deg);
            -o-transform: translateX(-50%) translateY(-50%) rotate(45deg);
            transform: translateX(-50%) translateY(-50%) rotate(45deg);
            background-color: #475f74;
            -webkit-transition-property: -webkit-transform;
            -moz-transition-property: -moz-transform;
            transition-property: transform;
            -webkit-transition-duration: 0.2s;
            -moz-transition-duration: 0.2s;
            transition-duration: 0.2s;
        }

        .cd-close-info::after {
            height: 2px;
            width: 16px;
        }

        .cd-close-info::before {
            height: 16px;
            width: 2px;
        }

        @media only screen and (min-width: 600px) {
            .cd-close-info {
                display: none;
            }
        }

        #panorama {
            width: 100%;
            height: 400px;
        }

        .custom-hotspot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fbad18;
        }

        div.custom-tooltip span {
            visibility: hidden;
            position: absolute;
            border-radius: 3px;
            background-color: #fff;
            color: #000;
            text-align: center;
            max-width: 300px;
            min-width: 200px;
            padding: 5px 10px;
            margin-left: -220px;
            cursor: default;
            bottom: -50px;
            border: 1px solid #eee;
        }

        div.custom-tooltip:hover span {
            visibility: visible;
        }
    </style>
</head>

<body>
    <div id="app">
        <v-app>
            @yield('content')
        </v-app>
    </div>
    @include('product.scripts')
</body>

</html>
