<div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
    <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
        <div x-show="open" x-transition x-transition.duration.300
            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
            <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                <h5 class="font-bold text-lg">Add Cargo Box</h5>
                <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="h-6 w-6">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="p-5">
                <form action="{{route('addcargobox')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4 items-center">

                        <label for="serviceDropdown" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 "
                            style="font-size:15px">Cargo
                            Service
                        </label>
                        <select id="serviceDropdown" class="form-input flex-1" name="service" required
                            style="text-transform: capitalize">
                            <option value="">-- SELECT CARGO SERVICE --</option>
                            @foreach($service as $item)
                            <option
                                value="{{ $item->originBranch->id }}|{{ $item->destinationBranch->id }}|{{$item->id}}">
                                {{ $item->originBranch->branch }} To {{ $item->destinationBranch->country }}
                            </option>

                            @endforeach
                        </select>

                        <label for="name" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                            Name
                        </label>
                        <input id="name" type="text" name="name" class="form-input flex-1" required>

                        <label for="width" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                            Width
                        </label>
                        <input id="width" type="text" name="width" class="form-input flex-1" required>

                        <label for="height" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                            Length
                        </label>
                        <input id="height" type="text" name="height" class="form-input flex-1" required>

                        <label for="length" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                            Height
                        </label>
                        <input id="price" type="text" name="length" class="form-input flex-1" required>

                        <label for="note" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Note
                        </label>
                        <input id="note" type="text" name="note" class="form-input flex-1" required>

                        <label for="image" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter Box
                            Image
                        </label>
                        <input type="file" name="image" required
                            class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                    </div>
                    <div class="flex justify-center items-center mt-8">
                        <button type="submit" class="btn btn-outline-success" style="width:50%">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>