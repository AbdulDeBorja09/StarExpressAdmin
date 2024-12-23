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
                Income</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-5">
        <div class="panel">
            <div class="flex  mb-5" style="justify-content: space-between">
                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
            </div>
            <div class="table-responsive">
                <table class="orders-table table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="text-align:center;width: 150px;">Action</th>
                            <th>User</th>
                            <th>Table</th>
                            <th>Date</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td style="text-align:center; width: 150px;">
                                @if($log->action === 'Edit')
                                <span class="badge bg-warning">Edit</span>
                                @elseif($log->action === 'New')
                                <span class="badge bg-success">New</span>
                                @elseif($log->action === 'Delete')
                                <span class="badge bg-danger">Delete</span>
                                @endif
                            </td>
                            <td>{{ optional($log->user)->lname . ' ' . optional($log->user)->fname ?: 'System' }}</td>
                            <td>{{ $log->table }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->updated_at)->format('F j, Y h:i A') }}</td>
                            <td style="text-align:center">
                                <div x-data="modal">
                                    <!-- button -->
                                    <button type="button" class="hover:text-primary" @click="toggle" x-tooltip="View">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                            <path opacity="0.5"
                                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                stroke="currentColor" stroke-width="1.5"></path>
                                            <path
                                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </button>
                                    <!-- modal -->
                                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                        :class="open && '!block'">
                                        <div class="flex items-center justify-center min-h-screen px-4"
                                            @click.self="open = false">
                                            <div x-show="open" x-transition x-transition.duration.300
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-6xl my-8">
                                                <div
                                                    class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                    <h5 class="font-bold text-lg">Audit Logs</h5>
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
                                                    <div class="mb-6 flex flex-wrap justify-between gap-6">
                                                        <!-- Old Data Table -->
                                                        <div class="flex-1 min-w-[45%]">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="2">Old Data</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Field</th>
                                                                        <th>Value</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($log->old_data)
                                                                    @php
                                                                    $oldData = json_decode($log->old_data, true);
                                                                    @endphp
                                                                    @if (is_array($oldData))
                                                                    @foreach ($oldData as $key => $value)
                                                                    <tr>
                                                                        <td>{{ ucfirst($key) }}</td>
                                                                        <td>{{ $value ?? 'N/A' }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <!-- New Data Table -->
                                                        <div class="flex-1 min-w-[45%]">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="2">New Data</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Field</th>
                                                                        <th>Value</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $newData = json_decode($log->new_data, true);
                                                                    @endphp
                                                                    @if (is_array($newData))
                                                                    @foreach ($newData as $key => $value)
                                                                    <tr>
                                                                        <td>{{ ucfirst($key) }}</td>
                                                                        <td>{{ $value ?? 'N/A' }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total()
                        }}
                        Items
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
                            @if ($logs->onFirstPage())
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
                                    href="{{ request()->fullUrlWithQuery(['page' => $logs->currentPage() - 1]) }}"><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $logs->lastPage(); $i++)
                                @if ($i == $logs->currentPage())
                                <li class="active"><a href="#">{{ $i }}</a></li>
                                @else
                                <li><a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a></li>
                                @endif
                                @endfor

                                @if ($logs->hasMorePages())
                                <li class="pager"><a
                                        href="{{ request()->fullUrlWithQuery(['page' => $logs->currentPage() + 1]) }}"><svg
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