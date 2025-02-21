<div class="mb-5" x-data="modal">
    <!-- button -->
    <div class="flex items-center mt-4">
        <button type="button" class="btn btn-outline-info" @click="toggle">Add Region</button>
    </div>

    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div x-show="open" x-transition x-transition.duration.300
                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <h5 class="font-bold text-lg">Add Region</h5>
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
                    <form action="{{route('addlocations')}}" method="POST">
                        @csrf
                        <div class="mt-4 items-center">
                            <input type="hidden" name="branch_id" id="" value="{{$branches->id}}">
                            <label for="acno" class="mb-2 w-1/3 ltr:mr-2 rtl:ml-2">Region</label>
                            <input id="acno" type="text" name="region" class="form-input flex-1"
                                placeholder="Enter New Region" required>
                            <label for="acno" class="mt-2 w-1/3 ltr:mr-2 rtl:ml-2">Atleast one area:</label>
                            <input id="acno" type="text" name="area" class="form-input flex-1" placeholder="Enter Area "
                                required>
                        </div>
                        <div class="flex justify-end items-center mt-8">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>