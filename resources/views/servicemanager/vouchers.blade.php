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
                <div class="" x-data="modal">
                    <!-- button -->
                    <div class="flex items-center ">
                        <button type="button" class="btn btn-outline-success" @click="toggle">Add Voucher</button>
                    </div>

                    <!-- modal -->
                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                        <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
                            <div x-show="open" x-transition x-transition.duration.300
                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                    <h5 class="font-bold text-lg">Add Voucher</h5>
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
                                    <form action="{{route('newvoucher')}}" method="POST">
                                        @csrf
                                        <div class="mt-0 items-center" style=" text-align: start;">
                                            <div class="mt-5">
                                                <label for="service" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Service:
                                                </label>
                                                <select class="tcaps form-input flex-1" name="service" id="service">
                                                    @foreach($allservice as $item)
                                                    <option value="{{$item->id}}">
                                                        {{$item->originBranch->branch}},
                                                        {{$item->originBranch->country}} To
                                                        {{$item->destinationBranch->country}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-5">
                                                <label for="code" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Code:
                                                </label>
                                                <input name="code" id="code" class="tcaps form-input flex-1" required>
                                            </div>

                                            <div class="mt-5">
                                                <label for="discount" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Amount:
                                                </label>
                                                <input name="amount" id="discount" class="tcaps form-input flex-1"
                                                    required>
                                            </div>
                                            <div class="mt-5">
                                                <label for="count" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Count:
                                                </label>
                                                <input name="count" id="count" class="tcaps form-input flex-1" required>
                                            </div>

                                            <div class="mt-5">
                                                <label for="valid" class="mb-2 mt-2 w-100 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Valid
                                                    Until
                                                </label>
                                                <input type="datetime-local" name="valid" id="discount"
                                                    class="tcaps form-input flex-1" required>
                                            </div>
                                            <div class="mt-5">
                                                <label for="status" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                    style="font-size:15px">Status:
                                                </label>
                                                <select name="status" id="status" class="tcaps form-input flex-1">
                                                    <option value="active">Active
                                                    </option>
                                                    <option value="inactive">Inactive
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="flex justify-center items-center mt-8">
                                            <button type="submit" class="btn btn-outline-success"
                                                style="width:50%">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
            </div>
            <div class="table-responsive">
                <table class="orders-table table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="text-align:center; width: 150px;">Validity</th>
                            <th>Until</th>
                            <th>Created By</th>
                            <th style="text-align: center">Code</th>
                            <th style="text-align: center">Amount</th>
                            <th style="text-align: center">Count</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voucher as $num => $item)
                        <tr>
                            <td>{{$num + 1}}</td>
                            <td style="text-align:center; width: 150px;">
                                @if(\Carbon\Carbon::parse($item->validity)->isPast())
                                <span class="badge bg-danger">Expired</span>
                                @else
                                <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->validity)->format('F j, Y') }}</td>
                            <td>{{$item->edited_by ?? 'N/A'}}</td>
                            <td style="text-align: center">{{$item->code}}</td>
                            <td style="text-align: center">{{$item->amount}}</td>
                            <td style="text-align: center">{{$item->count}}</td>
                            <td style="text-align: center">
                                @if($item->status === 'active')
                                <span class="badge badge-outline-success">Active</span>
                                @else
                                <span class="badge badge-outline-danger">Inactive</span>
                                @endif
                            </td>
                            <td style="text-align: center" style="width: 50px;">
                                <div class="flex justify-around">

                                    <div x-data="modal">
                                        <!-- button -->
                                        <button type=" button" @click="toggle" x-tooltip="Edit" class="mt-1">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2">
                                                <path
                                                    d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                                <path opacity="0.5"
                                                    d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                            </svg>
                                        </button>

                                        <!-- modal -->
                                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                            :class="open && '!block'">
                                            <div class="flex items-center justify-center min-h-screen px-4"
                                                @click.self="open = false">
                                                <div x-show="open" x-transition x-transition.duration.300
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                                    <div
                                                        class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                        <h5 class="font-bold text-lg">Edit Voucher</h5>
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
                                                    <div class="p-3">
                                                        <form action="{{route('editvoucher')}}" method="POST">
                                                            @csrf
                                                            <div class="mt-0 items-center"
                                                                style="text-transform: capitalize; text-align: start;">
                                                                <input type="hidden" name="id" value="{{$item->id}}">


                                                                <div class="mt-5">
                                                                    <label for="service"
                                                                        class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Service:
                                                                    </label>
                                                                    <select class="tcaps form-input flex-1"
                                                                        name="service" id="service">
                                                                        @foreach($service as $services)
                                                                        <option value="{{$services->id}}">
                                                                            {{$services->originBranch->branch}},
                                                                            {{$services->originBranch->country}} To
                                                                            {{$services->destinationBranch->country}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <label for="code"
                                                                        class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Code:
                                                                    </label>
                                                                    <input name="code" id="code"
                                                                        class="tcaps form-input flex-1"
                                                                        value="{{$item->code}}" required>
                                                                </div>

                                                                <div class="mt-5">
                                                                    <label for="discount"
                                                                        class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Amount:
                                                                    </label>
                                                                    <input name="amount" id="discount"
                                                                        class="tcaps form-input flex-1"
                                                                        value="{{$item->amount}}" required>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <label for="count"
                                                                        class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Count:
                                                                    </label>
                                                                    <input name="count" id="count"
                                                                        class="tcaps form-input flex-1"
                                                                        value="{{$item->count}}" required>
                                                                </div>

                                                                <div class="mt-5">
                                                                    <label for="valid"
                                                                        class="mb-2 mt-2 w-100 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Valid
                                                                        Until {{
                                                                        \Carbon\Carbon::parse($item->validity)->format('F
                                                                        j, Y') }}
                                                                    </label>
                                                                    <input type="datetime-local" name="valid"
                                                                        id="discount" class="tcaps form-input flex-1"
                                                                        required value="{{$item->validity}}">
                                                                </div>
                                                                <div class="mt-5">
                                                                    <label for="status"
                                                                        class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                                        style="font-size:15px">Status:
                                                                    </label>
                                                                    <select name="status" id="status"
                                                                        class="tcaps form-input flex-1">
                                                                        <option value="active" {{ $item->status ==
                                                                            'active' ? 'selected' : '' }}>Active
                                                                        </option>
                                                                        <option value="inactive" {{ $item->status ==
                                                                            'inactive' ? 'selected' : '' }}>Inactive
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="flex justify-center items-center mt-8">
                                                                <button type="submit" class="btn btn-outline-success"
                                                                    style="width:50%">Save</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <form action="{{route('deletevoucher')}}" method="POST"
                                        id="delete-form-{{ $item->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}}">
                                        <button type="button" x-tooltip="Delete"
                                            onclick="showAlert(event, 'delete-form-{{ $item->id }}')">
                                            <svg width=" 24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round"></path>
                                                <path
                                                    d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                                <path opacity="0.5"
                                                    d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                            </svg>
                                        </button>
                                        <script>
                                            async function showAlert(event, formId) {
                                            event.preventDefault(); 
                                            const swalWithBootstrapButtons = window.Swal.mixin({
                                                confirmButtonClass: 'btn btn-secondary',
                                                cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
                                                buttonsStyling: false,
                                            });
                                            swalWithBootstrapButtons
                                            .fire({
                                                title: 'Are you sure?',
                                                html: `<div class="mt-3"> You won't be able to revert this! </div>`,
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Yes, delete it!',
                                                cancelButtonText: 'No, cancel!',
                                                reverseButtons: true,
                                                padding: '2em',
                                            })
                                            .then((result) => {
                                                if (result.value) {
                                                    document.getElementById(formId).submit(); 
                                                    swalWithBootstrapButtons.fire({
                                                        title: 'Deleted!',
                                                        html: '<div class="text-center mt-3">Voucher Has Been Deleted.</div>', 
                                                        icon: 'success',
                                                        confirmButtonText: 'OK', 
                                                    });
                                                
                                                } else if (result.dismiss === window.Swal.DismissReason.cancel) {
                                                    swalWithBootstrapButtons.fire({
                                                        title: 'Cancelled',
                                                        html: '<div class="text-center mt-3">Your Voucher Is Safe.</div>', 
                                                        icon: 'error',
                                                        confirmButtonText: 'OK', 
                                                    });
                                                }
                                            });
                                        }
                                        </script>
                                    </form>
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
                        Showing {{ $voucher->firstItem() }} to {{ $voucher->lastItem() }} of {{ $voucher->total()
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
                            @if ($voucher->onFirstPage())
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
                                    href="{{ request()->fullUrlWithQuery(['page' => $voucher->currentPage() - 1]) }}"><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $voucher->lastPage(); $i++)
                                @if ($i == $voucher->currentPage())
                                <li class="active"><a href="#">{{ $i }}</a></li>
                                @else
                                <li><a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a></li>
                                @endif
                                @endfor

                                @if ($voucher->hasMorePages())
                                <li class="pager"><a
                                        href="{{ request()->fullUrlWithQuery(['page' => $voucher->currentPage() + 1]) }}"><svg
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