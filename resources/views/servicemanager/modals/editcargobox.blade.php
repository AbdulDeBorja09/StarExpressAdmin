<div x-data="modal">
    <!-- button -->
    <button type=" button" @click="toggle" x-tooltip="Edit" style="margin-top: 2px">
        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            class="h-4.5 w-4.5 ltr:mr-5 rtl:ml-2">
            <path
                d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                stroke="currentColor" stroke-width="1.5"></path>
            <path opacity="0.5"
                d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                stroke="currentColor" stroke-width="1.5"></path>
        </svg>
    </button>

    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300
                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <h5 class="font-bold text-lg">Edit Cargo Box</h5>
                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="p-5">
                    <form action="{{route('editcargobox')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4 items-center">
                            <input type="hidden" name="id" value="{{ $box->id }}">
                            <label for="name" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Box
                                Name
                            </label>
                            <input id="name" type="text" name="name" class="form-input flex-1" required
                                value="{{ $box->name }}">

                            @php

                            $sizes = explode(',', $box->size);


                            $size1 = isset($sizes[0]) ? trim($sizes[0]) : '';
                            $size2 = isset($sizes[1]) ? trim($sizes[1]) : '';
                            $size3 = isset($sizes[2]) ? trim($sizes[2]) : '';
                            @endphp
                            <label for="height" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Box
                                Width
                            </label>
                            <input id="height" type="text" name="height" class="form-input flex-1" value="{{$size1}}"
                                required>

                            <label for="width" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Box
                                Height
                            </label>
                            <input id="width" type="text" name="width" class="form-input flex-1" value="{{$size2}}"
                                required>

                            <label for="length" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Box
                                Length
                            </label>
                            <input id="price" type="text" name="length" class="form-input flex-1" value="{{$size3}}"
                                required>

                            <label for="note" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Note
                            </label>
                            <input id="note" type="text" name="note" class="form-input flex-1" required
                                value="{{ $box->note }}">

                            <label for="image" class="mb-2 mt-2 w-1/3 ltr:mr-2 rtl:ml-2 " style="font-size:15px">Enter
                                Box
                                Image
                            </label>
                            <input type="file" name="image"
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
</div>