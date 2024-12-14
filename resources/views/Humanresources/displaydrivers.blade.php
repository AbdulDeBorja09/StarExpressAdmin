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
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">All
                Drivers</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="mt-5">
        <div class="panel">
            <div class="px-0">
                <div class=" md:top-5 ltr:md:left-5 rtl:md:right-5">
                    <div class="mb-5 flex items-center justify-between gap-4">
                        <a href="{{route('truckdriveradd')}}" class="btn btn-primary gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewbox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New
                        </a>
                        <div class="relative">
                            <input type="text" placeholder="Search..." id="search"
                                class="peer form-input py-2 ltr:pr-11 rtl:pl-11" onkeyup="filterBoxes()" />
                            <div
                                class="absolute top-1/2 -translate-y-1/2 peer-focus:text-primary ltr:right-[11px] rtl:left-[11px]">
                                <svg class="mx-auto" width="16" height="16" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                        opacity="0.5"></circle>
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-5 grid w-full grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach ($employees as $item)
                <div
                    class="box-container relative overflow-hidden rounded-md bg-white text-center shadow dark:bg-[#1c232f]">
                    <div class="rounded-t-md bg-white/40 bg-cover bg-center p-6 pb-0"
                        style="background-image: url('{{ asset('images/notification-bg.png') }}');">
                        @if ($item->avatar)
                        <img src="{{ asset('storage/' . $item->avatar) }}"
                            class="mx-auto max-h-40 w-4/5 object-contain">
                        @else
                        <img class="mx-auto max-h-40 w-4/5 object-contain" src="{{asset('../images/avatar.png')}}" />
                        @endif


                    </div>
                    <div class="relative -mt-2 px-6 pb-24">
                        <div class="rounded-md bg-white px-2 py-4 shadow-md dark:bg-gray-900">
                            <div class="name text-xl">{{$item->name}}</div>
                            <div class="text-white-dark" style="text-transform: capitalize">{{$item->type}}</div>
                            <div class="mt-6 flex flex-wrap items-center justify-between gap-3">
                                <div class="flex-auto">
                                    <div style="text-transform: capitalize;">@if($item->status === "active")
                                        <span class="badge badge-outline-success">{{ $item->status }}</span>
                                        @else
                                        <span class="badge badge-outline-danger">{{
                                            $item->status }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <ul class="flex items-center justify-center space-x-4 rtl:space-x-reverse">
                                    <li>
                                        <a href="javascript:;" class="btn btn-outline-primary h-7 w-7 rounded-full p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path
                                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="btn btn-outline-primary h-7 w-7 rounded-full p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z">
                                                </path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="btn btn-outline-primary h-7 w-7 rounded-full p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-4 ltr:text-left rtl:text-right">

                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">Branch:</div>
                                <div class="truncate text-white-dark" style="text-transform: capitalize">{{
                                    $item->branch->country }}, {{
                                    $item->branch->branch }}</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">Email:</div>
                                <div class="truncate text-white-dark">{{ $item->email }}</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">Phone:</div>
                                <div class="text-white-dark">{{ $item->phone }}</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">
                                    Gender:
                                </div>
                                <div class="text-white-dark" style="text-transform: capitalize">{{ $item->gender }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 mt-6 flex w-full gap-4 p-6 ltr:left-0 rtl:right-0">
                        <button type="button" class="btn btn-outline-primary w-1/2">
                            Edit
                        </button>

                        <div x-data="modal" style="width: 50%">
                            @if($item->status === "active")
                            <button type=" button" @click="toggle" x-tooltip="Edit"
                                class="btn btn-outline-danger mx-auto" style="width: 100%">Suspend</button>
                            @else
                            <button class="btn btn-outline-danger mx-auto" disabled style="width: 100%">Suspend</button>
                            @endif

                            <!-- modal -->
                            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                :class="open && '!block'">
                                <div class="flex items-center justify-center min-h-screen px-4"
                                    @click.self="open = false">
                                    <div x-show="open" x-transition x-transition.duration.300
                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                        <div
                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                            <h5 class="font-bold text-lg">Suspend Account</h5>
                                            <button type="button" class="text-white-dark hover:text-dark"
                                                @click="toggle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="h-6 w-6">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form action="{{route('suspend')}}" method="POST">
                                                @csrf
                                                <div class="mt-0" style="text-align: start">
                                                    <input type="hidden" name="id">
                                                    <div class="mt-5">
                                                        <label for="email" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                            style="font-size:15px">Email:
                                                        </label>
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <input type="hidden" name="name" value="{{$item->name}}">
                                                        <input type="hidden" name="type" value="driver">
                                                        <input name="email" id="email" class=" form-input flex-1"
                                                            readonly value="{{$item->email}}">
                                                    </div>
                                                    <div class="mt-5">
                                                        <label for="reason" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                            style="font-size:15px">Reason:
                                                        </label>
                                                        <input name="reason" id="reason" class=" form-input flex-1"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center mt-8">
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        style="width:50%">Suspend</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    function filterBoxes() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const boxes = document.querySelectorAll('.box-container'); 
            
            boxes.forEach(box => {
                const boxName = box.querySelector('.name').textContent.toLowerCase();
                
                if (boxName.includes(searchInput)) {
                    box.style.display = ''; 
                } else {
                    box.style.display = 'none';
                }
            });
        }
</script>



@endsection