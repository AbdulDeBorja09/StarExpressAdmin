<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    {{--
    <link href="{{asset('/font/css2.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/customcss.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/perfect-scrollbar.min.css')}}">
    <link defer="" rel="stylesheet" type="text/css" media="screen" href="{{asset('/css/animate.css')}}">
    <script src="{{asset('/js/perfect-scrollbar.min.js')}}"></script>
    <script defer="" src="{{asset('/js/popper.min.js')}}"></script>
    <script defer="" src="{{asset('/js/tippy-bundle.umd.min.js')}}"></script>
    <script defer="" src="{{asset('/js/sweetalert.min.js')}}"></script>


</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
    :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">
    <!-- sidebar menu overlay -->
    <div x-cloak="" class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}"
        @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    {{-- <div
        class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <img src="{{asset('/images/star/Logo2.png')}}" alt="">

    </div> --}}

    <main>
        @yield('content')
    </main>

    <script src="{{asset('/js/alpine-collaspe.min.js')}}"></script>
    <script src="{{asset('/js/alpine-persist.min.js')}}"></script>
    <script defer="" src="{{asset('/js/alpine-ui.min.js')}}"></script>
    <script defer="" src="{{asset('/js/alpine-focus.min.js')}}"></script>
    <script src="{{asset('/js/custom.js')}}"></script>
    <script defer="" src=" {{asset('/js/alpine.min.js')}}"></script>
    <script src="{{asset('/js/screenloader.min.js')}}"></script>
    <script src="{{asset('/js/apexcharts.js')}}"></script>

</body>

</html>