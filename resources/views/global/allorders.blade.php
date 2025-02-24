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
                Orders</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="order-top-part flex mb-5 ">

                <div class="dropdown inline-flex" x-data="dropdown" @click.outside="open = false">
                    <button type="button"
                        class="btn btn-outline-primary ltr:rounded-r-none rtl:rounded-l-none dropdown-toggle before:border-[5px] before:border-l-transparent before:border-r-transparent before:border-t-inherit before:border-b-0 before:inline-block hover:before:border-t-white-light"
                        @click="toggle">
                        <span class="sr-only">Toggle dropdown</span>
                    </button>
                    <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                        class="ltr:right-0 rtl:left-0 top-full whitespace-nowrap">
                        <li class="" x-data="modal">


                            <a href="javascript:;" @click="toggle">Create Batch</a>

                            <!-- modal -->
                            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                :class="open && '!block'">
                                <div class="flex items-center justify-center min-h-screen px-4">
                                    <div x-show="open" x-transition x-transition.duration.300
                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                        <div
                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                            <h5 class="font-bold text-lg">Create Batch</h5>
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
                                        <section class="p-5">
                                            main
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="" x-data="modal">


                            <a href="javascript:;" @click="toggle">Set Status</a>

                            <!-- modal -->
                            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                :class="open && '!block'">
                                <div class="flex items-start justify-center min-h-screen px-4" style="margin-top: 50px">

                                    <div x-show="open" x-transition x-transition.duration.300
                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                        <div
                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                            <h5 class="font-bold text-lg">Set Status</h5>
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
                                        <section class="p-5">

                                            <form action="{{ route('MultipleupdateStatus')}}" method="POST"
                                                id="status-form">
                                                @csrf
                                                <label for="status" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Select Status:
                                                </label>
                                                <select id="status" name="status" class="form-input flex-1"
                                                    style="text-transform: capitalize">
                                                    <option value="To Deliver Cargo Box">To Deliver Cargo Box</option>
                                                    <option value="To Pickup Cargo Box">To Pickup Cargo Box</option>
                                                    @foreach ($branches as $item)
                                                    <option value="In Transit To {{$item->branch}}, {{$item->country}}">
                                                        In
                                                        Transit To
                                                        {{$item->branch}}, {{$item->country}}</option>
                                                    @endforeach
                                                    @foreach ($branches as $item)
                                                    <option value="In Warehouse {{$item->branch}}, {{$item->country}}">
                                                        In
                                                        Warehouse
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
                                                </select>
                                                <br>
                                                <input type="hidden" id="order_ids" name="ids" value="">
                                                <button type="submit" class="btn btn-outline-success mt-5"
                                                    style="width:100%">Add
                                                    Status</button>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </li>

                        {{-- <li><a href="javascript:;" @click="toggle">Something else here</a></li>
                        <li><a href="javascript:;" @click="toggle">Separated link</a></li> --}}
                    </ul>
                    <div class="" x-data="modal">
                        <!-- button -->
                        <div class="flex items-center ">

                            <button type="button" class="btn btn-outline-primary ltr:rounded-l-none rtl:rounded-r-none"
                                @click="toggle">SCAN QR</button>
                        </div>

                        <!-- modal -->
                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                            :class="open && '!block'">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div x-show="open" x-transition x-transition.duration.300
                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div
                                        class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                        <h5 class="font-bold text-lg">Scan QR Code</h5>
                                        <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-5">
                                        <div class="subtitle" style="text-align: center">
                                            <h2 id="result">No qr code scanned yet</h2>
                                            <p id="error" style="display: none;">Error! Unable to access the camera.</p>
                                        </div>
                                        <div class="main">
                                            <video id="video" autoplay></video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTable-search">
                    <input class="dataTable-input" placeholder="Search Filter 1" type="text" id="filter1">
                    <input class="dataTable-input" placeholder="Search Filter 2" type="text" id="filter2"
                        style="margin-left: 10px">
                </div>
            </div>
            <div class="table-responsive" class="">
                <table class="orders-table table table-bordered" style="text-transform: capitalize;">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" class="form-checkbox" /></th>
                            <th style="width: 60px">#</th>
                            <th>Date Ordered</th>
                            <th>Reference Number</th>
                            <th>Sender Name</th>

                            @if(Auth::user()->type === 'servicemanager' || Auth::user()->type === 'admin')
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Latest Status</th>
                            @if(Route::currentRouteName() == 'allorders')
                            <th style="text-align: center">Order Status</th>
                            @endif
                            @else
                            <th>Origin</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                            <th>Balance</th>
                            <th>Latest Status</th>
                            <th>Approval Status</th>
                            @endif
                            @if(Route::currentRouteName() == 'deliverdorders')
                            <th>Delivered Date</th>
                            @endif

                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            @php
                            $statuses = json_decode($order->status, true);
                            $latestStatus = is_array($statuses) ? end($statuses)['status'] : 'N/A';
                            @endphp
                            <td style="text-align: center;"><input type="checkbox"
                                    class="form-checkbox child-checkbox" />
                            </td>

                            <td style="text-align: center;width: 60px">{{ $loop->iteration }}<input type="hidden"
                                    value="{{ $order->id }}"></td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                            <td>{{ $order->reference_number }}</td>
                            <td>{{$order->sender_name}}</td>

                            @if(Auth::user()->type === 'servicemanager' || Auth::user()->type === 'admin')
                            <td>{{ $order->cargoService->originBranch->branch ??
                                'N/A' }}, {{
                                $order->cargoService->originBranch->country ?? '' }}</td>
                            <td>{{ $order->cargoService->destinationBranch->country ?? 'N/A' }}</td>
                            <td>{{ $latestStatus }}</td>
                            @if(Route::currentRouteName() == 'allorders')
                            <td style="text-align: center">@if ($order->approved === 0)
                                <span class="badge badge-outline-danger">pending</span>
                                @else
                                <span class="badge badge-outline-success">Approved</span>

                                @endif
                            </td>
                            @endif

                            @else
                            <td>{{ $order->cargoService->originBranch->branch ??
                                'N/A' }}, {{
                                $order->cargoService->originBranch->country ?? '' }}</td>

                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->total }}</td>
                            <td>
                                @if ( $order->payment === 'Down Payment')
                                {{ $order->total - $order->balance }}
                                @else
                                {{ $order->balance }}
                                @endif


                            </td>
                            <td>{{ $latestStatus }}</td>
                            @if(Route::currentRouteName() == 'allorders')
                            <td style="text-align: center">@if ($order->approved === 0)
                                <span class="badge badge-outline-danger">pending</span>
                                @else
                                <span class="badge badge-outline-success">Approved</span>

                                @endif
                            </td>
                            @endif
                            @endif
                            @if(Route::currentRouteName() == 'deliverdorders')
                            <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('F j, Y h:i A') }}</td>
                            @endif
                            <td>
                                <div style="display:flex; justify-content: center; ">
                                    <a href="{{ url('details/' . $order->reference_number) }}"
                                        class="hover:text-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                            <path opacity="0.5"
                                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                stroke="currentColor" stroke-width="1.5"></path>
                                            <path
                                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ url()->current() }}" method="GET" id="paginationForm">
                @csrf
                <div class="dataTable-bottom mt-5">
                    <div class="dataTable-info">
                        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }}
                        Orders
                    </div>
                    <div class="dataTable-dropdown"><label>
                            <select name="perPage" class="dataTable-selector" onchange="this.form.submit()">
                                <option value="20" {{ $perPage==20 ? 'selected' : '' }}>20</option>
                                <option value="40" {{ $perPage==40 ? 'selected' : '' }}>40</option>
                                <option value="50" {{ $perPage==50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage==100 ? 'selected' : '' }}>100</option>
                                <option value="999" {{ $perPage==999 ? 'selected' : '' }}>All</option>
                            </select>
                        </label>
                    </div>

                    <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">
                            @if ($orders->onFirstPage())
                            <li class="pager disabled"><a href="#" aria-disabled="true"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a></li>
                            @else
                            <li class="pager"><a
                                    href="{{ request()->fullUrlWithQuery(['page' => $orders->currentPage() - 1]) }}"><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                @if ($i == $orders->currentPage())
                                <li class="active"><a href="#">{{ $i }}</a></li>
                                @else
                                <li><a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a></li>
                                @endif
                                @endfor

                                @if ($orders->hasMorePages())
                                <li class="pager"><a
                                        href="{{ request()->fullUrlWithQuery(['page' => $orders->currentPage() + 1]) }}"><svg
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                            <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg></a>
                                </li>
                                @else
                                <li class="pager disabled"><a href="#" aria-disabled="true"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-4.5 h-4.5 rtl:rotate-180">
                                            <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg></a></li>
                                @endif
                        </ul>
                    </nav>

                </div>
            </form>
        </div>
        {{-- <div class="panel">
            <h1>Orders</h1>

            <div id="orders">
                @foreach($orders as $order)
                <div class="order" draggable="true" ondragstart="drag(event)">
                    {{ $order->order_name }} (Sender: {{ $order->sender_name }})
                </div>
                @endforeach
            </div>

            <div id="submitted-orders" ondragover="allowDrop(event)" ondrop="drop(event)">
                <p>Drag orders here</p>
            </div>

            <button onclick="submitOrders()">Submit</button>

            <script>
                function allowDrop(event) {
                    event.preventDefault();
                }
        
                function drag(event) {
                    event.dataTransfer.setData("text", event.target.innerText);
                    event.dataTransfer.setData("id", event.target.dataset.id); // Store the order ID if needed
                }
        
                function drop(event) {
                    event.preventDefault();
                    const orderText = event.dataTransfer.getData("text");
                    const ordersList = document.getElementById('orders');
                    const orderElements = ordersList.getElementsByClassName('order');
        
                    // Find and remove the dragged order from the orders list
                    for (let i = 0; i < orderElements.length; i++) {
                        if (orderElements[i].innerText === orderText) {
                            ordersList.removeChild(orderElements[i]); // Remove the order from the list
                            break;
                        }
                    }
        
                    // Create a new order element for the submitted orders
                    const newOrder = document.createElement("div");
                    newOrder.className = "order";
                    newOrder.innerText = orderText;
                    newOrder.setAttribute("draggable", "true");
                    newOrder.setAttribute("ondragstart", "drag(event)");
                    document.getElementById("submitted-orders").appendChild(newOrder);
                }
        
                function submitOrders() {
                    const submittedOrders = Array.from(document.querySelectorAll('#submitted-orders .order')).map(order => order.innerText);
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ orders: submittedOrders })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Orders submitted successfully!');
                            location.reload(); // Reload the page to reset the orders
                        } else {
                            alert('Error submitting orders.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            </script>
        </div> --}}
    </div>
</div>
<style>
    #video {
        width: 100%;
        height: auto;
        border: 1px solid black;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const filter1Input = document.getElementById('filter1');
    const filter2Input = document.getElementById('filter2');
    const selectAllCheckbox = document.getElementById('select-all');
    const tableRows = document.querySelectorAll('.table tbody tr');
    const orderIdsInput = document.getElementById('order_ids');
    const statusForm = document.getElementById('status-form');

    // Collect selected order IDs
    function collectOrderIds() {
        const checkedOrderIds = Array.from(tableRows)
            .filter(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                return checkbox && checkbox.checked && row.style.display !== "none"; 
            })
            .map(row => {
                const hiddenInput = row.querySelector('input[type="hidden"]');
                return hiddenInput ? hiddenInput.value : null;
            })
            .filter(orderId => orderId !== null); 

        return checkedOrderIds;
    }

   
    statusForm.addEventListener('submit', function (e) {
        const orderIds = collectOrderIds();
        orderIds.join(',');
        orderIdsInput.value = JSON.stringify(orderIds); 
        console.log(orderIdsInput.value); 
    });

    function filterTable() {
        const filter1 = filter1Input.value.toLowerCase();
        const filter2 = filter2Input.value.toLowerCase();

        tableRows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let foundFilter1 = false;
            let foundFilter2 = false;

            for (let i = 0; i < cells.length; i++) {
                const cell = cells[i];
                const textValue = cell.textContent || cell.innerText;

                if (filter1 && textValue.toLowerCase().includes(filter1)) {
                    foundFilter1 = true;
                }

                if (filter2 && textValue.toLowerCase().includes(filter2)) {
                    foundFilter2 = true;
                }
            }

            if ((!filter1 || foundFilter1) && (!filter2 || foundFilter2)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        updateSelectAllState();
        updateCheckedCount();
        collectOrderIds();
    }

    function updateSelectAllState() {
        const visibleRows = Array.from(tableRows).filter(row => row.style.display !== "none");
        const visibleCheckboxes = visibleRows.map(row => row.querySelector('input[type="checkbox"]'));
        const allChecked = visibleCheckboxes.every(checkbox => checkbox.checked);
        const noneChecked = visibleCheckboxes.every(checkbox => !checkbox.checked);

        selectAllCheckbox.checked = allChecked && visibleCheckboxes.length > 0;
        selectAllCheckbox.indeterminate = !allChecked && !noneChecked;
    }

    function toggleSelectAll() {
        const visibleRows = Array.from(tableRows).filter(row => row.style.display !== "none");
        const isChecked = selectAllCheckbox.checked;

        visibleRows.forEach(row => {
            const checkbox = row.querySelector('input[type="checkbox"]');
            if (checkbox) {
                checkbox.checked = isChecked;
            }
        });

        updateCheckedCount();
        collectOrderIds(); 
    }

    function updateCheckedCount() {
        const checkedBoxes = Array.from(tableRows)
            .filter(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                return checkbox && checkbox.checked && row.style.display !== "none"; 
            });

    }

    filter1Input.addEventListener('keyup', filterTable);
    filter2Input.addEventListener('keyup', filterTable);
    selectAllCheckbox.addEventListener('change', toggleSelectAll);

    tableRows.forEach(row => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox) {
            checkbox.addEventListener('change', () => {
                updateSelectAllState();
                updateCheckedCount();
                collectOrderIds(); 
            });
        }
    });

    updateCheckedCount();
});
</script>

</script>

@endsection