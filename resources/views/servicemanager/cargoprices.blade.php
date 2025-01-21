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
                class="text-black hover:text-black/70 dark:text-white-light dark:hover:text-white-light/70">Prices</a>
        </li>
    </ol>
    @include('layout.components.error')
    @if($cargoboxes->isNotEmpty())
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1">
        @foreach($cargoboxes as $branchId => $services)
        <div class="panel mt-5">
            @php
            $branches = \App\Models\Branches::find($branchId);
            @endphp

            <div class="flex justify-between">
                <h1 class="mt-3" style="font-size: 25px; font-weight:700; text-transform: capitalize">Branch: {{
                    $branches->country
                    }}, {{ $branches->branch }}
                </h1>
                <div x-data="modal">
                    <button class="btn btn-outline-success" @click="toggle">Add Cargo Price</button>
                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                        <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
                            <div x-show="open" x-transition x-transition.duration.300
                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                    <h5 class="font-bold text-lg">Add Cargo Box</h5>
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
                                    <form action="{{route('addcargoprice')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mt-4 items-center">
                                            <label for="serviceDropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                style="font-size:15px">Cargo
                                                Service
                                            </label>
                                            <select id="serviceDropdown" class="serviceDropdown form-input flex-1"
                                                name="service_id" required style="text-transform: capitalize">
                                                <option value="">-- SELECT CARGO SERVICE --</option>
                                                @foreach($service as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->originBranch->branch }} To {{
                                                    $item->destinationBranch->country }}
                                                </option>

                                                @endforeach
                                            </select>
                                            <label for="boxdropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                style="font-size:15px">Select Cargo
                                                Box
                                            </label>
                                            <select id="boxdropdown" class="boxdropdown form-input flex-1" name="box"
                                                required style="text-transform: capitalize">
                                                <option value="">-- SELECT CARGO BOX --</option>

                                            </select>
                                            <label for="areaDropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                style="font-size:15px">Select Area
                                            </label>
                                            <select id="areaDropdown" class="areaDropdown form-input flex-1" name="area"
                                                required style="text-transform: capitalize">
                                                <option value="">-- SELECT AREA --</option>

                                            </select>
                                            <label for="name" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                style="font-size:15px">Enter Service Type
                                            </label>
                                            <input id="name" type="text" name="type" class="form-input flex-1" required>

                                            <label for="width" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                                                style="font-size:15px">Enter Price
                                            </label>
                                            <input id="width" type="number" name="rate" class="form-input flex-1"
                                                required>
                                            <div class="flex justify-center items-center mt-8">
                                                <button type="submit" class="btn btn-outline-success"
                                                    style="width:50%">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @foreach($services as $serviceId => $boxes)

            @php
            $firstServiceBox = $boxes->first();
            @endphp
            <h1 class="sub-title mt-10  mb-3">Service: {{ $firstServiceBox->service->originBranch->branch }} ({{
                $firstServiceBox->service->originBranch->country }}) To {{
                $firstServiceBox->service->destinationBranch->branch }} ({{
                $firstServiceBox->service->destinationBranch->country }})</h1>


            @foreach($boxes as $box)
            <h1 style="font-size: 20px" class="mt-2">{{ $box->name }}</h1>
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 mt-1">
                @foreach ($box->groupedPrices as $type => $priceDetails)
                <div class="table mb-5">
                    <h6>{{ $type }}</h6>
                    <table class="cargoprice-table mt-2">
                        <thead>
                            <tr>
                                <th>Area</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($priceDetails as $price)
                            <tr>
                                <td>{{ $price->area }}</td>
                                <td>
                                    <form action="{{route('editcargoprice')}}" id="editForm" method="POST">
                                        @csrf
                                        <input type="hidden" name="area" value="{{ $price->area }}">
                                        <input type="hidden" name="id" value="{{ $price->id }}">
                                        <input class="editinput" type="number" id="rateInput" name="rate"
                                            value="{{ $price->rate }}">
                                        <button type="submit" hidden></button>
                                    </form>


                                </td>
                                <td>
                                    <div class="flex justify-center">
                                        @include('servicemanager.modals.editcargoprice')
                                        <form action="{{route('deleteprice')}}" method="POST"
                                            id="delete-form-{{ $price->id }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$price->id}}}">
                                            <button type="button" x-tooltip="Delete"
                                                onclick="showAlert(event, 'delete-form-{{ $price->id }}')">
                                                <svg width=" 24" height="24" viewbox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 ltr:mr-2 rtl:ml-2">
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
                                                        html: '<div class="text-center mt-3">Cargo Price Has Been Deleted.</div>', 
                                                        icon: 'success',
                                                        confirmButtonText: 'OK', 
                                                    });
                                                
                                                } else if (result.dismiss === window.Swal.DismissReason.cancel) {
                                                    swalWithBootstrapButtons.fire({
                                                        title: 'Cancelled',
                                                        html: '<div class="text-center mt-3">Your Cargo Price Is Safe.</div>', 
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
                @endforeach
            </div>

            @endforeach

            @endforeach
        </div>
    </div>
    @endforeach
</div>
@else


@endif

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.serviceDropdown').change(function() {
            var serviceId = $(this).val();
            $('.boxdropdown').empty().append('<option value="">-- SELECT BOX --</option>');

            if (serviceId) {
                $.ajax({
                    url: '/branches/' + serviceId, 
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('.boxdropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log('Error: ', xhr);
                    }
                });
            }
        });
        
        $('.serviceDropdown').change(function() {
            var branchId = $(this).val();
            $('.areaDropdown').empty().append('<option value="">-- SELECT AREA --</option>');

            if (branchId) {
                $.ajax({
                    url: '/areas/' + branchId, 
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); 
                        $.each(data, function(index, item) {
                            if (item.region) {
                                $('.areaDropdown').append('<option value="' + item.region + '">' + item.region + '</option>');
                            } else {
                                console.error('Region is undefined for item:', item);
                            }
                        });
                    },
                    error: function(xhr) {
                        console.log('Error: ', xhr);
                    }
                });
            }
        });
    });
</script>


@endsection