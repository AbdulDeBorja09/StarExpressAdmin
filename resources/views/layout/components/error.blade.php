@if ($errors->any())

@foreach ($errors->all() as $error)
<div
    class="error-message relative mt-5 flex items-center rounded border border-danger bg-danger-light p-3.5 text-danger before:absolute before:top-1/2 before:-mt-2 before:border-l-8 before:border-t-8 before:border-b-8 before:border-t-transparent before:border-b-transparent before:border-l-inherit ltr:border-l-[64px] ltr:before:left-0 rtl:border-r-[64px] rtl:before:right-0 rtl:before:rotate-180 dark:bg-danger-dark-light">

    <span class="absolute inset-y-0 m-auto h-6 w-6 text-white ltr:-left-11 rtl:-right-11">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
            <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
            <path d="M12 7V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <circle cx="12" cy="16" r="1" fill="currentColor"></circle>
        </svg>
    </span>
    <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{ $error }}</span>
    <button type="button" class="hover:opacity-80 ltr:ml-auto rtl:mr-auto"
        onclick="this.closest('.error-message').style.display = 'none';">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>

</div>
@endforeach
@endif