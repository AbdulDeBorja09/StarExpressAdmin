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
    <div>
        <div class="mt-5" x-data="sales">
            <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
                <!-- Users Visit -->
                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Human Resources
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$hr}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>


                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Accountant
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$accountant}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Service Manager
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$servicemanager}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Driver
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$driver}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Total Employees
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$hr + $accountant +
                            $servicemanager + $driver}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Suspended Employees
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$suspendedemployee}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>


                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Total Users
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$users}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1" style="font-size: 20px">Suspended Users
                        </div>
                    </div>
                    <div class="mt-5 flex items-center" style="display: flex; justify-content: space-between">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$suspendeduser}}</div>
                        <svg width="10" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="height: 50px; width: 50px;">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5">
                            </ellipse>
                            <path opacity="0.5"
                                d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5"
                                d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>


            </div>

            <div class="mb-6 grid gap-6 xl:grid-cols-3" x-data="chart">
                {{-- <div class="panel xl:col-span-2">
                    <div class=" mb-5 flex items-center justify-between">
                        <h5 class="text-lg font-semibold dark:text-white">Website Visit Analytics</h5><br>

                    </div>
                    <h5 class="text-lg font-semibold dark:text-white">Total: {{ number_format(array_sum($data)) }}</h5>
                    <div x-ref="areaChart" class="bg-white dark:bg-black rounded-lg mr-3"></div>
                </div> --}}
                <div class="panel h-full">
                    <div class="mb-5 flex justify-center">
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Suspended Accounts</h5>
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
                    <div class="mb-5 flex justify-center">
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Suspended Accounts</h5>
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
                    <div class="mb-5 flex justify-center">
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Suspended Accounts</h5>
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

            <div class="mb-6 grid gap-6 xl:grid-cols-1" x-data="chart">
                <div class="panel xl:col-span-2">
                    <div class=" mb-5 flex items-center justify-between">
                        <h5 class="text-lg font-semibold dark:text-white">Website Visit Analytics</h5><br>

                    </div>
                    <h5 class="text-lg font-semibold dark:text-white">Total: {{ number_format(array_sum($data)) }}</h5>
                    <div x-ref="areaChart" class="bg-white dark:bg-black rounded-lg mr-3"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    document.addEventListener('alpine:init', () => {
                // main section
               
        
                Alpine.data('chart', () => ({
                    // highlightjs
                    codeArr: [],
                    toggleCode(name) {
                        if (this.codeArr.includes(name)) {
                            this.codeArr = this.codeArr.filter((d) => d != name);
                        } else {
                            this.codeArr.push(name);
        
                            setTimeout(() => {
                                document.querySelectorAll('pre.code').forEach((el) => {
                                    hljs.highlightElement(el);
                                });
                            });
                        }
                    },
        
                    lineChart: null,
                    areaChart: null,
                    columnChart: null,
                    simpleColumnStacked: null,
                    barChart: null,
                    mixedChart: null,
                    radarChart: null,
                    pieChart: null,
                    donutChart: null,
                    polarAreaChart: null,
                    radialBarChart: null,
                    bubbleChart: null,
                    // salesByCategory = null,
        
                    init() {
                        isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
        
                        setTimeout(() => {
                            this.lineChart = new ApexCharts(this.$refs.lineChart, this.lineChartOptions);
                            this.lineChart.render();
        
                            let areaChart = new ApexCharts(this.$refs.areaChart, this.areaChartOptions);
                            areaChart.render();
        
                            this.columnChart = new ApexCharts(this.$refs.columnChart, this.columnChartOptions);
                            this.columnChart.render();
        
                            this.simpleColumnStacked = new ApexCharts(this.$refs.simpleColumnStacked, this.simpleColumnStackedOptions);
                            this.simpleColumnStacked.render();
        
                            this.barChart = new ApexCharts(this.$refs.barChart, this.barChartOptions);
                            this.barChart.render();
        
                            this.mixedChart = new ApexCharts(this.$refs.mixedChart, this.mixedChartOptions);
                            this.mixedChart.render();
        
                            this.radarChart = new ApexCharts(this.$refs.radarChart, this.radarChartOptions);
                            this.radarChart.render();
        
                            this.pieChart = new ApexCharts(this.$refs.pieChart, this.pieChartOptions);
                            this.pieChart.render();
        
                            this.donutChart = new ApexCharts(this.$refs.donutChart, this.donutChartOptions);
                            this.donutChart.render();
        
                            this.polarAreaChart = new ApexCharts(this.$refs.polarAreaChart, this.polarAreaChartOptions);
                            this.polarAreaChart.render();
        
                            this.radialBarChart = new ApexCharts(this.$refs.radialBarChart, this.radialBarChartOptions);
                            this.radialBarChart.render();
        
                            this.bubbleChart = new ApexCharts(this.$refs.bubbleChart, this.bubbleChartOptions);
                            this.bubbleChart.render();

                            this.salesByCategory = new ApexCharts(this.$refs.salesByCategory, this.salesByCategoryOptions);
                            this.$refs.salesByCategory.innerHTML = '';
                            this.salesByCategory.render();
                        }, 300);
        
                        this.$watch('$store.app.theme', () => {
                            this.refreshOptions();
                        });
        
                        this.$watch('$store.app.rtlClass', () => {
                            this.refreshOptions();
                        });
                    },
        
                    refreshOptions() {
                        isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
                        this.lineChart.updateOptions(this.lineChartOptions);
                        this.areaChart.updateOptions(this.areaChartOptions);
                        this.columnChart.updateOptions(this.columnChartOptions);
                        this.simpleColumnStacked.updateOptions(this.simpleColumnStackedOptions);
                        this.barChart.updateOptions(this.barChartOptions);
                        this.mixedChart.updateOptions(this.mixedChartOptions);
                        this.radarChart.updateOptions(this.radarChartOptions);
                        this.pieChart.updateOptions(this.pieChartOptions);
                        this.donutChart.updateOptions(this.donutChartOptions);
                        this.polarAreaChart.updateOptions(this.polarAreaChartOptions);
                        this.radialBarChart.updateOptions(this.radialBarChartOptions);
                        this.bubbleChart.updateOptions(this.bubbleChartOptions);
                        this.salesByCategory.updateOptions(this.salesByCategory);
                        
                    },
        
                    get lineChartOptions() {
                        return {
                            chart: {
                                height: 300,
                                type: 'line',
                                toolbar: false,
                            },
                            colors: ['#4361ee'],
                            tooltip: {
                                marker: false,
                                y: {
                                    formatter(number) {
                                        return '$' + number;
                                    },
                                },
                            },
                            stroke: {
                                width: 2,
                                curve: 'smooth',
                            },
                            xaxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'],
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -20 : 0,
                                },
                            },
                            series: [
                                {
                                    name: 'Sales',
                                    data: [45, 55, 75, 25, 45, 110],
                                },
                            ],
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                            },
                        };
                    },
                    
                    get areaChartOptions() {
                        const rawData = @json($data);
                        const data = rawData.map(value => Math.round(value)); 
                        const labels = @json($months); 

                        return {
                            series: [{
                                name: 'Visits',
                                data: data
                            }],
                            chart: {
                                type: 'area',
                                height: 300,
                                zoom: {
                                    enabled: false
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            colors: ['#805dca'],
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 2,
                                curve: 'smooth'
                            },
                            xaxis: {
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed'
                                },
                            },
                            yaxis: {
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -40 : 0,
                                }
                            },
                            labels: labels,
                            legend: {
                                horizontalAlign: 'left'
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                                y: {
                                    formatter: value => parseInt(value) // Format tooltip values as integers
                                }
                            }
                        }
                    },
                       
                    get columnChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'Net Profit',
                                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                                },
                                {
                                    name: 'Revenue',
                                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                                },
                            ],
                            chart: {
                                height: 300,
                                type: 'bar',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#805dca', '#e7515a'],
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: true,
                                width: 2,
                                colors: ['transparent'],
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '55%',
                                    endingShape: 'rounded',
                                },
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            xaxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -10 : 0,
                                },
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                                y: {
                                    formatter: function (val) {
                                        return val;
                                    },
                                },
                            },
                        };
                    },
        
                    get simpleColumnStackedOptions() {
                        return {
                            series: [
                                {
                                    name: 'PRODUCT A',
                                    data: [44, 55, 41, 67, 22, 43],
                                },
                                {
                                    name: 'PRODUCT B',
                                    data: [13, 23, 20, 8, 13, 27],
                                },
                            ],
                            chart: {
                                height: 300,
                                type: 'bar',
                                stacked: true,
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#2196f3', '#3b3f5c'],
                            responsive: [
                                {
                                    breakpoint: 480,
                                    options: {
                                        legend: {
                                            position: 'bottom',
                                            offsetX: -10,
                                            offsetY: 5,
                                        },
                                    },
                                },
                            ],
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                },
                            },
                            xaxis: {
                                type: 'datetime',
                                categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -20 : 0,
                                },
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            legend: {
                                position: 'right',
                                offsetY: 40,
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                            },
                            fill: {
                                opacity: 0.8,
                            },
                        };
                    },
        
                    get barChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'Sales',
                                    data: [44, 55, 41, 67, 22, 43, 21, 70],
                                },
                            ],
                            chart: {
                                height: 300,
                                type: 'bar',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: true,
                                width: 1,
                            },
                            colors: ['#4361ee'],
                            xaxis: {
                                categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                opposite: isRtl ? true : false,
                                reversed: isRtl ? true : false,
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: true,
                                },
                            },
                            fill: {
                                opacity: 0.8,
                            },
                        };
                    },
        
                    get mixedChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'TEAM A',
                                    type: 'column',
                                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30],
                                },
                                {
                                    name: 'TEAM B',
                                    type: 'area',
                                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43],
                                },
                                {
                                    name: 'TEAM C',
                                    type: 'line',
                                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39],
                                },
                            ],
                            chart: {
                                height: 300,
                                // stacked: false,
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#2196f3', '#00ab55', '#4361ee'],
                            stroke: {
                                width: [0, 2, 2],
                                curve: 'smooth',
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '50%',
                                },
                            },
                            fill: {
                                opacity: [1, 0.25, 1],
                            },
        
                            labels: [
                                '01/01/2022',
                                '02/01/2022',
                                '03/01/2022',
                                '04/01/2022',
                                '05/01/2022',
                                '06/01/2022',
                                '07/01/2022',
                                '08/01/2022',
                                '09/01/2022',
                                '10/01/2022',
                                '11/01/2022',
                            ],
                            markers: {
                                size: 0,
                            },
                            xaxis: {
                                type: 'datetime',
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                title: {
                                    text: 'Points',
                                },
                                min: 0,
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -10 : 0,
                                },
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            tooltip: {
                                shared: true,
                                intersect: false,
                                theme: isDark ? 'dark' : 'light',
                                y: {
                                    formatter: (y) => {
                                        if (typeof y !== 'undefined') {
                                            return y.toFixed(0) + ' points';
                                        }
                                        return y;
                                    },
                                },
                            },
                            legend: {
                                itemMargin: {
                                    horizontal: 4,
                                    vertical: 8,
                                },
                            },
                        };
                    },
        
                    get radarChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'Series 1',
                                    data: [80, 50, 30, 40, 100, 20],
                                },
                            ],
                            chart: {
                                height: 300,
                                type: 'radar',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#4361ee'],
                            xaxis: {
                                categories: ['January', 'February', 'March', 'April', 'May', 'June'],
                            },
                            plotOptions: {
                                radar: {
                                    polygons: {
                                        strokeColors: isDark ? '#191e3a' : '#e0e6ed',
                                        connectorColors: isDark ? '#191e3a' : '#e0e6ed',
                                    },
                                },
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                            },
                        };
                    },
        
                    get pieChartOptions() {
                        return {
                            series: [44, 55, 13, 43, 22],
                            chart: {
                                height: 300,
                                type: 'pie',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                            colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                            responsive: [
                                {
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200,
                                        },
                                    },
                                },
                            ],
                            stroke: {
                                show: false,
                            },
                            legend: {
                                position: 'bottom',
                            },
                        };
                    },
        
                    get donutChartOptions() {
                        return {
                            series: [44, 55, 13],
                            chart: {
                                height: 300,
                                type: 'donut',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            stroke: {
                                show: false,
                            },
                            labels: ['Team A', 'Team B', 'Team C'],
                            colors: ['#4361ee', '#805dca', '#e2a03f'],
                            responsive: [
                                {
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200,
                                        },
                                    },
                                },
                            ],
                            legend: {
                                position: 'bottom',
                            },
                        };
                    },
        
                    get polarAreaChartOptions() {
                        return {
                            series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
                            chart: {
                                height: 300,
                                type: 'polarArea',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f', '#2196f3', '#3b3f5c'],
                            stroke: {
                                show: false,
                            },
                            responsive: [
                                {
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200,
                                        },
                                    },
                                },
                            ],
                            plotOptions: {
                                polarArea: {
                                    rings: {
                                        strokeColor: isDark ? '#191e3a' : '#e0e6ed',
                                    },
                                    spokes: {
                                        connectorColors: isDark ? '#191e3a' : '#e0e6ed',
                                    },
                                },
                            },
                            legend: {
                                position: 'bottom',
                            },
                            fill: {
                                opacity: 0.85,
                            },
                        };
                    },
        
                    get radialBarChartOptions() {
                        return {
                            series: [44, 55, 41, 50],
                            chart: {
                                height: 300,
                                type: 'radialBar',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#4361ee', '#805dca', '#e2a03f'],
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        name: {
                                            fontSize: '22px',
                                        },
                                        value: {
                                            fontSize: '16px',
                                        },
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            formatter: function (w) {
                                                let total = 0;
                                                    for (let i = 0; i < w.config.series.length; i++) {
                                                        total += w.config.series[i];
                                                    }
                                                    return total;
                                            },
                                        },
                                    },
                                },
                            },
                            labels: ['Apples', 'Oranges', 'Bananas', 'Orange'],
                            fill: {
                                opacity: 0.85,
                            },
                        };
                    },
        
                    get bubbleChartOptions() {
                        return {
                            series: [
                                {
                                    name: 'Bubble1',
                                    data: this.generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                                        min: 10,
                                        max: 60,
                                    }),
                                },
                                {
                                    name: 'Bubble2',
                                    data: this.generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                                        min: 10,
                                        max: 60,
                                    }),
                                },
                            ],
                            chart: {
                                height: 300,
                                type: 'bubble',
                                zoom: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            colors: ['#4361ee', '#00ab55'],
                            dataLabels: {
                                enabled: false,
                            },
                            xaxis: {
                                tickAmount: 12,
                                type: 'category',
                                axisBorder: {
                                    color: isDark ? '#191e3a' : '#e0e6ed',
                                },
                            },
                            yaxis: {
                                max: 70,
                                opposite: isRtl ? true : false,
                                labels: {
                                    offsetX: isRtl ? -10 : 0,
                                },
                            },
                            grid: {
                                borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                            },
                            stroke: {
                                colors: isDark ? ['#191e3a'] : ['#e0e6ed'],
                            },
                            fill: {
                                opacity: 0.85,
                            },
                        };
                    },
        
                    generateData(baseval, count, yrange) {
                        var i = 0;
                        var series = [];
                        while (i < count) {
                            var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
                            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                            var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;
        
                            series.push([x, y, z]);
                            baseval += 86400000;
                            i++;
                        }
                        return series;
                    },
                    // sales by category
                    get salesByCategoryOptions() {
                        return {
                            series: [1, 0, 5],
                            chart: {
                                type: 'donut',
                                height: 460,
                                fontFamily: 'Nunito, sans-serif',
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                show: true,
                                width: 25,
                                colors: isDark ? '#0e1726' : '#fff',
                            },
                            colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f', '#5c1ac3', '#e7515a'],
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center',
                                fontSize: '14px',
                                markers: {
                                    width: 10,
                                    height: 10,
                                    offsetX: -2,
                                },
                                height: 50,
                                offsetY: 20,
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '65%',
                                        background: 'transparent',
                                        labels: {
                                            show: true,
                                            name: {
                                                show: true,
                                                fontSize: '29px',
                                                offsetY: -10,
                                            },
                                            value: {
                                                show: true,
                                                fontSize: '26px',
                                                color: isDark ? '#bfc9d4' : undefined,
                                                offsetY: 16,
                                                formatter: (val) => {
                                                    return val;
                                                },
                                            },
                                            total: {
                                                show: true,
                                                label: 'Total',
                                                color: '#888ea8',
                                                fontSize: '29px',
                                                formatter: (w) => {
                                                    return w.globals.seriesTotals.reduce(function (a, b) {
                                                        return a + b;
                                                    }, 0);
                                                },
                                            },
                                        },
                                    },
                                },
                            },
                            labels: ['New Orders', 'Processing', 'To Deliver'],
                            states: {
                                hover: {
                                    filter: {
                                        type: 'none',
                                        value: 0.15,
                                    },
                                },
                                active: {
                                    filter: {
                                        type: 'none',
                                        value: 0.15,
                                    },
                                },
                            },
                        };
                    },


                }));
            });
</script>



@endsection