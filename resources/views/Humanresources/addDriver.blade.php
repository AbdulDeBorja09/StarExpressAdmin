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
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Add
                Driver</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="panel mt-5">
        <form action="{{route('submitadddriver')}}" method="POST">
            @csrf
            <div class="flex flex-wrap justify-between px-2">
                <div class="mb-3 w-full lg:w-1/2">
                    <div class="mt-3 space-y-1 text-gray-500 dark:text-gray-400">
                        <input id="ctnFile" type="file" name="image"
                            class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                    </div>
                </div>
            </div>
            <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
            <div class="mt-8 px-4">
                <div class="flex flex-col justify-between lg:flex-row">
                    <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                        <div class="text-lg font-semibold">Driver Info</div>
                        <div class="mt-4 flex items-center">
                            <label for="fname" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Frist Name</label>
                            <input id="fname" type="text" name="fname" value="{{old('fname')}}"
                                class="form-input flex-1" placeholder="Enter First Name">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="mname" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Middle Name</label>
                            <input id="mname" type="text" name="mname" value="{{old('mname')}}"
                                class="form-input flex-1" placeholder="Enter Middle Name">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="lname" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Last Name</label>
                            <input id="lname" type="text" name="lname" value="{{old('lname')}}"
                                class="form-input flex-1" placeholder="Enter Last Name">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="gender" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Gender</label>
                            <input id="gender" type="text" name="gender" value="{{old('gender')}}"
                                class="form-input flex-1" placeholder="Enter Gender">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="contact" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Contact
                                Number</label>
                            <input id="contact" type="number" name="contact" value="{{old('contact')}}"
                                class="form-input flex-1" placeholder="Enter Contact">
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="text-lg font-semibold">Driver Account</div>
                        <div class="mt-4 flex items-center">
                            <label for="branch" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Branch</label>
                            <select id="branch" name="branch_id" class="form-select flex-1"
                                style="text-transform: capitalize">
                                @foreach ($branch as $item)
                                <option value="{{ $item->id }}">{{ $item->country }}, {{ $item->branch }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 flex items-center">
                            <label for="type" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Position</label>
                            <select id="type" name="type" class="form-select flex-1" style="text-transform: capitalize">
                                <option value="driver">Driver</option>
                                <option value="porter">Porter</option>

                            </select>
                        </div>

                        <div class="mt-4 flex items-center">
                            <label for="acno" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Email</label>
                            <input id="acno" type="text" name="email" value="{{old('email')}}" class="form-input flex-1"
                                placeholder="Enter Email Address">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="bank-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Password</label>
                            <input id="bank-name" type="text" name="password" value="{{old('password')}}"
                                class="form-input flex-1" placeholder="Enter Password">
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Confirm Password</label>
                            <input id="swift-code" type="text" name="confirm-password"
                                value="{{old('confirm-password')}}" class="form-input flex-1"
                                placeholder="Enter Password Again">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <button type="submit" class="btn btn-success w-full gap-2">
                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                        <path
                            d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        </path>
                    </svg>
                    Save
                </button>
            </div>
        </form>
    </div>
    <!-- end main content section -->

</div>

@endsection