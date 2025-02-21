<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--
    <link rel="icon" type="image/x-icon" href="favicon.png"> --}}


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    {{--
    <link href="{{asset('/font/css2?family=Nunito:wght@400;500;600;700;800&display=swap')}}" rel="stylesheet"> --}}


    {{-- main css --}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/customcss.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/perfect-scrollbar.min.css')}}">
    <link defer="" rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/animate.css')}}">
    <script src="{{asset('/js/perfect-scrollbar.min.js')}}"></script>
    <script defer="" src="{{asset('/js/popper.min.js')}}"></script>
    <script defer="" src="{{asset('/js/tippy-bundle.umd.min.js')}}"></script>
    <script defer="" src="{{asset('/js/sweetalert.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    {{-- @livewireStyles --}}

</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
    :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">
    <!-- sidebar menu overlay -->
    <div x-cloak="" class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}"
        @click="$store.app.toggleSidebar()"></div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- screen loader -->
    <div
        class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewbox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path
                d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animatetransform attributename="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s"
                    repeatcount="indefinite"></animatetransform>
            </path>
            <path
                d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animatetransform attributename="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s"
                    repeatcount="indefinite"></animatetransform>
            </path>
        </svg>
    </div>

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        @include('layout.sidebar')
        <div class="main-content flex min-h-screen flex-col">
            @include('layout.navbar')
            <main>
                @yield('content')
            </main>
            @include('layout.footer')
        </div>
    </div>

    <script src="{{asset('/js/alpine-collaspe.min.js')}}"></script>
    <script src="{{asset('/js/alpine-persist.min.js')}}"></script>
    <script defer="" src="{{asset('/js/alpine-ui.min.js')}}"></script>
    <script defer="" src="{{asset('/js/alpine-focus.min.js')}}"></script>
    <script defer="" src="{{asset('/js/alpine.min.js')}}"></script>
    <script src="{{asset('/js/custom.js')}}"></script>
    <script defer="" src="{{asset('/js/apexcharts.js')}}"></script>

</body>

</html>