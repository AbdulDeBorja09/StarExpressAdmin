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
                Deliveries</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
                <form id="deliveryForm">
                    @csrf
                    <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Trip ID:</label>
                    <input class="form-input flex-1 mb-2" id="tripid" type="text" value="{{ $delivery->trip_id }}"
                        readonly>
                    <input type="hidden" name="id" value="{{ $delivery->id }}">
                    <label for="driver" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Driver:</label>
                    <select class="form-input flex-1 mb-2" name="driver" id="driver">
                        <option value="{{ $delivery->driver_id ?? '' }}" selected>{{ $delivery->driver->name ?? 'SELECT
                            DRIVER' }}</option>
                        @foreach ($driver as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label for="truck" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Truck:</label>
                    <select class="form-input flex-1 mb-2" name="truck" id="truck">
                        <option value="{{ $delivery->truck_id ?? '' }}" selected>{{ $delivery->truck->model ?? 'SELECT
                            TRUCK' }}</option>
                        @foreach ($truck as $item)
                        <option value="{{ $item->id }}">{{ $item->model }}, {{ $item->plate }}</option>
                        @endforeach
                    </select>

                    <label for="truck" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Status:</label>
                    <select class="form-input flex-1 mb-2" name="status" id="truck">
                        <option value="pending">Pending</option>
                        <option value="ready">Ready</option>
                    </select>

                    <label for="note" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Note:</label>
                    <input class="form-input flex-1 mb-2" id="note" type="text" name="note"
                        value="{{$delivery->note ?? ' N/A '}}">{{$delivery->note ?? ' N/A '}}
                    <button type="button" class="btn btn-primary mt-3" style="width:100%"
                        onclick="submitOrders()">Submit Delivery</button>
                </form>

            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
                <div id="orders" ondragover="allowDrop(event)" ondrop="drop(event, 'orders')">
                    <div class="delivery-drag-title">
                        <h3 class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-2">
                            FOR DELIVERY ORDERS:</h3>
                    </div>

                    <div class="mb-5">
                        <div class="dataTable-search"><input class="dataTable-input" id="order-search"
                                placeholder="Search..." type="text"></div>
                    </div>
                    @foreach($orders as $order)
                    @php
                    $items = json_decode($order->items, true);
                    $itemsData = '';
                    if (!empty($items)) {
                    foreach ($items as $item) {
                    $itemsData .= $item['name'] . ' ' . $item['qty'] . ' ' . ($item['type'] ?? 'N/A') . ' ' .
                    ($item['area'] ?? 'N/A') . ' ' . ($item['price'] ?? 'N/A') . ' ' . ($item['Boxid'] ?? 'N/A') . ' ';
                    }
                    }
                    @endphp


                    <div class="order-item order mt-2 items-md-center rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right"
                        data-id="{{ $order->id }}" data-sender-name="{{ $order->sender_name }}"
                        data-sender-address="{{ $order->sender_address }}" data-items="{{ $itemsData }}"
                        ondragstart="drag(event)" ondragstart="this.classList.add('dragging')"
                        ondragend="this.classList.remove('dragging')" draggable="true">
                        <h1> <strong>ID:</strong> {{ $order->id}}</h1>
                        <h1> <strong>#</strong> {{ $order->reference_number}}</h1>
                        <h1> <strong>Address:</strong><br>{{ $order->sender_address }}</h1>
                        @php
                        $items = json_decode($order->items, true);
                        @endphp
                        @if (!empty($items))
                        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 mt-3">
                            @foreach ($items as $item)
                            <div class="item">
                                <strong>Boxes:</strong>{{ $item['qty'] }}x {{ $item['name'] }}<br>
                                <strong>Area:</strong> {{ $item['area'] ?? 'N/A' }}<br>

                            </div>
                            @endforeach
                        </div>

                        @else
                        <div>No items found for this order.</div>
                        @endif

                        <input type="hidden" name="reference_number" id="reference_number"
                            value="{{ $order->reference_number }}" />
                        <input type="hidden" name="sender_name" id="sender_name" value="{{ $order->sender_name }}" />
                        <input type="hidden" name="sender_number" id="sender_number"
                            value="{{ $order->sender_number }}" />
                        <input type="hidden" name="sender_address" id="sender_address"
                            value="{{ $order->sender_address}}" />
                        <input type="hidden" name="receiver_name" id="receiver_name"
                            value="{{ $order->receiver_name }}" />
                        <input type="hidden" name="receiver_number" id="receiver_number"
                            value="{{ $order->receiver_number}}" />
                        <input type="hidden" name="receiver_address" id="receiver_address"
                            value="{{ $order->receiver_address }}" />
                        <input type="hidden" name="alternate_name" id="alternate_name"
                            value="{{ $order->alternate_name }}" />
                        <input type="hidden" name="alternate_number" id="alternate_number"
                            value="{{ $order->alternate_number }}" />
                        <input type="hidden" name="gov_id" id="gov_id" value="{{ $order->gov_id }}" />
                        <input type="hidden" name="note" id="note" value="{{ $order->note }}" />
                        <input type="hidden" name="items" id="items" value='{{ json_encode($order->items) }}' />
                        <!-- Added items input -->
                    </div>
                    @endforeach
                </div>

                <div id="submitted-orders" ondragover="allowDrop(event)" ondrop="drop(event, 'submitted-orders')"
                    class="submitted-orders-section">
                    <div class="delivery-drag-title">
                        <h3 class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-2">
                            DRAG ORDERS HERE:</h3>
                        <div class="mb-5" style="height: 31px">
                        </div>
                        <div>
                            @if ($orderDetails->isEmpty())
                            <div>No orders found for the selected delivery.</div>
                            @else
                            @foreach ($orderDetails as $order)
                            <div class="order-item order mt-2 items-md-center rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right"
                                style="font-size: 12px; text-transform:" data-id="{{ $order->id }}">
                                <h1> <strong>ID:</strong> {{ $order->id}}</h1>
                                <h1> <strong>#</strong> {{ $order->reference_number}}</h1>
                                <h1> <strong>Address:</strong><br>{{ $order->sender_address }}</h1>

                                @php
                                $items = json_decode($order->items, true);
                                @endphp

                                @if (!empty($items))
                                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 mt-3">
                                    @foreach ($items as $item)
                                    <div class="item">
                                        <strong>Boxes:</strong> {{ $item['qty'] }}x {{ $item['name'] }}<br>
                                        <strong>Area:</strong> {{ $item['area'] ?? 'N/A' }}<br>
                                        <strong>Price:</strong> {{ $item['price'] ?? 'N/A' }}<br>
                                        <strong>Box ID:</strong> {{ $item['Boxid'] ?? 'N/A' }}<br>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div>No items found for this order.</div>
                                @endif
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .selected {
                background-color: lightblue;
                /* Change this to highlight selected orders */
            }
        </style>
    </div>
</div>
</div>
<script>
    document.getElementById('order-search').addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();
        const orders = document.querySelectorAll('.order-item');

        orders.forEach(order => {
            const senderName = order.getAttribute('data-sender-name').toLowerCase();
            const senderAddress = order.getAttribute('data-sender-address').toLowerCase();
            const itemsData = order.getAttribute('data-items').toLowerCase(); // Search in item details

            // If the order is being dragged, keep it visible
            if (order.classList.contains('dragging')) {
                order.style.display = '';
                return; // Skip further checks for this order
            }

            // Otherwise, apply the search logic to show/hide based on search input
            if (senderName.includes(searchValue) || senderAddress.includes(searchValue) || itemsData.includes(searchValue)) {
                order.style.display = '';
            } else {
                order.style.display = 'none';
            }
        });
    });
</script>
<script>
    let selectedOrders = [];
    
    function allowDrop(event) {
        event.preventDefault(); // Prevent default behavior to allow drop
    }
    
    function drag(event) {
        // Set the id of the dragged element
        event.dataTransfer.setData("text/plain", event.target.dataset.id);
    }
    
    function drop(event, dropZone) {
        event.preventDefault(); // Prevent default behavior
        const orderId = event.dataTransfer.getData("text/plain");
        const orderElement = document.querySelector(`.order[data-id='${orderId}']`);
        
        if (dropZone === 'submitted-orders') {
            // Append order to the submitted orders section
            document.getElementById(dropZone).appendChild(orderElement);
            selectedOrders.push(orderId); // Add to selected orders
        } else if (dropZone === 'orders') {
            // Move order back to the original orders section
            document.getElementById(dropZone).appendChild(orderElement);
            selectedOrders = selectedOrders.filter(id => id !== orderId); // Remove from selected orders
        }
    }

    function submitOrders() {
        if (selectedOrders.length === 0) {
            alert("No orders selected for submission!");
            return;
        }

        const deliveryForm = document.getElementById('deliveryForm');
        const formData = new FormData(deliveryForm);

        // Append selected order IDs as an array
        selectedOrders.forEach(orderId => {
            formData.append('order_ids[]', orderId);
        });

        fetch('{{ route('submitdelivery') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show success message
            location.reload(); // Refresh the page after submission
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
</script>

@endsection