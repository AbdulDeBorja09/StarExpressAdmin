@extends('layout.app')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]" wire:ignore>
    <!-- start main content section -->
    <div>
        <div class="relative flex h-full gap-5 sm:h-[calc(100vh_-_150px)] sm:min-h-0">
            <div
                class="panel absolute z-10 hidden w-full max-w-xs flex-none space-y-4 overflow-hidden p-4 xl:relative xl:block xl:h-full">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-none">
                            @if (session('avatar') !== null)
                            <img class="h-12 w-12 rounded-full object-cover"
                                src=" {{ Storage::url(session('avatar')) }}" alt="User Avatar">
                            @else
                            <img class="h-12 w-12 rounded-full object-cover" src="/images/avatar.png" alt="image">
                            @endif
                        </div>
                        <div class="mx-3">
                            <p class="mb-1 font-semibold">{{Auth::user()->fname}} {{Auth::user()->lname}}</p>
                            <p class="text-xs text-white-dark">{{Auth::user()->type}}</p>
                        </div>
                    </div>

                </div>
                <div class="relative">
                    <input type="text" class="peer form-input ltr:pr-9 rtl:pl-9" placeholder="Searching...">
                    <div class="absolute top-1/2 -translate-y-1/2 peer-focus:text-primary ltr:right-2 rtl:left-2">
                        <svg width="16" height="16" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5">
                            </circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                <div class="!mt-0">
                    <div
                        class="chat-users perfect-scrollbar relative -mr-3.5 h-full min-h-[100px] space-y-0.5 pr-3.5 sm:h-[calc(100vh_-_357px)]">

                        <button
                            class="flex w-full items-center justify-between rounded-md p-2 hover:bg-gray-100 hover:text-primary dark:hover:bg-[#050b14] dark:hover:text-primary">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="relative flex-shrink-0">
                                        <img src="/images/avatar.png" class="h-12 w-12 rounded-full object-cover">
                                        <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                            <div class="h-4 w-4 rounded-full bg-success"></div>
                                        </div>

                                    </div>
                                    <div class="mx-3 ltr:text-left rtl:text-right">
                                        <p class="mb-1 font-semibold">Full Name</p>
                                        <p class="max-w-[185px] truncate text-xs text-white-dark">Lorem ipsum dolor
                                            sit
                                            amet consectetur adipisicing elit. Dignissimos sequi, asperiores commodi
                                            quidem facere quas suscipit officia! Dolorem, in consequuntur tenetur
                                            nulla
                                            rem, molestias dolor sed doloribus aut voluptatem voluptatibus?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="whitespace-nowrap text-xs font-semibold">
                                <p>10:00pm</p>
                            </div>
                        </button>

                    </div>
                </div>
            </div>
            <div class="absolute z-[5] hidden h-full w-full rounded-md bg-black/60"></div>
            <div class="panel flex-1 p-0">
                <template>
                    <div class="relative flex h-full items-center justify-center p-4">
                        <button type="button"
                            class="absolute top-4 hover:text-primary ltr:left-4 rtl:right-4 xl:hidden">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                </path>
                                <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                </path>
                            </svg>
                        </button>



                        {{-- CHAT LANDING PAGE --}}
                        <div class="flex flex-col items-center justify-center py-8">
                            <!-- <img src="assets/images/chat_img.svg" alt="image" class="w-[280px] md:w-[430px] mx-auto mb-8 h-[calc(100vh_-_320px)] min-h-[120px]" /> -->
                            <div
                                class="mb-8 h-[calc(100vh_-_320px)] min-h-[120px] w-[280px] text-white dark:text-[#0e1726] md:w-[430px]">
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" class="h-full w-full"
                                    viewbox="0 0 891.29496 745.19434" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <ellipse cx="418.64354" cy="727.19434" rx="352" ry="18"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </ellipse>
                                    <path
                                        d="M778.64963,250.35008h-3.99878V140.80476a63.40187,63.40187,0,0,0-63.4018-63.40193H479.16232a63.40188,63.40188,0,0,0-63.402,63.4017v600.9744a63.40189,63.40189,0,0,0,63.4018,63.40192H711.24875a63.40187,63.40187,0,0,0,63.402-63.40168V328.32632h3.99878Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#3f3d56"></path>
                                    <path
                                        d="M761.156,141.24713v600.09a47.35072,47.35072,0,0,1-47.35,47.35h-233.2a47.35084,47.35084,0,0,1-47.35-47.35v-600.09a47.3509,47.3509,0,0,1,47.35-47.35h28.29a22.50659,22.50659,0,0,0,20.83,30.99h132.96a22.50672,22.50672,0,0,0,20.83-30.99h30.29A47.35088,47.35088,0,0,1,761.156,141.24713Z"
                                        transform="translate(-154.35252 -77.40283)" fill="currentColor"></path>
                                    <path
                                        d="M686.03027,400.0032q-2.32543,1.215-4.73047,2.3-2.18994.99-4.4497,1.86c-.5503.21-1.10987.42-1.66992.63a89.52811,89.52811,0,0,1-13.6001,3.75q-3.43506.675-6.96,1.06-2.90991.33-5.87989.47c-1.41015.07-2.82031.1-4.24023.1a89.84124,89.84124,0,0,1-16.75977-1.57c-1.44043-.26-2.85009-.57-4.26025-.91a88.77786,88.77786,0,0,1-19.66992-7.26c-.56006-.28-1.12012-.58-1.68018-.87-.83008-.44-1.63965-.9-2.4497-1.38.38964-.54.81005-1.07,1.23974-1.59a53.03414,53.03414,0,0,1,78.87012-4.1,54.27663,54.27663,0,0,1,5.06006,5.86C685.25977,398.89316,685.6499,399.44321,686.03027,400.0032Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#6c63ff"></path>
                                    <circle cx="492.14325" cy="234.76352" r="43.90974" fill="#2f2e41"></circle>
                                    <circle cx="642.49883" cy="327.46205" r="32.68086"
                                        transform="translate(-232.6876 270.90663) rotate(-28.66315)" fill="#a0616a">
                                    </circle>
                                    <path
                                        d="M676.8388,306.90589a44.44844,44.44844,0,0,1-25.402,7.85033,27.23846,27.23846,0,0,0,10.796,4.44154,89.62764,89.62764,0,0,1-36.61.20571,23.69448,23.69448,0,0,1-7.66395-2.63224,9.699,9.699,0,0,1-4.73055-6.3266c-.80322-4.58859,2.77227-8.75743,6.488-11.567a47.85811,47.85811,0,0,1,40.21662-8.03639c4.49246,1.16124,8.99288,3.12327,11.91085,6.731s3.78232,9.16981,1.00224,12.88488Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#2f2e41"></path>
                                    <path
                                        d="M644.5,230.17319a89.98675,89.98675,0,0,0-46.83984,166.83l.58007.34q.72.43506,1.43995.84c.81005.48,1.61962.94,2.4497,1.38.56006.29,1.12012.59,1.68018.87a88.77786,88.77786,0,0,0,19.66992,7.26c1.41016.34,2.81982.65,4.26025.91a89.84124,89.84124,0,0,0,16.75977,1.57c1.41992,0,2.83008-.03,4.24023-.1q2.97-.135,5.87989-.47,3.52513-.39,6.96-1.06a89.52811,89.52811,0,0,0,13.6001-3.75c.56005-.21,1.11962-.42,1.66992-.63q2.26464-.87,4.4497-1.86,2.40015-1.08,4.73047-2.3a90.7919,90.7919,0,0,0,37.03955-35.97c.04-.07995.09034-.16.13038-.24a89.30592,89.30592,0,0,0,9.6499-26.41,90.051,90.051,0,0,0-88.3501-107.21Zm77.06006,132.45c-.08008.14-.1499.28-.23.41a88.17195,88.17195,0,0,1-36.48,35.32q-2.29542,1.2-4.66992,2.25c-1.31006.59-2.64991,1.15-4,1.67-.57032.22-1.14991.44-1.73.64a85.72126,85.72126,0,0,1-11.73,3.36,84.69473,84.69473,0,0,1-8.95019,1.41c-1.8501.2-3.73.34-5.62012.41-1.21.05-2.42969.08-3.6499.08a86.762,86.762,0,0,1-16.21973-1.51,85.62478,85.62478,0,0,1-9.63037-2.36,88.46592,88.46592,0,0,1-13.98974-5.67c-.52-.27-1.04-.54-1.5503-.82-.73-.39-1.46972-.79-2.18994-1.22-.54-.3-1.08008-.62-1.60986-.94-.31006-.18-.62012-.37-.93018-.56a88.06851,88.06851,0,1,1,123.18018-32.47Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#3f3d56"></path>
                                    <path
                                        d="M624.2595,268.86254c-.47244-4.968-6.55849-8.02647-11.3179-6.52583s-7.88411,6.2929-8.82863,11.19308a16.0571,16.0571,0,0,0,2.16528,12.12236c2.40572,3.46228,6.82664,5.623,10.95,4.74406,4.70707-1.00334,7.96817-5.59956,8.90127-10.32105s.00667-9.58929-.91854-14.31234Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#2f2e41"></path>
                                    <path
                                        d="M691.24187,275.95964c-.47245-4.968-6.5585-8.02646-11.3179-6.52582s-7.88412,6.29289-8.82864,11.19307a16.05711,16.05711,0,0,0,2.16529,12.12236c2.40571,3.46228,6.82663,5.623,10.95,4.74406,4.70707-1.00334,7.96817-5.59955,8.90127-10.32105s.00667-9.58929-.91853-14.31234Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#2f2e41"></path>
                                    <path
                                        d="M488.93638,356.14169a4.47525,4.47525,0,0,1-3.30664-1.46436L436.00767,300.544a6.02039,6.02039,0,0,0-4.42627-1.94727H169.3618a15.02615,15.02615,0,0,1-15.00928-15.00927V189.025a15.02615,15.02615,0,0,1,15.00928-15.00928H509.087A15.02615,15.02615,0,0,1,524.0963,189.025v94.5625A15.02615,15.02615,0,0,1,509.087,298.59676h-9.63135a6.01157,6.01157,0,0,0-6.00464,6.00489v47.0332a4.474,4.474,0,0,1-2.87011,4.1958A4.52563,4.52563,0,0,1,488.93638,356.14169Z"
                                        transform="translate(-154.35252 -77.40283)" fill="currentColor"></path>
                                    <path
                                        d="M488.93638,356.14169a4.47525,4.47525,0,0,1-3.30664-1.46436L436.00767,300.544a6.02039,6.02039,0,0,0-4.42627-1.94727H169.3618a15.02615,15.02615,0,0,1-15.00928-15.00927V189.025a15.02615,15.02615,0,0,1,15.00928-15.00928H509.087A15.02615,15.02615,0,0,1,524.0963,189.025v94.5625A15.02615,15.02615,0,0,1,509.087,298.59676h-9.63135a6.01157,6.01157,0,0,0-6.00464,6.00489v47.0332a4.474,4.474,0,0,1-2.87011,4.1958A4.52563,4.52563,0,0,1,488.93638,356.14169ZM169.3618,176.01571A13.024,13.024,0,0,0,156.35252,189.025v94.5625a13.024,13.024,0,0,0,13.00928,13.00927H431.5814a8.02436,8.02436,0,0,1,5.90039,2.59571l49.62208,54.1333a2.50253,2.50253,0,0,0,4.34716-1.69092v-47.0332a8.0137,8.0137,0,0,1,8.00464-8.00489H509.087a13.024,13.024,0,0,0,13.00928-13.00927V189.025A13.024,13.024,0,0,0,509.087,176.01571Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#3f3d56"></path>
                                    <circle cx="36.81601" cy="125.19345" r="13.13371" fill="#6c63ff"></circle>
                                    <path
                                        d="M493.76439,275.26947H184.68447a7.00465,7.00465,0,1,1,0-14.00929H493.76439a7.00465,7.00465,0,0,1,0,14.00929Z"
                                        transform="translate(-154.35252 -77.40283)"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </path>
                                    <path
                                        d="M393.07263,245.49973H184.68447a7.00465,7.00465,0,1,1,0-14.00929H393.07263a7.00464,7.00464,0,0,1,0,14.00929Z"
                                        transform="translate(-154.35252 -77.40283)"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </path>
                                    <path
                                        d="M709.41908,676.83065a4.474,4.474,0,0,1-2.87011-4.1958v-47.0332a6.01157,6.01157,0,0,0-6.00464-6.00489H690.913a15.02615,15.02615,0,0,1-15.00928-15.00927V510.025A15.02615,15.02615,0,0,1,690.913,495.01571H1030.6382a15.02615,15.02615,0,0,1,15.00928,15.00928v94.5625a15.02615,15.02615,0,0,1-15.00928,15.00927H768.4186a6.02039,6.02039,0,0,0-4.42627,1.94727l-49.62207,54.1333a4.47525,4.47525,0,0,1-3.30664,1.46436A4.52563,4.52563,0,0,1,709.41908,676.83065Z"
                                        transform="translate(-154.35252 -77.40283)" fill="currentColor"></path>
                                    <path
                                        d="M709.41908,676.83065a4.474,4.474,0,0,1-2.87011-4.1958v-47.0332a6.01157,6.01157,0,0,0-6.00464-6.00489H690.913a15.02615,15.02615,0,0,1-15.00928-15.00927V510.025A15.02615,15.02615,0,0,1,690.913,495.01571H1030.6382a15.02615,15.02615,0,0,1,15.00928,15.00928v94.5625a15.02615,15.02615,0,0,1-15.00928,15.00927H768.4186a6.02039,6.02039,0,0,0-4.42627,1.94727l-49.62207,54.1333a4.47525,4.47525,0,0,1-3.30664,1.46436A4.52563,4.52563,0,0,1,709.41908,676.83065ZM690.913,497.01571A13.024,13.024,0,0,0,677.9037,510.025v94.5625A13.024,13.024,0,0,0,690.913,617.59676h9.63135a8.0137,8.0137,0,0,1,8.00464,8.00489v47.0332a2.50253,2.50253,0,0,0,4.34716,1.69092l49.62208-54.1333a8.02436,8.02436,0,0,1,5.90039-2.59571h262.2196a13.024,13.024,0,0,0,13.00928-13.00927V510.025a13.024,13.024,0,0,0-13.00928-13.00928Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#3f3d56"></path>
                                    <path
                                        d="M603.53027,706.11319a89.06853,89.06853,0,0,1-93.65039,1.49,54.12885,54.12885,0,0,1,9.40039-12.65,53.43288,53.43288,0,0,1,83.90967,10.56994C603.2998,705.71316,603.41992,705.91318,603.53027,706.11319Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#6c63ff"></path>
                                    <circle cx="398.44256" cy="536.68841" r="44.20157" fill="#2f2e41"></circle>
                                    <circle cx="556.81859" cy="629.4886" r="32.89806"
                                        transform="translate(-416.96496 738.72884) rotate(-61.33685)" fill="#ffb8b8">
                                    </circle>
                                    <path
                                        d="M522.25039,608.79582a44.74387,44.74387,0,0,0,25.57085,7.9025,27.41946,27.41946,0,0,1-10.8677,4.47107,90.22316,90.22316,0,0,0,36.85334.20707,23.852,23.852,0,0,0,7.71488-2.64973,9.76352,9.76352,0,0,0,4.762-6.36865c.80855-4.61909-2.7907-8.81563-6.53113-11.64387a48.17616,48.17616,0,0,0-40.4839-8.08981c-4.52231,1.169-9.05265,3.144-11.99,6.77579s-3.80746,9.23076-1.0089,12.97052Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#2f2e41"></path>
                                    <path
                                        d="M555.5,721.17319a89.97205,89.97205,0,1,1,48.5708-14.21875A89.87958,89.87958,0,0,1,555.5,721.17319Zm0-178a88.00832,88.00832,0,1,0,88,88A88.09957,88.09957,0,0,0,555.5,543.17319Z"
                                        transform="translate(-154.35252 -77.40283)" fill="#3f3d56"></path>
                                    <circle cx="563.81601" cy="445.19345" r="13.13371" fill="#6c63ff"></circle>
                                    <path
                                        d="M1020.76439,595.26947H711.68447a7.00465,7.00465,0,1,1,0-14.00929h309.07992a7.00464,7.00464,0,0,1,0,14.00929Z"
                                        transform="translate(-154.35252 -77.40283)"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </path>
                                    <path
                                        d="M920.07263,565.49973H711.68447a7.00465,7.00465,0,1,1,0-14.00929H920.07263a7.00465,7.00465,0,0,1,0,14.00929Z"
                                        transform="translate(-154.35252 -77.40283)"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </path>
                                    <ellipse cx="554.64354" cy="605.66091" rx="24.50394" ry="2.71961"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </ellipse>
                                    <ellipse cx="335.64354" cy="285.66091" rx="24.50394" ry="2.71961"
                                        :fill="$store.app.theme === 'dark' || $store.app.isDarkMode ? '#888ea8' : '#e6e6e6'">
                                    </ellipse>
                                </svg>
                            </div>
                            <p
                                class="mx-auto flex max-w-[190px] justify-center rounded-md bg-white-dark/20 p-2 font-semibold">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                    <path
                                        d="M13.0867 21.3877L13.7321 21.7697L13.0867 21.3877ZM13.6288 20.4718L12.9833 20.0898L13.6288 20.4718ZM10.3712 20.4718L9.72579 20.8539H9.72579L10.3712 20.4718ZM10.9133 21.3877L11.5587 21.0057L10.9133 21.3877ZM2.3806 15.9134L3.07351 15.6264V15.6264L2.3806 15.9134ZM7.78958 18.9915L7.77666 19.7413L7.78958 18.9915ZM5.08658 18.6194L4.79957 19.3123H4.79957L5.08658 18.6194ZM21.6194 15.9134L22.3123 16.2004V16.2004L21.6194 15.9134ZM16.2104 18.9915L16.1975 18.2416L16.2104 18.9915ZM18.9134 18.6194L19.2004 19.3123H19.2004L18.9134 18.6194ZM19.6125 2.7368L19.2206 3.37628L19.6125 2.7368ZM21.2632 4.38751L21.9027 3.99563V3.99563L21.2632 4.38751ZM4.38751 2.7368L3.99563 2.09732V2.09732L4.38751 2.7368ZM2.7368 4.38751L2.09732 3.99563H2.09732L2.7368 4.38751ZM9.40279 19.2098L9.77986 18.5615L9.77986 18.5615L9.40279 19.2098ZM13.7321 21.7697L14.2742 20.8539L12.9833 20.0898L12.4412 21.0057L13.7321 21.7697ZM9.72579 20.8539L10.2679 21.7697L11.5587 21.0057L11.0166 20.0898L9.72579 20.8539ZM12.4412 21.0057C12.2485 21.3313 11.7515 21.3313 11.5587 21.0057L10.2679 21.7697C11.0415 23.0767 12.9585 23.0767 13.7321 21.7697L12.4412 21.0057ZM10.5 2.75H13.5V1.25H10.5V2.75ZM21.25 10.5V11.5H22.75V10.5H21.25ZM2.75 11.5V10.5H1.25V11.5H2.75ZM1.25 11.5C1.25 12.6546 1.24959 13.5581 1.29931 14.2868C1.3495 15.0223 1.45323 15.6344 1.68769 16.2004L3.07351 15.6264C2.92737 15.2736 2.84081 14.8438 2.79584 14.1847C2.75041 13.5189 2.75 12.6751 2.75 11.5H1.25ZM7.8025 18.2416C6.54706 18.2199 5.88923 18.1401 5.37359 17.9265L4.79957 19.3123C5.60454 19.6457 6.52138 19.7197 7.77666 19.7413L7.8025 18.2416ZM1.68769 16.2004C2.27128 17.6093 3.39066 18.7287 4.79957 19.3123L5.3736 17.9265C4.33223 17.4951 3.50486 16.6678 3.07351 15.6264L1.68769 16.2004ZM21.25 11.5C21.25 12.6751 21.2496 13.5189 21.2042 14.1847C21.1592 14.8438 21.0726 15.2736 20.9265 15.6264L22.3123 16.2004C22.5468 15.6344 22.6505 15.0223 22.7007 14.2868C22.7504 13.5581 22.75 12.6546 22.75 11.5H21.25ZM16.2233 19.7413C17.4786 19.7197 18.3955 19.6457 19.2004 19.3123L18.6264 17.9265C18.1108 18.1401 17.4529 18.2199 16.1975 18.2416L16.2233 19.7413ZM20.9265 15.6264C20.4951 16.6678 19.6678 17.4951 18.6264 17.9265L19.2004 19.3123C20.6093 18.7287 21.7287 17.6093 22.3123 16.2004L20.9265 15.6264ZM13.5 2.75C15.1512 2.75 16.337 2.75079 17.2619 2.83873C18.1757 2.92561 18.7571 3.09223 19.2206 3.37628L20.0044 2.09732C19.2655 1.64457 18.4274 1.44279 17.4039 1.34547C16.3915 1.24921 15.1222 1.25 13.5 1.25V2.75ZM22.75 10.5C22.75 8.87781 22.7508 7.6085 22.6545 6.59611C22.5572 5.57256 22.3554 4.73445 21.9027 3.99563L20.6237 4.77938C20.9078 5.24291 21.0744 5.82434 21.1613 6.73809C21.2492 7.663 21.25 8.84876 21.25 10.5H22.75ZM19.2206 3.37628C19.7925 3.72672 20.2733 4.20752 20.6237 4.77938L21.9027 3.99563C21.4286 3.22194 20.7781 2.57144 20.0044 2.09732L19.2206 3.37628ZM10.5 1.25C8.87781 1.25 7.6085 1.24921 6.59611 1.34547C5.57256 1.44279 4.73445 1.64457 3.99563 2.09732L4.77938 3.37628C5.24291 3.09223 5.82434 2.92561 6.73809 2.83873C7.663 2.75079 8.84876 2.75 10.5 2.75V1.25ZM2.75 10.5C2.75 8.84876 2.75079 7.663 2.83873 6.73809C2.92561 5.82434 3.09223 5.24291 3.37628 4.77938L2.09732 3.99563C1.64457 4.73445 1.44279 5.57256 1.34547 6.59611C1.24921 7.6085 1.25 8.87781 1.25 10.5H2.75ZM3.99563 2.09732C3.22194 2.57144 2.57144 3.22194 2.09732 3.99563L3.37628 4.77938C3.72672 4.20752 4.20752 3.72672 4.77938 3.37628L3.99563 2.09732ZM11.0166 20.0898C10.8136 19.7468 10.6354 19.4441 10.4621 19.2063C10.2795 18.9559 10.0702 18.7304 9.77986 18.5615L9.02572 19.8582C9.07313 19.8857 9.13772 19.936 9.24985 20.0898C9.37122 20.2564 9.50835 20.4865 9.72579 20.8539L11.0166 20.0898ZM7.77666 19.7413C8.21575 19.7489 8.49387 19.7545 8.70588 19.7779C8.90399 19.7999 8.98078 19.832 9.02572 19.8582L9.77986 18.5615C9.4871 18.3912 9.18246 18.3215 8.87097 18.287C8.57339 18.2541 8.21375 18.2487 7.8025 18.2416L7.77666 19.7413ZM14.2742 20.8539C14.4916 20.4865 14.6287 20.2564 14.7501 20.0898C14.8622 19.936 14.9268 19.8857 14.9742 19.8582L14.2201 18.5615C13.9298 18.7304 13.7204 18.9559 13.5379 19.2063C13.3646 19.4441 13.1864 19.7468 12.9833 20.0898L14.2742 20.8539ZM16.1975 18.2416C15.7862 18.2487 15.4266 18.2541 15.129 18.287C14.8175 18.3215 14.5129 18.3912 14.2201 18.5615L14.9742 19.8582C15.0192 19.832 15.096 19.7999 15.2941 19.7779C15.5061 19.7545 15.7842 19.7489 16.2233 19.7413L16.1975 18.2416Z"
                                        fill="currentColor"></path>
                                </svg>
                                Click User To Chat
                            </p>
                        </div>
                    </div>
                </template>




                <div class="relative h-full">
                    {{-- Convo Box header --}}
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <button type="button" class="hover:text-primary xl:hidden">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                    <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                    </path>
                                    <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                    <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </button>
                            <div class="relative flex-none">
                                <img src="/images/avatar.png" alt="image"
                                    class="h-10 w-10 rounded-full object-cover sm:h-12 sm:w-12">
                                <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                    <div class="h-4 w-4 rounded-full bg-success"></div>
                                </div>
                            </div>
                            <div class="mx-3">
                                <p class="font-semibold">Full Name</p>
                                <p class="text-xs text-white-dark">
                                    Active Now Laset Seen 10:20pm
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                    <div class="perfect-scrollbar relative h-full overflow-auto sm:h-[calc(100vh_-_300px)]">
                        <div class="chat-conversation-box min-h-[400px] space-y-5 p-4 pb-[68px] sm:min-h-[300px] sm:pb-0"
                            id="chat-container">



                            @foreach($messages as $message)
                            @if($message->to_user_id == Auth::id())

                            <div class="flex items-start gap-3 ">
                                <div class="flex-none">
                                    <img src="/images/avatar.png" alt="image"
                                        class="h-10 w-10 rounded-full object-cover">
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3 ">
                                        <div
                                            class="rounded-md bg-black/10 p-4 py-2 dark:bg-gray-800 ltr:rounded-bl-none rtl:rounded-br-none">
                                            {{ $message->text }}
                                        </div>
                                        <div>
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-primary">
                                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="1.5"></circle>
                                                <path
                                                    d="M9 16C9.85038 16.6303 10.8846 17 12 17C13.1154 17 14.1496 16.6303 15 16"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path
                                                    d="M16 10.5C16 11.3284 15.5523 12 15 12C14.4477 12 14 11.3284 14 10.5C14 9.67157 14.4477 9 15 9C15.5523 9 16 9.67157 16 10.5Z"
                                                    fill="currentColor"></path>
                                                <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="currentColor">
                                                </ellipse>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="text-xs text-white-dark ltr:text-left">
                                        {{ $message->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            {{-- To me --}}


                            @elseif($message->from_user_id == Auth::id())
                            <div class="flex items-start gap-3 justify-end">
                                <div class="flex-none order-2">
                                    <img src="/images/avatar.png" alt="image"
                                        class="h-10 w-10 rounded-full object-cover">
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3 ">
                                        <div
                                            class="rounded-md bg-black/10 p-4 py-2 dark:bg-gray-800  ltr:rounded-br-none rtl:rounded-bl-none !bg-primary text-white">
                                            {{ $message->text }}
                                        </div>
                                    </div>
                                    <div class="text-xs text-white-dark ltr:text-right">
                                        {{ $message->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-4">
                        <div class="w-full items-center space-x-3 rtl:space-x-reverse sm:flex">
                            <div class="relative flex-1">
                                <input
                                    class="form-input rounded-full border-0 bg-[#f4f4f4] px-12 py-2 focus:outline-none"
                                    placeholder="Type a message" id="message">
                                <button type="button"
                                    class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:left-4 rtl:right-4">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="1.5"></circle>
                                        <path
                                            d="M9 16C9.85038 16.6303 10.8846 17 12 17C13.1154 17 14.1496 16.6303 15 16"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M16 10.5C16 11.3284 15.5523 12 15 12C14.4477 12 14 11.3284 14 10.5C14 9.67157 14.4477 9 15 9C15.5523 9 16 9.67157 16 10.5Z"
                                            fill="currentColor"></path>
                                        <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="currentColor"></ellipse>
                                    </svg>
                                </button>
                                <button type="button"
                                    class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:right-4 rtl:left-4"
                                    @click="sendMessage()">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <path
                                            d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                            stroke="currentColor" stroke-width="1.5"></path>
                                        <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Send the message when the user presses Enter
    $('#message').keypress(function(e) {
        if (e.which == 13 && !e.shiftKey) { // Enter key without Shift
            e.preventDefault(); // Prevent a new line
            var message = $('#message').val();
            var to_user_id = 2; // Replace with actual recipient user ID
            var from_user_id = {{ auth()->id() }}; // Current authenticated user's ID

            // Check if the message is empty
            if (message.trim() !== "") {
                sendMessage(message, to_user_id, from_user_id);
            }
        }
    });

    function sendMessage(message, to_user_id, from_user_id) {
        // AJAX request to send the message to the server
        $.ajax({
            url: '/Chat/Send',  // Route to handle the message sending in your Laravel controller
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                message: message,
                to_user_id: to_user_id,
                from_user_id: from_user_id
            },
            success: function(response) {
                // Use moment.js to format the created_at timestamp to human-readable format
                var formattedTime = moment(response.message.created_at).fromNow();

                // Append the new message to the chat
                $('#chat-container').append(`
                <div class="flex items-start gap-3 justify-end">
                            <div class="flex-none order-2">
                                <img src="/images/avatar.png" alt="image"
                                    class="h-10 w-10 rounded-full object-cover">
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center gap-3 ">
                                    <div
                                        class="rounded-md bg-black/10 p-4 py-2 dark:bg-gray-800  ltr:rounded-br-none rtl:rounded-bl-none !bg-primary text-white">
                                        ${response.message.text}
                                    </div>
                                </div>
                                <div class="text-xs text-white-dark ltr:text-right">
                                    ${formattedTime}
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                $('#message').val('');
            },
            error: function(xhr, status, error) {
                console.error("Message sending failed: " + error);
            }
        });
    }
});
</script>
@endsection