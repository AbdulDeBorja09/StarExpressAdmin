<div
    class="chat-users perfect-scrollbar relative -mr-3.5 h-full min-h-[100px] space-y-0.5 pr-3.5 sm:h-[calc(100vh_-_357px)]">
    <button
        class="flex w-full items-center justify-between rounded-md p-2 hover:bg-gray-100 hover:text-primary dark:hover:bg-[#050b14] dark:hover:text-primary"
        :class="{'bg-gray-100 dark:bg-[#050b14] dark:text-primary text-primary': selectedUser.userId === person.userId}">
        <div class="flex-1">
            <div class="flex items-center">
                <div class="relative flex-shrink-0">
                    <img src="/images/avatar.png" class="h-12 w-12 rounded-full object-cover">
                    <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                        <div class="h-4 w-4 rounded-full bg-success"></div>
                    </div>

                </div>
                <div class="mx-3 ltr:text-left rtl:text-right">
                    <p class="mb-1 font-semibold">Full Name</p>
                    <p class="max-w-[185px] truncate text-xs text-white-dark">Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Dignissimos sequi, asperiores commodi
                        quidem facere quas suscipit officia! Dolorem, in consequuntur tenetur nulla
                        rem, molestias dolor sed doloribus aut voluptatem voluptatibus?</p>
                </div>
            </div>
        </div>
        <div class="whitespace-nowrap text-xs font-semibold">
            <p>10:00pm</p>
        </div>
    </button>
</div>