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
        <li class="before:px-1.5 before:content-['/']"><a href="{{route('allEmployees')}}">Employees</a></li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Add
                Employee</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="mt-5">
        <div class="flex flex-col gap-2.5 xl:flex-row">
            <form action="{{route('submitaddEmployees')}}" method="POST" enctype="multipart/form-data"
                class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6">
                @csrf
                <div class="flex flex-wrap justify-between px-4">
                    <div class="mb-6 w-full lg:w-1/2">
                        {{-- <div class="flex shrink-0 items-center w-25 text-black dark:text-white">
                            <img src="{{asset('/images/avatar.png')}}" alt="image" style="width: 25%">
                        </div> --}}
                        <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                            <input id="ctnFile" type="file" name="image"
                                class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                <div class="mt-8 px-4">
                    <div class="flex flex-col justify-between lg:flex-row">
                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                            <div class="text-lg font-semibold">Employee Info</div>
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
                                <label for="address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Address</label>
                                <input id="address" type="text" name="address" value="{{old('address')}}"
                                    class="form-input flex-1" placeholder="Enter Address">
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="contact" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Contact
                                    Number</label>
                                <input id="contact" type="number" name="contact" class="form-input flex-1"
                                    placeholder="Enter Contact">
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <div class="text-lg font-semibold">Employee Account</div>
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
                                <select id="type" name="type" class="form-select flex-1"
                                    style="text-transform: capitalize">
                                    <option value="hr">Admin</option>
                                    <option value="hr">Human Resources</option>
                                    <option value="servicemanager">Service Manager</option>
                                    <option value="accountant">Accountant</option>
                                </select>
                            </div>

                            <div class="mt-4 flex items-center">
                                <label for="acno" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Email</label>
                                <input id="acno" type="text" name="email" value="{{old('email')}}"
                                    class="form-input flex-1" placeholder="Enter Email Address">
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
                            <div class="mt-4 flex items-center">
                                <label for="country" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Status</label>
                                <select id="country" name="status" class="form-select flex-1">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                    <div class="p-5">
                        <button type="submit" class="btn btn-success w-full gap-2">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </form>
            {{-- <div class="mt-6 w-full xl:mt-0 xl:w-96">
                <div class="panel mb-5">
                    <div>
                        <label for="currency">Currency</label>
                        <select id="currency" name="currency" class="form-select" x-model="selectedCurrency">
                            <template x-for="(currency, i) in currencyList" :key="i">
                                <option :value="currency" x-text="currency"></option>
                            </template>
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="tax">Tax(%) </label>
                                <input id="tax" type="number" name="tax" class="form-input" placeholder="Tax"
                                    x-model="tax">
                            </div>
                            <div>
                                <label for="discount">Discount(%) </label>
                                <input id="discount" type="number" name="discount" class="form-input"
                                    placeholder="Discount" x-model="discount">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <label for="shipping-charge">Shipping Charge($) </label>
                            <input id="shipping-charge" type="number" name="shipping-charge" class="form-input"
                                placeholder="Shipping Charge" x-model="shippingCharge">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="payment-method">Accept Payment Via</label>
                        <select id="payment-method" name="payment-method" class="form-select" x-model="paymentMethod">
                            <option value="">Select Payment</option>
                            <option value="bank">Bank Account</option>
                            <option value="paypal">Paypal</option>
                            <option value="upi">UPI Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="panel">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                        <button type="button" class="btn btn-success w-full gap-2">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                            Save
                        </button>

                        <button type="button" class="btn btn-info w-full gap-2">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                            Send Invoice
                        </button>

                        <a href="apps-invoice-preview.html" class="btn btn-primary w-full gap-2">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Preview
                        </a>

                        <button type="button" class="btn btn-secondary w-full gap-2">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- end main content section -->

</div>




@endsection