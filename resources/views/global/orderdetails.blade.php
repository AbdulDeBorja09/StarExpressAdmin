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
                    <ul class=" w-24 text-start font-semibold" id="tabs">
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

                        <li>
                            <a href="javascript:;" id="paymentTab"
                                class="relative -mb-[1px] block border-white-light p-3.5 py-4 before:absolute before:bottom-0 before:top-0 before:m-auto before:h-0 before:w-[1px] before:bg-secondary before:transition-all before:duration-700 hover:text-secondary hover:before:h-[80%] ltr:border-r ltr:before:-right-[1px] rtl:border-l rtl:before:-left-[1px] dark:border-[#191e3a]"
                                :class="{'text-secondary before:!h-[80%]' : tab === 'payment'}"
                                @click="setTab('payment')">Payment</a>
                        </li>

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
                        <div class="order-tab">
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
                                    @if($details->payment === 'Down Payment')
                                    <div class="flex items-center">
                                        <div class="flex-1">Grand total:</div>
                                        <div class="w-[37%]">{{$details->total}}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-1">Down Payment:</div>
                                        <div class="w-[37%]">{{$details->balance}}</div>
                                    </div>

                                    <div class="flex items-center text-lg font-semibold">
                                        <div class="flex-1">Total Balance: </div>
                                        <div class="w-[37%]">{{$details->cargoService->currency}}$ {{$details->total -
                                            $details->balance}}</div>
                                    </div>
                                    @else
                                    <div class="flex items-center text-lg font-semibold">
                                        <div class="flex-1">Grand total: </div>
                                        <div class="w-[37%]">{{$details->cargoService->currency}}$ {{$details->total}}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="tab === 'details'">

                        <div class="order-tab order-details-packinglist">
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
                                                    {{ !empty($list[$index]['Clothing']) ? $list[$index]['Clothing']
                                                    : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Utensils:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Utensils']) ? $list[$index]['Utensils']
                                                    : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Consumables:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Consumables']) ?
                                                    $list[$index]['Consumables']
                                                    : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Footware:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Footware']) ? $list[$index]['Footware']
                                                    : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Toiletries:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Toiletries']) ? $list[$index]['Toiletries']
                                                    : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Toys:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Toys']) ? $list[$index]['Toys'] : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Canned Goods:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['CannedGoods']) ?
                                                    $list[$index]['CannedGoods'] : '0' }}x
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Electronics:
                                                </td>
                                                <td>
                                                    {{ !empty($list[$index]['Electronics']) ?
                                                    $list[$index]['Electronics'] : '0' }}x
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
                        <div class="order-tab">
                            <div class="text-2xl font-semibold uppercase">Payment Details</div>
                            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
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
                                        @if($details->payment === 'Down Payment')
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Grand Total</div>
                                            <div class="w-[37%]">{{$details->total}}</div>
                                        </div>
                                        <div class="flex items-center text-md ">
                                            <div class="flex-1">Down Payment</div>
                                            <div class="w-[37%]">{{$details->balance}}</div>
                                        </div>
                                        <div class="flex items-center text-lg font-semibold">
                                            <div class="flex-1">Total Balance:</div>
                                            <div class="w-[37%]">{{$details->cargoService->currency}}$ {{$details->total
                                                - $details->balance}}</div>
                                        </div>
                                        @else
                                        <div class="flex items-center text-lg font-semibold">
                                            <div class="flex-1">Grand Total</div>
                                            <div class="w-[37%]">{{$details->cargoService->currency}}$
                                                {{$details->total}}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div style="padding: 0px 100px">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                                        @if(Auth::user()->type === 'accountant' || Auth::user()->type === 'admin')
                                        @if($details->approved === 0)
                                        <form action="{{route('approveorder')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$details->id}}">
                                            <button type="submit" class="btn btn-success w-full gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                    <path
                                                        d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path opacity="0.5" d="M6 18L21 3" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                Approve Order
                                            </button>
                                        </form>
                                        <form action="{{route('deleteorder')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$details->id}}">
                                            <button type="submit" class="btn btn-danger w-full gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                    <path opacity="0.5"
                                                        d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                    </path>
                                                    <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                                Delete Order
                                            </button>
                                        </form>
                                        @else
                                        @if($details->payment === 'Down Payment')
                                        @if($details->balance > 0 )
                                        <div class="mb-5" x-data="modal">
                                            <!-- button -->
                                            <button @click="toggle" type="button"
                                                class="btn btn-secondary w-full gap-2">
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

                                            <!-- modal -->
                                            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                                :class="open && '!block'">
                                                <div class="flex items-center justify-center min-h-screen px-4">
                                                    <div x-show="open" x-transition x-transition.duration.300
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                                        <div
                                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                            <h5 class="font-bold text-lg">Edit Payment</h5>
                                                            <button type="button"
                                                                class="text-white-dark hover:text-dark" @click="toggle">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="h-6 w-6">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="p-5">
                                                            <form action="{{route('markaspaid')}}" method="POST">
                                                                @csrf
                                                                <div class=" items-center">
                                                                    <input type="hidden" name="id"
                                                                        value="{{$details->id}}">
                                                                    <label for="totalbalance"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2">Total
                                                                        Balance</label>
                                                                    <input id="totalbalance" type="text" name="amount"
                                                                        class="form-input flex-1" value="{{$details->total
                                                - $details->balance}}" readonly>
                                                                    <label for="method"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2 mt-2">Payment
                                                                        Method</label>
                                                                    <select id="method" class="form-input flex-1"
                                                                        name="method">
                                                                        <option value="online">Online</option>
                                                                        <option value="cash">Cash</option>
                                                                    </select>
                                                                    <label for="referencenum"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2 mt-2">Reference
                                                                        Number</label>
                                                                    <input id="referencenum" type="text"
                                                                        name="reference" class="form-input flex-1"
                                                                        value="{{$details->reference_number}}" required>
                                                                </div>
                                                                <div class="flex justify-end items-center mt-8">
                                                                    <button type="submit"
                                                                        class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @elseif($details->payment === "full" && $details->payment_status === "Pending")
                                        <div class="mb-5" x-data="modal">
                                            <!-- button -->
                                            <button @click="toggle" type="button"
                                                class="btn btn-secondary w-full gap-2">
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

                                            <!-- modal -->
                                            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                                :class="open && '!block'">
                                                <div class="flex items-center justify-center min-h-screen px-4">
                                                    <div x-show="open" x-transition x-transition.duration.300
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                                        <div
                                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                            <h5 class="font-bold text-lg">Edit Payment</h5>
                                                            <button type="button"
                                                                class="text-white-dark hover:text-dark" @click="toggle">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="h-6 w-6">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="p-5">
                                                            <form action="{{route('markaspaid')}}" method="POST">
                                                                @csrf
                                                                <div class=" items-center">
                                                                    <input type="hidden" name="id"
                                                                        value="{{$details->id}}">
                                                                    <label for="totalbalance"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2">Total
                                                                        Balance</label>
                                                                    <input id="totalbalance" type="text" name="amount"
                                                                        class="form-input flex-1"
                                                                        value="{{$details->total - $details->balance}}"
                                                                        readonly>
                                                                    <label for="method"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2 mt-2">Payment
                                                                        Method</label>
                                                                    <select id="method" class="form-input flex-1"
                                                                        name="method">
                                                                        <option value="online">Online</option>
                                                                        <option value="cash">Cash</option>
                                                                    </select>
                                                                    <label for="referencenum"
                                                                        class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2 mt-2">Reference
                                                                        Number</label>
                                                                    <input id="referencenum" type="text"
                                                                        name="reference" class="form-input flex-1"
                                                                        value="{{$details->reference_number}}" required>
                                                                </div>
                                                                <div class="flex justify-end items-center mt-8">
                                                                    <button type="submit"
                                                                        class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>

                    <template x-if="tab === 'status'">
                        <div class="order-tab">
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
                                            @if($details->approved === 1)
                                            @if(Auth::user()->type === 'servicemanager' || Auth::user()->type ===
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
                                                    <option value="Preparing For Delivery">Preparing For Delivery
                                                    </option>
                                                    <option value="Out For Delivery">Out For Delivery</option>
                                                    <option value="On The Way">On The Way</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                                <button type="submit" class="badge badge-outline-success">Save</button>
                                                <button type="button" class="badge badge-outline-danger"
                                                    onclick="hideEditForm({{ $loop->index }})">Cancel</button>
                                            </form>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if(Auth::user()->type === 'servicemanager' || Auth::user()->type === 'admin')
                                @if($details->approved === 1)
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
                                            <option value="Preparing For Delivery">Preparing For Delivery</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-success mt-3"
                                            style="width:100%">Add
                                            Status</button>
                                    </form>
                                    {{-- @endif --}}
                                </div>
                                @endif
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