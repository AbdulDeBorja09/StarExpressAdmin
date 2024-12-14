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
                Customers</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class=" mb-5">
                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Age</th>
                            <th style="text-align: center">Transaction</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer as $index => $item)
                        <tr>
                            @php
                            $createdAt = \Carbon\Carbon::parse($item->created_at);
                            $now = \Carbon\Carbon::now();
                            $years = $createdAt->diff($now)->y;
                            $months = $createdAt->diff($now)->m;
                            $days = $createdAt->diff($now)->d;
                            @endphp
                            <td style="width: 50px; text-align:center;">{{ $loop->iteration }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{ $years }} years, {{ $months }} months, {{ $days }} days</td>
                            <td style="text-align: center">{{ $item->order_count }}</td>
                            <td style="text-align: center">@if($item->status === "active")
                                <span class="badge rounded-full bg-success/20 text-success hover:top-0">Active</span>
                                @else
                                <span class="badge rounded-full bg-danger/20 text-danger hover:top-0">Suspended</span>
                                @endif
                            </td>
                            <td>
                                <div x-data="modal">
                                    @if($item->status === "active")
                                    <button type=" button" @click="toggle" x-tooltip="Edit"
                                        class="btn btn-outline-danger mx-auto">Suspend</button>
                                    @else
                                    <button class="btn btn-outline-danger mx-auto" disabled>Suspend</button>
                                    @endif

                                    <!-- modal -->
                                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                        :class="open && '!block'">
                                        <div class="flex items-center justify-center min-h-screen px-4"
                                            @click.self="open = false">
                                            <div x-show="open" x-transition x-transition.duration.300
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                                <div
                                                    class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                    <h5 class="font-bold text-lg">Suspend Account</h5>
                                                    <button type="button" class="text-white-dark hover:text-dark"
                                                        @click="toggle">
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
                                                    <form action="{{route('suspend')}}" method="POST">
                                                        @csrf
                                                        <div class="mt-0 items-center">
                                                            <input type="hidden" name="id">
                                                            <div class="mt-5">
                                                                <label for="email"
                                                                    class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                    style="font-size:15px">Email:
                                                                </label>
                                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                                <input type="hidden" name="name"
                                                                    value="{{$item->name}}">
                                                                <input name="email" id="email"
                                                                    class="tcaps form-input flex-1" readonly
                                                                    value="{{$item->email}}">
                                                                <input type="hidden" name="type" value="user">
                                                            </div>
                                                            <div class="mt-5">
                                                                <label for="reason"
                                                                    class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                    style="font-size:15px">Reason:
                                                                </label>
                                                                <input name="reason" id="reason"
                                                                    class="tcaps form-input flex-1" required>

                                                            </div>
                                                        </div>
                                                        <div class="flex justify-center items-center mt-8">
                                                            <button type="submit" class="btn btn-outline-danger"
                                                                style="width:50%">Suspend</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        Showing {{ $customer->firstItem() }} to {{ $customer->lastItem() }} of {{ $customer->total() }}
                        Visits
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
                            @if ($customer->onFirstPage())
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
                                    href="{{ request()->fullUrlWithQuery(['page' => $customer->currentPage() - 1]) }}"><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $customer->lastPage(); $i++)
                                @if ($i == $customer->currentPage())
                                <li class="active"><a href="#">{{ $i }}</a></li>
                                @else
                                <li><a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a></li>
                                @endif
                                @endfor

                                @if ($customer->hasMorePages())
                                <li class="pager"><a
                                        href="{{ request()->fullUrlWithQuery(['page' => $customer->currentPage() + 1]) }}"><svg
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
                @foreach($customer as $item)
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