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
        <li class="before:px-1.5 before:content-['/']"><a href="{{route('alldeliveries')}}">All Deliveries</a></li>
        <li class="before:px-1.5 before:content-['/']">
            <a href="javascript:;"
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Delivery
                Trip
            </a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 ">
                <div>
                    <h1 class="text-lg font-semibold dark:text-white-light">DELIVERY INFORMATION</h1>
                    <form id="deliveryForm" class="mt-5">
                        @csrf
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Trip ID:</label>
                        <input class="form-input flex-1 mb-2" id="tripid" type="text" value="{{ $delivery->trip_id }}"
                            readonly>
                        <input type="hidden" name="id" value="{{ $delivery->id }}">
                        <label for="driver" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Driver:</label>
                        <select class="form-input flex-1 mb-2" name="driver" id="driver">
                            <option value="" {{ empty($delivery->driver_id) ? 'selected' : '' }}>SELECT DRIVER</option>
                            @foreach ($driver as $item)
                            <option value="{{ $item->id }}" {{ $delivery->driver_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>


                        <label for="truck" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Truck:</label>
                        <select class="form-input flex-1 mb-2" name="truck" id="truck">
                            <option value="" {{ empty($delivery->truck_id) ? 'selected' : '' }}>SELECT TRUCK</option>

                            @foreach ($truck as $item)
                            <option value="{{ $item->id }}" {{ $delivery->truck_id == $item->id ? 'selected' : '' }}>
                                {{ $item->model }} - {{ $item->plate }}
                            </option>
                            @endforeach
                        </select>

                        <label for="deliveryDate" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2"
                            style="font-size:15px">Date:</label>
                        <input class="form-input flex-1 mb-2" name="date" id="deliveryDate" type="date"
                            value="{{ $delivery->date }}">

                        <label for="status" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Status:</label>
                        <input class="form-input flex-1 mb-2" name="status" id="status" type="text" readonly
                            value="{{ $delivery->status}}">

                        <label for="note" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Note:</label>
                        <input class="form-input flex-1 mb-2" id="note" type="text" name="note"
                            value="{{$delivery->note ?? ' N/A '}}">
                        <button type="button" class="btn btn-primary mt-3 gap-2" style="width:100%"
                            onclick="submitOrders()" @if($allowance && ($allowance->status === 'approved' ||
                            $allowance->status === 'completed'))
                            disabled
                            @endif><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>Save Edit</button>
                    </form>
                    <form action="{{route('deploydelivery')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$delivery->id}}">
                        <button type="submit" class="btn btn-success w-full gap-2 mt-4" @if($allowance)
                            @if($allowance->status !==
                            'completed' || $delivery->status == 'deployed' || $delivery->status == 'completed')
                            disabled
                            @endif
                            @else
                            disabled
                            @endif
                            >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>
                            Deploy Delivery
                        </button>
                    </form>
                </div>
                @if($delivery->truck_id !== null && $delivery->driver_id !== null)
                <div>
                    <h1 class="text-lg font-semibold dark:text-white-light">DELIVERY ALLOWANCE</h1>

                    @if($allowance)
                    <form action="{{route('createallowance')}}" method="POST" class="mt-5">
                        @csrf
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Requested By:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" name="request_name"
                            value="{{Auth::user()->lname}}, {{Auth::user()->fname}}" readonly>
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Status:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" value="{{$allowance->status}}" readonly>
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Amount: </label>
                        <input class="form-input flex-1 mb-2" type="number" name="amount"
                            value="{{$allowance->allowance}}" @if($allowance->status ===
                        'approved')
                        readonly
                        @endif>
                        <input type="hidden" name="driver_id" value="{{$delivery->truck_id}}">
                        <input type="hidden" name="delivery_id" value="{{$delivery->id}}">

                        @if($allowance->status !== 'completed')
                        <button type="submit" class="btn btn-primary mt-7 gap-2" style="width:100%"
                            @if($allowance->status ===
                            'approved')
                            disabled
                            @endif

                            ><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                            </svg>Save Edit</button>
                        @endif
                    </form>
                    @else
                    <form action="{{route('createallowance')}}" method="POST" class="mt-5">
                        @csrf
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Requested By:
                        </label>
                        <input class="form-input flex-1 mb-2" type="text" name="request_name"
                            value="{{Auth::user()->lname}}, {{Auth::user()->fname}}" readonly>
                        <label for="tripid" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2" style="font-size:15px">Amount: </label>
                        <input class="form-input flex-1 mb-2" type="number" name="amount">
                        <input type="hidden" name="driver_id" value="{{$delivery->truck_id}}">
                        <input type="hidden" name="delivery_id" value="{{$delivery->id}}">
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
                            </svg>Submit Request</button>
                    </form>
                    @endif
                </div>
                @endif
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

                    @if ($delivery->status == 'pending' )

                    <div class="order-item order mt-2 items-md-center rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right"
                        data-id="{{ $order->id }}" data-sender-name="{{ $order->receiver_name }}"
                        data-reference-number="{{ $order->reference_number }}"
                        data-sender-address="{{ $order->receiver_address }}" data-items="{{ $itemsData }}"
                        ondragstart="drag(event)" ondragstart="this.classList.add('dragging')"
                        ondragend="this.classList.remove('dragging')" draggable="true">
                        {{-- <h1> <strong>ID:</strong> {{ $order->id}}</h1> --}}
                        <h1> <strong>Reference Number: </strong> {{ $order->reference_number}}</h1>
                        <h1> <strong>Receiver Name: </strong> {{ $order->receiver_name}}</h1>
                        <h1> <strong>Receiver Number: </strong> {{ $order->receiver_number}}</h1>
                        <h1> <strong>Delivery Address:</strong><br>{{ $order->receiver_address }}</h1>
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
                    @endif

                    @endforeach
                </div>

                <div id="submitted-orders" ondragover="allowDrop(event)" ondrop="drop(event, 'submitted-orders')"
                    class="submitted-orders-section">
                    <div class="delivery-drag-title">
                        <h3 class="title text-[#3b3f5c] dark:text-white-light font-semibold text-[13px] mt-2">
                            DRAG ORDERS HERE:</h3>
                        <div class="mb-8" style="height: 31px"></div>
                        <div>

                            @foreach ($orderDetails as $order)
                            <div class="order-item order mt-2 items-md-center rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right"
                                data-id="{{ $order->id }}" style="font-size: 14px; text-transform: capitalize">
                                <h1> <strong>Reference Number: </strong> {{ $order->reference_number}}</h1>
                                <h1> <strong>Sender Name: </strong> {{ $order->sender_name}}</h1>
                                <h1> <strong>Address:</strong><br>{{ $order->sender_address }}</h1>
                                @php
                                $items = json_decode($order->items, true);
                                @endphp
                                @if (!empty($items))
                                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 mt-1">
                                    @foreach ($items as $item)
                                    <div class="item">
                                        <h1><strong>Boxes: </strong>{{ $item['qty'] }}x {{ $item['name'] }}</h1>
                                        <h1><strong>Area:</strong> {{ $item['area'] ?? 'N/A' }}</h1>

                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('order-search').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const orders = document.querySelectorAll('.order-item');

    orders.forEach(order => {

       
        const referencenumber = order.getAttribute('data-reference-number').toLowerCase();
        const senderName = order.getAttribute('data-sender-name').toLowerCase();
        const senderAddress = order.getAttribute('data-sender-address').toLowerCase();
        const itemsData = order.getAttribute('data-items').toLowerCase();

        if (order.classList.contains('dragging')) {
            order.style.display = '';
            return; 
        }
        if (senderName.includes(searchValue) || senderAddress.includes(searchValue) || itemsData.includes(searchValue) || referencenumber.includes(searchValue)) {
            order.style.display = '';
        } else {
            order.style.display = 'none';
        }

    });
});
localStorage.removeItem('selectedOrders');
const orderIds = {!! json_encode($orderDetails->pluck('id')->map(function($id) { return (string) $id; })) !!};
if (!localStorage.getItem('selectedOrders')) {
    localStorage.setItem('selectedOrders', JSON.stringify(orderIds));
}
let selectedOrders = JSON.parse(localStorage.getItem('selectedOrders')) || [];



function allowDrop(event) {
    event.preventDefault(); 
}

function drag(event) {
    event.dataTransfer.setData("text/plain", event.target.dataset.id);
    event.target.classList.add('dragging'); 
}

function dragEnd(event) {
    event.target.classList.remove('dragging'); 
}

function drop(event, dropZone) {
   

    event.preventDefault();
    const orderId = event.dataTransfer.getData("text/plain");
    const orderElement = document.querySelector(`.order[data-id='${orderId}']`);

    if (dropZone === 'submitted-orders') {
        if (!selectedOrders.includes(orderId)) {
            document.getElementById(dropZone).appendChild(orderElement);
            selectedOrders.push(orderId);
        }
    } else if (dropZone === 'orders') {
        document.getElementById(dropZone).appendChild(orderElement);
        selectedOrders = selectedOrders.filter(id => id !== orderId); 
    }
    localStorage.setItem('selectedOrders', JSON.stringify(selectedOrders));
    // console.log('Selected Orders:', selectedOrders);
}


function submitOrders() {
  
    const deliveryForm = document.getElementById('deliveryForm');
    const formData = new FormData(deliveryForm);
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
        new window.Swal({
            toast: true,
            position: 'bottom-start',
            text: data.message || "Delivery submitted successfully!",
            icon: 'success',
            timer: 2000,
            showCloseButton: true,
            showConfirmButton: false,
        }).then(() => {
            location.reload(); 
        });
        localStorage.removeItem('selectedOrders');
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        new window.Swal({
            toast: true,
            position: 'bottom-start',
            text: 'An error occurred while submitting orders.',
            icon: 'error',
            timer: 2000,
            showCloseButton: true,
            showConfirmButton: false,
        });
    });
}
const orders = document.querySelectorAll('.order-item');
orders.forEach(order => {
    order.setAttribute('draggable', 'true');
    order.addEventListener('dragstart', drag);
    order.addEventListener('dragend', dragEnd);
});


</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('deliveryForm');
        const dateInput = document.getElementById('deliveryDate');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); 
        const day = String(today.getDate()).padStart(2, '0');
        
        const minDate = `${year}-${month}-${day}`;
        dateInput.setAttribute('min', minDate);

        form.addEventListener('submit', function (event) {
            const selectedDate = new Date(dateInput.value);
            const minDateObj = new Date(minDate);

            // Check if the selected date is valid
            if (selectedDate < minDateObj) {
                event.preventDefault(); // Prevent form submission
                alert('Please select a valid date. Past dates are not allowed.');
            }
        });
    });
</script>


@endsection