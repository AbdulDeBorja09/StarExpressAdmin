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
        <div class="mt-5">
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

                {{-- <div class="panel h-full">
                    <div class="mb-5 flex justify-center">
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Suspended Accounts</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="suspendeds" class="rounded-lg bg-white dark:bg-black">
                            <!-- loader -->
                            <div
                                class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                                <span
                                    class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="panel h-full">
                    <div class="mb-5 flex justify-center">
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Suspended Accounts</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="suspendeds" class="rounded-lg bg-white dark:bg-black">
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
                        <h5 class="text-lg font-semibold dark:text-white-light ">Total Employees Accounts</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="employees" class="rounded-lg bg-white dark:bg-black">
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
                <div class="panel xl:col-span-2 ">
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
                Alpine.data('chart', () => ({
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
    
                    areaChart: null,
                    init() {
                        isDark = this.$store.app.theme === 'dark' || this.$store.app.isDarkMode ? true : false;
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
                        setTimeout(() => {
                           
        
                            this.areaChart = new ApexCharts(this.$refs.areaChart, this.areaChartOptions);
                            this.areaChart.render();


                            this.suspendeds = new ApexCharts(this.$refs.suspendeds, this.suspendedsOptions);
                            this.$refs.suspendeds.innerHTML = '';
                            this.suspendeds.render();

                            this.employees = new ApexCharts(this.$refs.employees, this.EmployeesOptions);
                            this.$refs.employees.innerHTML = '';
                            this.employees.render();
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
                 
                        this.areaChart.updateOptions(this.areaChartOptions);
                        this.suspendeds.updateOptions(this.suspendedsOptions);
                        this.employees.updateOptions(this.EmployeesOptions);
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
                       

                    get suspendedsOptions() {
                        const data = @json($totalsuspendeds);
                        return {
                            series: data,
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
                            labels: ['Customer', 'Employee', 'Drivers'],
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

                    get EmployeesOptions() {
                        const datas = @json($totalemployees);
                        return {
                            series: datas,
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
                            colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#00ab55'] : ['#e2a03f', '#5c1ac3', '#e7515a', '#00ab55'],
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
                            labels: ['Human Resource', 'Accountant', 'Service Manager', 'Drivers'],
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