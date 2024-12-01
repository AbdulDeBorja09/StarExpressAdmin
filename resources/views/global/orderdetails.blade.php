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
        <li class="before:px-1.5 before:content-['/']"><a href="{{route('allorders')}}">All Orders</a></li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Order
                Details</a>
        </li>
    </ol>

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
                                            <td> </td>
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
                                        <div class="flex-1">Total Items:</div>
                                        <div class="w-[37%]">{{$totalQuantity}}x</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-1">Discount</div>
                                        <div class="w-[37%]">{{$details->discount ?? '0'}}</div>
                                    </div>
                                    <div class="flex items-center text-lg font-semibold">
                                        <div class="flex-1">Grand Total</div>
                                        <div class="w-[37%]">${{ number_format($grandtotal, 2)
                                            }}</div>
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
                                <div class="w-100">
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
                                            <button type="button" class="edit-btn my-2"
                                                style="text-decoration: underline"
                                                onclick="showEditForm({{ $loop->index }})">Edit Status</button>
                                            <form id="editForm{{ $loop->index }}"
                                                action="{{ route('statuses.edit', ['order' => $details->id, 'index' => $loop->index]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                                <select id="status" name="status" class="form-input flex-1">
                                                    <option value="{{ $statusEntry['status'] }}" selected>{{
                                                        $statusEntry['status'] }}</option>
                                                    <option value="To Deliver Cargo Box">To Deliver Cargo Box</option>
                                                    <option value="To Pickup">To Pickup</optio n>
                                                    <option value="In Warehouse">In Warehouse</option>
                                                    <option value="In Transit To">In Transit To</option>
                                                    <option value="Cargo Is Loaded In The Container">Cargo Is Loaded In
                                                        The
                                                        Container</option>
                                                    <option value="Cargo Has Departed From">Cargo has departed From
                                                    </option>
                                                    <option value="Cargo Has Arrived At">Cargo Has Arrived At</option>
                                                    <option value="Cleared At Customs">Cleared At Customs</option>
                                                    <option value="Cargo Has Arrived At">Cargo Has Arrived At</option>
                                                    <option value="Arrived At Warehouse">Arrived At Warehouse</option>
                                                    <option value="Processing Cargo">Processing Cargo</option>
                                                    <option value="Out For Delivery">Out For Delivery</option>
                                                    <option value="On The Way">On The Way</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                                <button type="submit" class="badge badge-outline-success">Save</button>
                                                <button type="button" class="badge badge-outline-danger"
                                                    onclick="hideEditForm({{ $loop->index }})">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div>
                                    @if ($details->state === "pending" || $details->state === "Processing")
                                    <form action="{{ route('updateStatus')}}" method="POST">
                                        @csrf
                                        <input class="form-input flex-1" type="hidden" name="id"
                                            value="{{$details->id}}">
                                        <label for="status" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                            style="font-size:15px">Select Status:
                                        </label>
                                        <select id="status" name="status" class="form-input flex-1">
                                            <option value="To Deliver Cargo Box">To Deliver Cargo Box</option>
                                            <option value="To Pickup">To Pickup</option>
                                            <option value="In Warehouse">In Warehouse</option>
                                            <option value="In Transit To">In Transit To</option>
                                            <option value="Cargo Is Loaded In The Container">Cargo Is Loaded In The
                                                Container</option>
                                            <option value="Cargo Has Departed From">Cargo has departed From</option>
                                            <option value="Cargo Has Arrived At">Cargo Has Arrived At</option>
                                            <option value="Cleared At Customs">Cleared At Customs</option>
                                            <option value="Cargo Has Arrived At">Cargo Has Arrived At</option>
                                            <option value="Arrived At Warehouse">Arrived At Warehouse</option>
                                            <option value="Processing Cargo">Processing Cargo</option>
                                        </select>
                                        <label for="location" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                            style="font-size:15px">Location:
                                        </label>
                                        <input id="location" class="form-input flex-1" type="text" name="location">
                                        <button type="submit" class="btn btn-outline-success mt-3"
                                            style="width:100%">Add
                                            Status</button>
                                    </form>
                                    @endif
                                </div>
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