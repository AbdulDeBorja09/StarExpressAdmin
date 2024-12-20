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
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Website
                Visits</a>
        </li>
    </ol>
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="flex justify-end mb-5">
                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
            </div>
            <div class="table-responsive" class="">
                <table class="orders-table table table-bordered" style="text-transform: capitalize;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ip Address</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->visitor_ip}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('g:i A') }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ url()->current() }}" method="GET" id="paginationForm">
                @csrf
                <div class="dataTable-bottom mt-5">
                    <div class="dataTable-info">
                        Showing {{ $visits->firstItem() }} to {{ $visits->lastItem() }} of {{ $visits->total() }} Visits
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
                            @if ($visits->onFirstPage())
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
                                    href="{{ request()->fullUrlWithQuery(['page' => $visits->currentPage() - 1]) }}"><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $visits->lastPage(); $i++)
                                @if ($i == $visits->currentPage())
                                <li class="active"><a href="#">{{ $i }}</a></li>
                                @else
                                <li><a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a></li>
                                @endif
                                @endfor

                                @if ($visits->hasMorePages())
                                <li class="pager"><a
                                        href="{{ request()->fullUrlWithQuery(['page' => $visits->currentPage() + 1]) }}"><svg
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
                @foreach($visits as $item)
                <div class="order" draggable="true" ondragstart="drag(event)">
                    {{ $item->order_name }} (Sender: {{ $item->sender_name }})
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('.dataTable-input');
        const tableRows = document.querySelectorAll('.table tbody tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let found = false;
                for (let i = 1; i < cells.length; i++) { 
                    const cell = cells[i];
                    if (cell) {
                        const textValue = cell.textContent || cell.innerText;
                        if (textValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break; 
                        }
                    }
                }
                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>
@endsection