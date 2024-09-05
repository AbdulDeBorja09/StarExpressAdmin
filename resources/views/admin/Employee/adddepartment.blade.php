@extends('admin.layout.app')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl">Add Department</h2>
    </div>

    <div class="grid mt-5 grid-cols-1 gap-4 xl:grid-cols-2">
        <div class="panel lg:row-span-2">
            <form>
                <div class="mb-5">
                    <div class="flex">
                        <div
                            class="flex items-center justify-center border border-[#e0e6ed] bg-[#eee] px-3 font-semibold ltr:rounded-l-md ltr:border-r-0 rtl:rounded-r-md rtl:border-l-0 dark:border-[#17263c] dark:bg-[#1b2e4b]">
                            Department
                        </div>
                        <input type="text" placeholder="Username"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection