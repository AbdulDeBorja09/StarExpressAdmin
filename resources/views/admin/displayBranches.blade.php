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
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Branches</a>
        </li>
    </ol>
    @include('layout.components.error')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
        <div class="panel">
            <h1 style="font-size: 20px"><b>Add Branch</b></h1>
            <form class="space-y-5" action="{{route('submitaddBranch')}}" method="POST">
                @csrf
                <div>
                    <label for="country">Country Name:</label>
                    <input id="country" type="text" name="country" placeholder="Enter Country" class="form-input"
                        required />
                </div>
                <div>
                    <label for="branch">Branch Name:</label>
                    <input id="branch" type="text" name="branch" placeholder="Enter Branch" class="form-input"
                        required />
                </div>
                <button type="submit" class="btn btn-primary !mt-6">Submit</button>
            </form>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
        @foreach ($countries as $country => $branches)
        <div class="panel lg:row-span-2">
            <div class="table-responsive">
                <table style="text-transform: capitalize;">
                    <thead>
                        <tr>
                            <th>{{$country}}</th>
                            <th style="width:15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                        <tr>
                            @if($branch->branch !== NULL)
                            <td>{{ $branch->branch }}</td>
                            <td class="flex border-[#ebedf2] dark:border-[#191e3a] text-center" style="width:15%">
                                @include('admin.modals.editbranches')
                                <form action="{{route('deletebranch')}}" method="POST"
                                    id="delete-form-{{ $branch->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$branch ->id}}">
                                    <button type="button" x-tooltip="Delete"
                                        onclick="showAlert(event, 'delete-form-{{ $branch->id }}')">
                                        <svg width=" 24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                            <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
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
                                            html: `<div class="mt-3">This action will delete all data connected to this branch, except for transactions. You won't be able to revert this!</div>`,
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
                                                    html: '<div class="text-center mt-3">Branch Has Been Shutdown.</div>', 
                                                    icon: 'success',
                                                    confirmButtonText: 'OK', 
                                                });
                                               
                                            } else if (result.dismiss === window.Swal.DismissReason.cancel) {
                                                swalWithBootstrapButtons.fire({
                                                    title: 'Cancelled',
                                                    html: '<div class="text-center mt-3">Your Branch Is Safe.</div>', 
                                                    icon: 'error',
                                                    confirmButtonText: 'OK', 
                                                });
                                            }
                                        });
                                    }
                                    </script>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection