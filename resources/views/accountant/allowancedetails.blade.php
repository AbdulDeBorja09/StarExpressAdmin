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
        <li class="before:px-1.5 before:content-['/']"><a href="{{route('allowancerequest')}}">Allowance Request</a>
        </li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Details
            </a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 ">
                <div>
                    <h1 class="text-lg font-semibold dark:text-white-light">DELIVERY INFORMATION</h1>
                    <form class="mt-5">
                        @csrf
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Created
                            By:</label>
                        <input class="form-input flex-1 mb-2" type="text"
                            value="{{ $delivery->manager->lname }}, {{ $delivery->manager->fname }}" readonly>
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Trip ID:</label>
                        <input class="form-input flex-1 mb-2" type="text" value="{{ $delivery->trip_id }}" readonly>
                        <input type="hidden" value="{{ $delivery->id }}">
                        <label for="driver" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Driver:</label>
                        <input class="form-input flex-1 mb-2" type="text" value="{{ $delivery->driver->name }}"
                            readonly>

                        <label for="driver" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Truck:</label>
                        <input class="form-input flex-1 mb-2" type="text"
                            value="{{ $delivery->truck->model }} - {{ $delivery->truck->plate }}" readonly>
                        <label for="driver" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Date:</label>
                        <input class="form-input flex-1 mb-2" id="date" type="text" readonly
                            value="{{ \Carbon\Carbon::parse($delivery->date)->format('F j, Y') }}">
                        <label for="note" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Note:</label>
                        <input class="form-input flex-1 mb-2" id="note" type="text"
                            value="{{$delivery->note ?? ' N/A '}}" readonly>
                    </form>
                </div>
                @if($delivery->truck_id !== null && $delivery->driver_id !== null)
                <div>
                    <h1 class="text-lg font-semibold dark:text-white-light">ALLOWANCE REQUEST</h1>
                    <div class="mt-5">
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Requested By:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" name="request_name"
                            value="{{$allowance->requested_by}}" readonly>

                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Amount: </label>
                        <input class="form-input flex-1 mb-2" type="number" name="amount"
                            value="{{$allowance->allowance}}" readonly>
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2"
                            style="font-size:15px; text-transform:capitalize;">Status:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" value="{{$allowance->status}}" readonly>
                        @if($allowance->status === 'completed')
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Received By:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" name="received" readonly
                            value="{{$allowance->received_by}}">
                        @endif
                        @if($allowance->status === 'approved')
                        <form action="{{route('allowanceacomplete')}}" method="POST">
                            @csrf
                            <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Received By:
                            </label>
                            <input class="form-input flex-1 mb-2" type="text" name="received" required>
                            <input type="hidden" name="id" value="{{$allowance->id}}">
                            <button type="submit" class="btn btn-success mt-7 gap-2" style="width:100%"><svg width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path
                                        d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path
                                        d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>Complete Request</button>
                        </form>
                        @endif
                        @if($allowance->status === 'pending')
                        <form action="{{route('allowanceapprove')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$allowance->id}}">
                            <button type="submit" class="btn btn-primary mt-7 gap-2" style="width:100%"><svg width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path
                                        d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path
                                        d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>Approve Request</button>
                        </form>
                        @endif
                        @if($allowance->status === 'pending')
                        <form action="{{route('allowancereject')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$allowance->id}}">
                            <button type="submit" class="btn btn-danger mt-8 gap-2" style="width:100%"><svg width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5">
                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                    <path
                                        d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                    <path opacity="0.5"
                                        d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                </svg>Reject Request</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
                <div id="orders" ondragover="allowDrop(event)" ondrop="drop(event, 'orders')">
                    <div class="delivery-drag-title">
                        <h3 class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-2">
                            DELIVERY ITEMS</h3>
                    </div>
                    @foreach($orderDetails as $order)
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2 mt-5">
                        <div
                            class="order-item order  items-md-center rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right">
                            <h1> <strong>Reference Number: </strong> {{ $order->reference_number}}</h1>
                            <h1> <strong>Sender Name: </strong> {{ $order->sender_name}}</h1>
                            <h1> <strong>Address:</strong><br>{{ $order->sender_address }}</h1>
                            @php
                            $items = json_decode($order->items, true);
                            @endphp
                            @if (!empty($items))
                            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 mt-1">
                                @foreach ($items as $item)
                                <div class="item" style="width: 100%">
                                    <strong>Boxes: </strong>{{ $item['qty'] }}x {{ $item['name'] }}<br>
                                    <strong>Area:</strong> {{ $item['area'] ?? 'N/A' }}<br>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection