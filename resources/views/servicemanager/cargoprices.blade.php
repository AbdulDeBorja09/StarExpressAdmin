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
    @if($prices->isNotEmpty())

    @foreach ($prices as $item )
    <div class="panel pb-2  mt-5">



    </div>
    @endforeach
    @else
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2 mt-5">
        <div class="panel">
            <h1 style="font-size: 20px; text-transform:capitalize;">Add First Cargo Box</h1>

            <form action="{{route('addcargoprice')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 items-center">

                    <label for="serviceDropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Cargo
                        Service
                    </label>
                    <select id="serviceDropdown" class="form-input flex-1" name="service_id"
                        style="text-transform: capitalize">
                        <option value="">-- SELECT CARGO SERVICE --</option>
                        @foreach($service as $item)
                        <option value="{{ $item->destinationBranch->id }}|{{ $item->originBranch->id }}|{{$item->id}}">
                            {{ $item->originBranch->branch }} To {{ $item->destinationBranch->branch }}
                        </option>

                        @endforeach
                    </select>


                    <label for="regionDropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                        style="font-size:15px">Region</label>
                    <select id="regionDropdown" class="form-input flex-1" name="region"
                        style="text-transform: uppercase;">
                        <option value="">-- Select Region --</option>
                    </select>

                    <label for="name" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box Name
                    </label>
                    <input id="name" type="text" name="name" class="form-input flex-1" required>

                    <label for="type" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Cago type
                    </label>
                    <input id="type" type="text" name="type" class="form-input flex-1" required>

                    <label for="width" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box Width
                    </label>
                    <input id="width" type="text" name="width" class="form-input flex-1" required>

                    <label for="height" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                        Height
                    </label>
                    <input id="height" type="text" name="height" class="form-input flex-1" required>


                    <label for="length" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                        Length
                    </label>
                    <input id="length" type="text" name="length" class="form-input flex-1" required>

                    <label for="price" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box Price
                    </label>
                    <input id="price" type="text" name="rate" class="form-input flex-1" required>

                    <label for="image" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box Image
                    </label>
                    <input type="file" name="image" required
                        class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                </div>
                <div class="flex justify-center items-center mt-8">
                    <button type="submit" class="btn btn-outline-success" style="width:50%">Save</button>
                </div>
                @if ($errors->any())
                <div class="panel">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><i>* {{ $error }}</i></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
    </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#serviceDropdown').change(function() {
            var serviceId = $(this).val();
            $('#regionDropdown').empty().append('<option value="">-- SELECT REGION --</option>');

            if (serviceId) {
                $.ajax({
                    url: '/branches/' + serviceId, 
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#regionDropdown').append('<option value="' + value.region+ '">' + value.region + '</option>');
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