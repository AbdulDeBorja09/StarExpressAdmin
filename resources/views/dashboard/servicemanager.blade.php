@extends('layout.app')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <ol class="flex font-semibold text-gray-500 dark:text-white-dark">
        <li>
            <a href="{{url('/')}}" class="hover:text-gray-500/70 dark:hover:text-white-dark/70">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4  shrink-0">
                    <path opacity="0.5"
                        d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                        stroke="currentColor" stroke-width="1.5"></path>
                    <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
            </a>
        </li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Dashboard</a>
        </li>
    </ol>
    <div class="p-5" x-data="sales">
        <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
            <!-- Users Visit -->
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Total Cargo</div>
                </div>
                <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$totalOrders}}</div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M22 12C22 12 21.0071 12.8907 19.0212 13.6851L16.2127 14.8085C14.2268 15.6028 13.2339 16 12 16C10.7661 16 9.77318 15.6028 7.7873 14.8085L4.97883 13.6851C2.99294 12.8907 2 12 2 12"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M22 16C22 16 21.0071 16.8907 19.0212 17.6851L16.2127 18.8085C14.2268 19.6028 13.2339 20 12 20C10.7661 20 9.77318 19.6028 7.7873 18.8085L4.97883 17.6851C2.99294 16.8907 2 16 2 16"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
            </div>

            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">New Cargo</div>
                </div>
                <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">100</div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M22 12C22 12 21.0071 12.8907 19.0212 13.6851L16.2127 14.8085C14.2268 15.6028 13.2339 16 12 16C10.7661 16 9.77318 15.6028 7.7873 14.8085L4.97883 13.6851C2.99294 12.8907 2 12 2 12"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M22 16C22 16 21.0071 16.8907 19.0212 17.6851L16.2127 18.8085C14.2268 19.6028 13.2339 20 12 20C10.7661 20 9.77318 19.6028 7.7873 18.8085L4.97883 17.6851C2.99294 16.8907 2 16 2 16"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
            </div>
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">In Warehouse</div>
                </div>
                <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">100</div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M22 12C22 12 21.0071 12.8907 19.0212 13.6851L16.2127 14.8085C14.2268 15.6028 13.2339 16 12 16C10.7661 16 9.77318 15.6028 7.7873 14.8085L4.97883 13.6851C2.99294 12.8907 2 12 2 12"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M22 16C22 16 21.0071 16.8907 19.0212 17.6851L16.2127 18.8085C14.2268 19.6028 13.2339 20 12 20C10.7661 20 9.77318 19.6028 7.7873 18.8085L4.97883 17.6851C2.99294 16.8907 2 16 2 16"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
            </div>
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">To Deliver</div>
                </div>
                <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">100</div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M22 12C22 12 21.0071 12.8907 19.0212 13.6851L16.2127 14.8085C14.2268 15.6028 13.2339 16 12 16C10.7661 16 9.77318 15.6028 7.7873 14.8085L4.97883 13.6851C2.99294 12.8907 2 12 2 12"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M22 16C22 16 21.0071 16.8907 19.0212 17.6851L16.2127 18.8085C14.2268 19.6028 13.2339 20 12 20C10.7661 20 9.77318 19.6028 7.7873 18.8085L4.97883 17.6851C2.99294 16.8907 2 16 2 16"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
            </div>


        </div>
        <div class="mb-6 grid gap-6 xl:grid-cols-3">
            <div class="panel h-full">
                <div class="mb-5 flex items-center">
                    <h5 class="text-lg font-semibold dark:text-white-light">Total Reports</h5>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="salesByCategory" class="rounded-lg bg-white dark:bg-black">
                        <!-- loader -->
                        <div
                            class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                            <span
                                class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel h-full">
                <div class="mb-5 flex items-center">
                    <h5 class="text-lg font-semibold dark:text-white-light">Total Deliveries</h5>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="salesByCategory" class="rounded-lg bg-white dark:bg-black">
                        <!-- loader -->
                        <div
                            class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                            <span
                                class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel h-full">
                <div class="mb-5 flex items-center">
                    <h5 class="text-lg font-semibold dark:text-white-light">Total Truck</h5>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="salesByCategory" class="rounded-lg bg-white dark:bg-black">
                        <!-- loader -->
                        <div
                            class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                            <span
                                class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6 grid gap-6 xl:grid-cols-1">
            <div x-ref="areaChart" class="bg-white dark:bg-black rounded-lg">
                <div
                    class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                    <span
                        class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
           
            Alpine.data('sales', () => ({
                init() {
                    isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;
                    isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;

                    const revenueChart = null;
                    const salesByCategory = null;
                   

                    // revenue
                    setTimeout(() => {
                        this.revenueChart = new ApexCharts(this.$refs.revenueChart, this.revenueChartOptions);
                        this.$refs.revenueChart.innerHTML = '';
                        this.revenueChart.render();

                        // sales by category
                        this.salesByCategory = new ApexCharts(this.$refs.salesByCategory, this.salesByCategoryOptions);
                        this.$refs.salesByCategory.innerHTML = '';
                        this.salesByCategory.render();

                
                    }, 300);

                    this.$watch('$store.app.theme', () => {
                        isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;

                        this.revenueChart.updateOptions(this.revenueChartOptions);
                        this.salesByCategory.updateOptions(this.salesByCategoryOptions);
                       
                    });

                    this.$watch('$store.app.rtlClass', () => {
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
                        this.revenueChart.updateOptions(this.revenueChartOptions);
                    });
                },

                // revenue
                // get revenueChartOptions() {
                //    
                   
                //     return {
                //         series: [
                //             {
                //                 name: 'Income',
                //                 data: data,
                //             }
                //         ],
                //         chart: {
                //             height: 325,
                //             type: 'area',
                //             fontFamily: 'Nunito, sans-serif',
                //             zoom: {
                //                 enabled: false,
                //             },
                //             toolbar: {
                //                 show: false,
                //             },
                //         },
                //         dataLabels: {
                //             enabled: false,
                //         },
                //         stroke: {
                //             show: true,
                //             curve: 'smooth',
                //             width: 2,
                //             lineCap: 'square',
                //         },
                //         dropShadow: {
                //             enabled: true,
                //             opacity: 0.2,
                //             blur: 10,
                //             left: -7,
                //             top: 22,
                //         },
                //         colors: isDark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
                //         markers: {
                //             discrete: [
                //                 {
                //                     seriesIndex: 0,
                //                     dataPointIndex: 6,
                //                     fillColor: '#1b55e2',
                //                     strokeColor: 'transparent',
                //                     size: 7,
                //                 }
                //             ],
                //         },
                //         labels: labels,
                //         xaxis: {
                //             axisBorder: {
                //                 show: false,
                //             },
                //             axisTicks: {
                //                 show: false,
                //             },
                //             crosshairs: {
                //                 show: false,
                //             },
                //             labels: {
                //                 offsetX: isRtl ? 2 : 0,
                //                 offsetY: 5,
                //                 style: {
                //                     fontSize: '12px',
                //                     cssClass: 'apexcharts-xaxis-title',
                //                 },
                //             },
                //         },
                //         yaxis: {
                //             tickAmount: 7,
                //             labels: {
                //                 formatter: (value) => {
                //                     return value.toLocaleString(); 
                //                 },
                //                 offsetX: isRtl ? -30 : -10,
                //                 offsetY: 0,
                //                 style: {
                //                     fontSize: '12px',
                //                     cssClass: 'apexcharts-yaxis-title',
                //                 },
                //             },
                //             opposite: isRtl ? true : false,
                //         },
                //         grid: {
                //             borderColor: isDark ? '#191e3a' : '#e0e6ed',
                //             strokeDashArray: 5,
                //             xaxis: {
                //                 lines: {
                //                     show: true,
                //                 },
                //             },
                //             yaxis: {
                //                 lines: {
                //                     show: false,
                //                 },
                //             },
                //             padding: {
                //                 top: 0,
                //                 right: 0,
                //                 bottom: 0,
                //                 left: 0,
                //             },
                //         },
                //         legend: {
                //             position: 'top',
                //             horizontalAlign: 'right',
                //             fontSize: '16px',
                //             markers: {
                //                 width: 10,
                //                 height: 10,
                //                 offsetX: -2,
                //             },
                //             itemMargin: {
                //                 horizontal: 10,
                //                 vertical: 5,
                //             },
                //         },
                //         tooltip: {
                //             marker: {
                //                 show: true,
                //             },
                //             x: {
                //                 show: false,
                //             },
                //         },
                //         fill: {
                //             type: 'gradient',
                //             gradient: {
                //                 shadeIntensity: 1,
                //                 inverseColors: !1,
                //                 opacityFrom: isDark ? 0.19 : 0.28,
                //                 opacityTo: 0.05,
                //                 stops: isDark ? [100, 100] : [45, 100],
                //             },
                //         },
                //     };
                // },

                // // sales by category
                // get salesByCategoryOptions() {
                //     return {
                //         series: [1, 0, 5],
                //         chart: {
                //             type: 'donut',
                //             height: 460,
                //             fontFamily: 'Nunito, sans-serif',
                //         },
                //         dataLabels: {
                //             enabled: false,
                //         },
                //         stroke: {
                //             show: true,
                //             width: 25,
                //             colors: isDark ? '#0e1726' : '#fff',
                //         },
                //         colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f', '#5c1ac3', '#e7515a'],
                //         legend: {
                //             position: 'bottom',
                //             horizontalAlign: 'center',
                //             fontSize: '14px',
                //             markers: {
                //                 width: 10,
                //                 height: 10,
                //                 offsetX: -2,
                //             },
                //             height: 50,
                //             offsetY: 20,
                //         },
                //         plotOptions: {
                //             pie: {
                //                 donut: {
                //                     size: '65%',
                //                     background: 'transparent',
                //                     labels: {
                //                         show: true,
                //                         name: {
                //                             show: true,
                //                             fontSize: '29px',
                //                             offsetY: -10,
                //                         },
                //                         value: {
                //                             show: true,
                //                             fontSize: '26px',
                //                             color: isDark ? '#bfc9d4' : undefined,
                //                             offsetY: 16,
                //                             formatter: (val) => {
                //                                 return val;
                //                             },
                //                         },
                //                         total: {
                //                             show: true,
                //                             label: 'Total',
                //                             color: '#888ea8',
                //                             fontSize: '29px',
                //                             formatter: (w) => {
                //                                 return w.globals.seriesTotals.reduce(function (a, b) {
                //                                     return a + b;
                //                                 }, 0);
                //                             },
                //                         },
                //                     },
                //                 },
                //             },
                //         },
                //         labels: ['New Orders', 'Processing', 'To Deliver'],
                //         states: {
                //             hover: {
                //                 filter: {
                //                     type: 'none',
                //                     value: 0.15,
                //                 },
                //             },
                //             active: {
                //                 filter: {
                //                     type: 'none',
                //                     value: 0.15,
                //                 },
                //             },
                //         },
                //     };
                // },

            
            }));
        });
    </script>

    @endsection