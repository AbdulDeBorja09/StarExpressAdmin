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
        <li class="before:px-1.5 before:content-['/']"><a onclick="history.back()">All Orders</a></li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Order
                Details</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5" style="min-height: 80vh">
        <div class="panel">
            <div class="mb-5  flex flex-col sm:flex-row" x-data="{ 
                tab: localStorage.getItem('activeTab') || 'overall',
                setTab(selectedTab) {
                    this.tab = selectedTab; // Set the current tab
                    localStorage.setItem('activeTab', selectedTab); // Store the selected tab in localStorage
                }
            }">
                <div class="mr-5 mb-5 sm:mb-0">
                    <ul class="m-auto w-24 text-start font-semibold" id="tabs">
                        <li>
                            <a href="javascript:;" id="overallTab"
                                class="relative -mb-[1px] block border-white-light p-3.5 py-4 before:absolute before:bottom-0 before:top-0 before:m-auto before:h-0 before:w-[1px] before:bg-secondary before:transition-all before:duration-700 hover:text-secondary hover:before:h-[80%] ltr:border-r ltr:before:-right-[1px] rtl:border-l rtl:before:-left-[1px] dark:border-[#191e3a] text-secondary before:!h-[80%]"
                                :class="{'text-secondary before:!h-[80%]' : tab === 'overall'}"
                                @click="setTab('overall')">Overall</a>
                        </li>
                        <li>
                            <a href="javascript:;" id="itemsTab"
                                class="relative -mb-[1px] block border-white-light p-3.5 py-4 before:absolute before:bottom-0 before:top-0 before:m-auto before:h-0 before:w-[1px] before:bg-secondary before:transition-all before:duration-700 hover:text-secondary hover:before:h-[80%] ltr:border-r ltr:before:-right-[1px] rtl:border-l rtl:before:-left-[1px] dark:border-[#191e3a]"
                                :class="{'text-secondary before:!h-[80%]' : tab === 'details'}"
                                @click="setTab('details')">Items</a>
                        </li>
                        @if(Auth::user()->type === 'admin' || Auth::user()->type === 'servicemanager' )
                        <li>
                            <a href="javascript:;" id="paymentTab"
                                class="relative -mb-[1px] block border-white-light p-3.5 py-4 before:absolute before:bottom-0 before:top-0 before:m-auto before:h-0 before:w-[1px] before:bg-secondary before:transition-all before:duration-700 hover:text-secondary hover:before:h-[80%] ltr:border-r ltr:before:-right-[1px] rtl:border-l rtl:before:-left-[1px] dark:border-[#191e3a]"
                                :class="{'text-secondary before:!h-[80%]' : tab === 'payment'}"
                                @click="setTab('payment')">Payment</a>
                        </li>
                        @endif
                        <li>
                            <a href="javascript:;" id="statusTab"
                                class="relative -mb-[1px] block border-white-light p-3.5 py-4 before:absolute before:bottom-0 before:top-0 before:m-auto before:h-0 before:w-[1px] before:bg-secondary before:transition-all before:duration-700 hover:text-secondary hover:before:h-[80%] ltr:border-r ltr:before:-right-[1px] rtl:border-l rtl:before:-left-[1px] dark:border-[#191e3a]"
                                :class="{'text-secondary before:!h-[80%]' : tab === 'status'}"
                                @click="setTab('status')">Status</a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1 text-sm">
                    <template x-if="tab === 'overall'">
                        <div class="" style="padding-left:30px">
                            <div class="flex flex-wrap justify-between gap-4 px-0">
                                <div>
                                    @php
                                    $formattedDate = \Carbon\Carbon::parse($details->created_at)
                                    ->format('F j, Y h:iA');
                                    $dateParts = explode(' ', $formattedDate);
                                    @endphp
                                    <div class="text-2xl font-semibold uppercase">Order Details</div>
                                    <div class="mt-5 font-semibold text-black dark:text-white"
                                        style="text-transform: capitalize">
                                        {{$details->cargoService->originBranch->branch}} -
                                        {{$details->cargoService->destinationBranch->country}}</div>
                                    <div class="mt-1">{{$formattedDate}}</div>
                                    <div class="mt-1">{{$details->reference_number}}</div>

                                </div>
                            </div>

                            <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <div class=" gap-6 xl:grid-cols-3 flex-wrap justify-between lg:flex-row">
                                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                                    <div>
                                        <div class="mb-2 flex w-full items-center justify-between">
                                            <div class="font-semibold text-black dark:text-white">Sender Info
                                            </div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">
                                                Name:</div>
                                            <div>{{$details->sender_name}}</div>
                                        </div>
                                        @php
                                        $contactparts = explode('|', $details->sender_number);
                                        @endphp

                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">Contact 1:</div>
                                            <div>{{ $contactparts[0] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">Contact 2:</div>
                                            <div>{{ $contactparts[1] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center">
                                            <div class="text-white-dark" style="width: 80px;padding-right:20px">
                                                Address:</div>
                                            <div>
                                                {{$details->sender_address}}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-2 flex w-full items-center justify-between">
                                            <div class="font-semibold text-black dark:text-white">Receiver Info
                                            </div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center">
                                            <div class="text-white-dark" style="width: 80px;">Name:</div>
                                            <div>{{$details->receiver_name}}</div>
                                        </div>
                                        @php
                                        $contactparts = explode('|', $details->receiver_number);
                                        @endphp

                                        <div class="mb-2 flex w-full items-center">
                                            <div class="text-white-dark" style="width: 80px;">Contact 1:</div>
                                            <div>{{ $contactparts[0] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center">
                                            <div class="text-white-dark" style="width: 80px;">Contact 2:</div>
                                            <div>{{ $contactparts[1] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;padding-right:20px">
                                                Address:</div>
                                            <div>
                                                {{$details->receiver_address}}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">ID:</div>
                                            <div>{{$details->gov_id}}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-2 flex w-full items-center justify-between">
                                            <div class="font-semibold text-black dark:text-white">Alternate Receiver
                                                Info
                                            </div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">Name:</div>
                                            <div>{{$details->alternate_name}}</div>
                                        </div>
                                        <div class="mb-2 flex w-full items-center ">
                                            <div class="text-white-dark" style="width: 80px;">Contact:</div>
                                            <div>{{ $details->alternate_number }}</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-6">
                                <table class="table-striped">
                                    <thead>
                                        <tr>
                                            <th>QTY</th>
                                            <th>ITEMS</th>
                                            <th>AREA</th>
                                            <th>PACKAGE TYPE</th>
                                            <th class="ltr:text-right rtl:text-left">PRICE</th>
                                            <th class="ltr:text-right rtl:text-left">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalQuantity = 0;
                                        $grandtotal = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['area'] }}</td>
                                            <td>{{ $item['type'] }}</td>
                                            <td class="ltr:text-right rtl:text-left">{{ number_format($item['price'], 2)
                                                }}
                                            </td>
                                            @php
                                            $totalammount = $item['price']*$item['qty'];
                                            @endphp
                                            <td class="ltr:text-right rtl:text-left">
                                                {{ number_format($totalammount, 2)
                                                }}</td>
                                        </tr>
                                        @php $totalQuantity += $item['qty'];
                                        $grandtotal += $totalammount;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-6 grid grid-cols-1 px-4 sm:grid-cols-2">
                                <div></div>
                                <div class="space-y-2 ltr:text-right rtl:text-left">
                                    <div class="flex items-center">
                                        <div class="flex-1">Sub Total:</div>
                                        <div class="w-[37%]">{{ number_format($grandtotal, 2)}}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-1">Total Items:</div>
                                        <div class="w-[37%]">{{$totalQuantity}}x</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-1">Discount:</div>
                                        <div class="w-[37%]">{{$details->discount ?? '0'}}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-1">Balance:</div>
                                        <div class="w-[37%]">{{$details->balance}}</div>
                                    </div>
                                    <div class="flex items-center text-lg font-semibold">
                                        <div class="flex-1">Grand Total</div>
                                        <div class="w-[37%]">${{$details->total}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="tab === 'details'">
                        <div style="padding-left:30px" class="order-details-packinglist">
                            <div>
                                <div class="text-2xl font-semibold uppercase">Packing List</div>
                                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                                    @if (!empty($items) && !empty($list))
                                    @foreach ($items as $index => $item)
                                    <div>
                                        <h1 style="font-size: 20px"
                                            class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-5">
                                            {{
                                            $item['qty']
                                            }}x {{ $item['name'] }} ({{ $item['area'] }})</h1>
                                        <h3
                                            class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-3">
                                            Packing List:</h3>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="mt-3">
                                                    <th>
                                                        Name
                                                    </th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>
                                                    Clothing:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Clothing'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Utensils:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Utensils'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Consumables:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Consumables'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Footware:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Footware'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Toiletries:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Toiletries'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Toys:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Toys'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Canned Goods:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['CannedGoods'] ?? 0 }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Electronics:
                                                </td>
                                                <td>
                                                    {{ $list[$index]['Electronics'] ?? 0 }}x
                                                </td>
                                            </tr>

                                        </table>
                                        <h2
                                            class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-5">
                                            Others:</h2>
                                        <h3>{{
                                            $list[$index]['others'] ?? 'None' }}</h3>
                                    </div>
                                    @endforeach
                                    @else
                                    <p>No items or packing details available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="tab === 'payment'">
                        <div style="padding-left:30px">
                            <div class="text-2xl font-semibold uppercase">Payment Details</div>
                            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
                                {{-- <div class="w-100">
                                    <h1 class="title  dark:text-white-light font-semibold text-[17px] mt-5">
                                        PAYMENT PLAN</h1>
                                    <h2 class="title  font-semibold text-[15px] mt-2">
                                        @if($details->payment === "half")
                                        Half Payment
                                        @else
                                        Full Payment
                                        @endif
                                    </h2>
                                    <hr class="mt-2">
                                    <h1 class="title  dark:text-white-light font-semibold text-[17px] mt-5">
                                        PAYMENT STATUS</h1>
                                    <h2 class="title  font-semibold text-[15px] mt-2">
                                        {{$details->payment_status}}
                                    </h2>
                                    <hr class="mt-2">
                                    <h1 class="title  dark:text-white-light font-semibold text-[17px] mt-5">
                                        PAYMENT METHOD</h1>
                                    <h2 class="title  font-semibold text-[15px] mt-2">
                                        {{$details->method}}
                                    </h2>
                                    <hr class="mt-2">
                                    @if($details->payment_reference)
                                    <h1 class="title  dark:text-white-light font-semibold text-[17px] mt-5">
                                        PAYMENT REFERENCE</h1>
                                    <h2 class="title  font-semibold text-[15px] mt-2">
                                        {{$details->payment_reference}}
                                    </h2>
                                    <hr class="mt-2">
                                    @endif

                                    @if($details->voucher)
                                    <h1 class="title  dark:text-white-light font-semibold text-[17px] mt-5">
                                        VOUCHER USED</h1>
                                    <h2 class="title  font-semibold text-[15px] mt-2 uppercase">
                                        {{$details->voucher}}
                                    </h2>
                                    <hr class="mt-2">
                                    @endif
                                    <div class="flex justify-between mt-5">
                                        <h1 class="title dark:text-white-light font-semibold text-[16px] mt-1">
                                            SUB TOTAL :</h1>
                                        <h2 class="title text-end font-semibold text-[14px] mt-1 uppercase">
                                            {{ number_format($details->total + 500, 2) }}
                                        </h2>
                                    </div>
                                    <div class="flex justify-between mt-1">
                                        <h1 class="title dark:text-white-light font-semibold text-[16px] mt-1">
                                            VOUCHER DISCOUNT :</h1>
                                        <h2 class="title text-end font-semibold text-[14px] mt-1 uppercase">
                                            {{ number_format($details->discount, 2) }}
                                        </h2>
                                    </div>
                                    <div class="flex justify-between mt-1">
                                        <h1 class="title dark:text-white-light font-semibold text-[16px] mt-1">
                                            BALANCE AMOUNT :</h1>
                                        <h2 class="title text-end font-semibold text-[14px] mt-1 uppercase">
                                            {{$details->balance}}
                                        </h2>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <h1 style="font-size: 18px"
                                            class="title dark:text-white-light font-semibold text-[14px] mt-1">
                                            TOTAL AMOUNT :</h1>
                                        <h2 style="font-size: 18px"
                                            class="title text-end font-semibold text-[16px] mt-1 uppercase">
                                            {{$details->total}}
                                        </h2>
                                    </div>
                                </div>
                                <div>
                                    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos dolore nam nemo.
                                        Corrupti beatae veritatis minima voluptatibus. Perferendis, architecto. Voluptas
                                        commodi ab non iure aliquam quisquam autem suscipit exercitationem delectus?
                                    </h1>
                                </div>--}}
                                <div class="space-y-4 " style="border-right: 1px solid #698ea8"
                                    style="text-transform: capitalize">
                                    <div class="table-responsive ">
                                        <table class="table-striped">
                                            <thead>
                                                <tr>
                                                    <th>QTY</th>
                                                    <th>ITEMS</th>
                                                    <th class="ltr:text-right rtl:text-left">PRICE</th>
                                                    <th class="ltr:text-right rtl:text-left">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $totalQuantity = 0;
                                                $grandtotal = 0;
                                                @endphp
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td style="width: 70px">{{ $item['qty'] }}x</td>
                                                    <td>{{ $item['name'] }}
                                                    </td>
                                                    <td class="ltr:text-right rtl:text-left">{{
                                                        number_format($item['price'], 2)
                                                        }}
                                                    </td>
                                                    @php
                                                    $totalammount = $item['price']*$item['qty'];
                                                    @endphp
                                                    <td class="ltr:text-right rtl:text-left">
                                                        {{ number_format($totalammount, 2)
                                                        }}</td>
                                                </tr>
                                                @php $totalQuantity += $item['qty'];
                                                $grandtotal += $totalammount;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="space-y-4" style="margin-left: 5px">
                                        <div class="flex items-center text-md font-semibold">
                                            <div class="flex-1">Payment Method:</div>
                                            <div class="w-[37%]">{{$details->method}}</div>
                                        </div>
                                        <div class="flex items-center  font-semibold">
                                            <div class="flex-1">Payment Reference:</div>
                                            <div class="w-[37%]">{{$details->payment_reference}}</div>
                                        </div>
                                        <div class="flex items-center font-semibold">
                                            <div class="flex-1">Payment Plan:</div>
                                            <div class="w-[37%]" style="text-transform:capitalize ">
                                                {{$details->payment}}
                                            </div>
                                        </div>

                                        <div class="flex items-center font-semibold">
                                            <div class="flex-1">Payment Status:</div>
                                            <div class="w-[37%]" style="text-transform:capitalize ">
                                                {{$details->payment_status}}</div>
                                        </div>

                                        <hr>
                                        <div class="flex items-center text-md">
                                            <div class="flex-1">Sub Total:</div>
                                            <div class="w-[37%]">{{ number_format($grandtotal, 2)}}</div>
                                        </div>
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Total Items:</div>
                                            <div class="w-[37%]">{{$totalQuantity}}x</div>
                                        </div>
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Voucher:</div>
                                            <div class="w-[37%]">{{$details->voucher ?? 'N/A'}}</div>
                                        </div>
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Discount:</div>
                                            <div class="w-[37%]">{{$details->discount ?? '0'}}</div>
                                        </div>
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Balance:</div>
                                            <div class="w-[37%]">{{$details->balance}}</div>
                                        </div>
                                        <div class="flex items-center text-lg font-semibold">
                                            <div class="flex-1">Grand Total</div>
                                            <div class="w-[37%]">{{$details->total}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div style="padding: 0px 100px">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                                        <button type="button" class="btn btn-primary w-full gap-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path
                                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                                <path
                                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round"></path>
                                            </svg>
                                            Fully Paid
                                        </button>

                                        <button type="button" class="btn btn-secondary w-full gap-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path
                                                    d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                                <path opacity="0.5" d="M6 18L21 3" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                            </svg>
                                            Edit payment
                                        </button>

                                        {{-- <a href="apps-invoice-preview.html" class="btn btn-primary w-full gap-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
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
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path opacity="0.5"
                                                    d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                            Download
                                        </button> --}}

                                        <button type="button" class="btn btn-danger w-full gap-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path opacity="0.5"
                                                    d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>

                    <template x-if="tab === 'status'">
                        <div style="padding-left:30px">
                            <div class="text-2xl font-semibold uppercase">Order Status</div>
                            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
                                <div class="max-w-[900px]">
                                    @foreach ($statuses as $index => $statusEntry)
                                    <div class="flex">
                                        <p style="min-width: 100px"
                                            class="text-[#3b3f5c] dark:text-white-light min-w-[58px] max-w-[100px] text-base font-semibold py-2.5">
                                            {{ \Carbon\Carbon::parse($statusEntry['timestamp'])->format('h:i A') }}
                                        </p>
                                        <div
                                            class="relative before:absolute before:left-1/2 before:-translate-x-1/2 before:top-[15px] before:w-2.5 before:h-2.5 before:border-2 before:border-secondary before:rounded-full 
                                            @if(!$loop->last) after:absolute after:left-1/2 after:-translate-x-1/2 after:top-[25px] after:-bottom-[15px] after:w-0 after:h-auto after:border-l-2 after:border-secondary after:rounded-full @endif">
                                        </div>

                                        <div class="p-2.5 self-center ltr:ml-2.5 rtl:ltr:mr-2.5 rtl:ml-2.5">
                                            <p>{{ \Carbon\Carbon::parse($statusEntry['timestamp'])->format('F j, Y') }}
                                            </p>
                                            <p class="text-[#3b3f5c] dark:text-white-light font-semibold text-[13px]"
                                                style="text-transform:capitalize;">
                                                Status: {{ $statusEntry['status'] }}
                                            </p>
                                            <p class="{{ Str::contains($statusEntry['logs'], 'Edited By:' ) ? 'text-warning'
                                                : 'text-[#3b3f5c] dark:text-white-light' }}">{{ $statusEntry['logs'] }}
                                            </p>
                                            <p
                                                class="status-time text-white-dark text-xs font-bold self-center min-w-[100px] max-w-[100px]">
                                                {{ \Carbon\Carbon::parse($statusEntry['timestamp'])->diffForHumans() }}
                                            </p>
                                            @if(Auth::user()->type === 'servicemanger' || Auth::user()->type ===
                                            'admin')
                                            <button type="button" class="edit-btn my-2"
                                                style="text-decoration: underline"
                                                onclick="showEditForm({{ $loop->index }})">Edit Status</button>
                                            <form id="editForm{{ $loop->index }}"
                                                action="{{ route('statuses.edit', ['order' => $details->id, 'index' => $loop->index]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                                <select id="status" name="status" class="form-input flex-1">
                                                    <option value="To Deliver Cargo Box">To Deliver Cargo Box</option>
                                                    <option value="To Pickup Cargo Box">To Pickup Cargo Box</option>
                                                    @foreach ($branches as $item)
                                                    <option value="In Transit To {{$item->branch}}, {{$item->country}}">
                                                        In Transit To
                                                        {{$item->branch}}, {{$item->country}}</option>
                                                    @endforeach
                                                    @foreach ($branches as $item)
                                                    <option value="In Warehouse {{$item->branch}}, {{$item->country}}">
                                                        In Warehouse
                                                        {{$item->branch}}, {{$item->country}}</option>
                                                    @endforeach
                                                    <option value="Cargo Is Loaded In The Container">Cargo Is Loaded In
                                                        The
                                                        Container</option>

                                                    @php

                                                    $uniqueCountries = $branches->unique('country');
                                                    @endphp
                                                    @foreach ($uniqueCountries as $item)
                                                    <option value="Cargo Has Departed From {{$item->country}}">
                                                        Cargo has departed from {{$item->country}}
                                                    </option>
                                                    @endforeach

                                                    @foreach ($uniqueCountries as $item)
                                                    <option value="Cargo Has Arrived At {{$item->country}}">
                                                        Cargo Has Arrived At {{$item->country}}
                                                    </option>
                                                    @endforeach
                                                    <option value="Cleared At Customs">Cleared At Customs</option>
                                                    <option value="Processing Cargo">Preparing For Delivery</option>
                                                    <option value="Out For Delivery">Out For Delivery</option>
                                                    <option value="On The Way">On The Way</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                                <button type="submit" class="badge badge-outline-success">Save</button>
                                                <button type="button" class="badge badge-outline-danger"
                                                    onclick="hideEditForm({{ $loop->index }})">Cancel</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if(Auth::user()->type === 'servicemanger' || Auth::user()->type === 'admin')
                                <div>
                                    {{-- @if ($details->state === "pending" || $details->state === "Processing") --}}
                                    <form action="{{ route('updateStatus')}}" method="POST">
                                        @csrf
                                        <input class="form-input flex-1" type="hidden" name="id"
                                            value="{{$details->id}}">
                                        <label for="status" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                            style="font-size:15px">Select Status:
                                        </label>
                                        <select id="status" name="status" class="form-input flex-1"
                                            style="text-transform: capitalize">
                                            <option value="To Deliver Cargo Box">To Deliver Cargo Box</option>
                                            <option value="To Pickup Cargo Box">To Pickup Cargo Box</option>
                                            @foreach ($branches as $item)
                                            <option value="In Transit To {{$item->branch}}, {{$item->country}}">In
                                                Transit To
                                                {{$item->branch}}, {{$item->country}}</option>
                                            @endforeach
                                            @foreach ($branches as $item)
                                            <option value="In Warehouse {{$item->branch}}, {{$item->country}}">In
                                                Warehouse
                                                {{$item->branch}}, {{$item->country}}</option>
                                            @endforeach
                                            <option value="Cargo Is Loaded In The Container">Cargo Is Loaded In The
                                                Container</option>

                                            @php

                                            $uniqueCountries = $branches->unique('country');
                                            @endphp
                                            @foreach ($uniqueCountries as $item)
                                            <option value="Cargo Has Departed From {{$item->country}}">
                                                Cargo has departed from {{$item->country}}
                                            </option>
                                            @endforeach

                                            @foreach ($uniqueCountries as $item)
                                            <option value="Cargo Has Arrived At {{$item->country}}">
                                                Cargo Has Arrived At {{$item->country}}
                                            </option>
                                            @endforeach
                                            <option value="Cleared At Customs">Cleared At Customs</option>
                                            <option value="Processing Cargo">Preparing For Delivery</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-success mt-3"
                                            style="width:100%">Add
                                            Status</button>
                                    </form>
                                    {{-- @endif --}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function setTab(tab) {
        localStorage.setItem('activeTab', tab);
        this.tab = tab;     
    }
    function showEditForm(index) {
        document.getElementById('editForm' + index).style.display = 'block';
    }
    function hideEditForm(index) {
        document.getElementById('editForm' + index).style.display = 'none';
    }
</script>

@endsection