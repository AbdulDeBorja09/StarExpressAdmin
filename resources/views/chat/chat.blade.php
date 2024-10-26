@extends('layout.app')
@section('content')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('b22c6a4713b5cbd86735', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
  });
</script>
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <!-- start main content section -->
    <div>
        <div class="relative flex h-full gap-5 sm:h-[calc(100vh_-_150px)] sm:min-h-0"
            :class="{'min-h-[999px]' : isShowChatMenu}">
            <div class="panel absolute z-10 hidden w-full max-w-xs flex-none space-y-4 overflow-hidden p-4 xl:relative xl:block xl:h-full"
                :class="isShowChatMenu &amp;&amp; '!block'">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-none"><img src="{{asset('/images/avatar.png')}}"
                                class="h-12 w-12 rounded-full object-cover"></div>
                        <div class="mx-3">
                            <p class="mb-1 font-semibold">{{$me->fname}} {{$me->lname}}</p>
                            <p class="text-xs text-white-dark">{{$me->type}}</p>
                        </div>
                    </div>

                </div>

                {{-- USER SEARCH --}}
                <div class="relative">
                    <input type="text" class="peer form-input ltr:pr-9 rtl:pl-9" placeholder="Searching...">
                    <div class="absolute top-1/2 -translate-y-1/2 peer-focus:text-primary ltr:right-2 rtl:left-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5">
                            </circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                <div class="!mt-0">
                    <div
                        class="chat-users perfect-scrollbar relative -mr-3.5 h-full min-h-[100px] space-y-0.5 pr-3.5 sm:h-[calc(100vh_-_357px)] ps">
                        <template x-for="person in searchUsers">
                            <button type="button"
                                class="flex w-full items-center justify-between rounded-md p-2 hover:bg-gray-100 hover:text-primary dark:hover:bg-[#050b14] dark:hover:text-primary"
                                :class="{'bg-gray-100 dark:bg-[#050b14] dark:text-primary text-primary': selectedUser.userId === person.userId}"
                                @click="selectUser(person)">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="relative flex-shrink-0">
                                            <img :src="`assets/images/${person.path}`"
                                                class="h-12 w-12 rounded-full object-cover">
                                            <template x-if="person.active">
                                                <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                                    <div class="h-4 w-4 rounded-full bg-success"></div>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="mx-3 ltr:text-left rtl:text-right">
                                            <p class="mb-1 font-semibold" x-text="person.name"></p>
                                            <p class="max-w-[185px] truncate text-xs text-white-dark"
                                                x-text="person.preview"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="whitespace-nowrap text-xs font-semibold">
                                    <p x-text="person.time"></p>
                                </div>
                            </button>
                        </template><button type="button"
                            class="flex w-full items-center justify-between rounded-md p-2 hover:bg-gray-100 hover:text-primary dark:hover:bg-[#050b14] dark:hover:text-primary bg-gray-100 dark:bg-[#050b14] dark:text-primary text-primary"
                            :class="{'bg-gray-100 dark:bg-[#050b14] dark:text-primary text-primary': selectedUser.userId === person.userId}"
                            @click="selectUser(person)">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="relative flex-shrink-0">
                                        <img src="{{asset('/images/avatar.png')}}" width="40">
                                        <template>
                                            <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                                <div class="h-4 w-4 rounded-full bg-success"></div>
                                            </div>
                                        </template>
                                        <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                            <div class="h-4 w-4 rounded-full bg-success"></div>
                                        </div>
                                    </div>
                                    <div class="mx-3 ltr:text-left rtl:text-right">
                                        <p class="mb-1 font-semibold">Nia Hillyer</p>
                                        <p class="max-w-[185px] truncate text-xs text-white-dark">How do you do?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="whitespace-nowrap text-xs font-semibold">
                                <p>2:09 PM</p>
                            </div>
                        </button>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute z-[5] hidden h-full w-full rounded-md bg-black/60"
                :class="isShowChatMenu &amp;&amp; '!block xl:!hidden'" @click="isShowChatMenu = !isShowChatMenu"></div>
            <div class="panel flex-1 p-0">
                <template x-if="isShowUserChat &amp;&amp; selectedUser">
                    <div class="relative h-full">
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <button type="button" class="hover:text-primary xl:hidden"
                                    @click="isShowChatMenu = !isShowChatMenu">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                        <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                        <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                        <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div class="relative flex-none">
                                    <img :src="`assets/images/${selectedUser.path}`"
                                        class="h-10 w-10 rounded-full object-cover sm:h-12 sm:w-12">
                                    <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                        <div class="h-4 w-4 rounded-full bg-success"></div>
                                    </div>
                                </div>
                                <div class="mx-3">
                                    <p class="font-semibold" x-text="selectedUser.name"></p>
                                    <p class="text-xs text-white-dark"
                                        x-text="selectedUser.active ? 'Active now' : 'Last seen at '+selectedUser.time">
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-3 sm:gap-5">
                                <button type="button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-primary">
                                        <path
                                            d="M13.5 2C13.5 2 15.8335 2.21213 18.8033 5.18198C21.7731 8.15183 21.9853 10.4853 21.9853 10.4853"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M14.207 5.53564C14.207 5.53564 15.197 5.81849 16.6819 7.30341C18.1668 8.78834 18.4497 9.77829 18.4497 9.77829"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path opacity="0.5"
                                            d="M15.1007 15.0272L14.5569 14.5107L15.1007 15.0272ZM15.5562 14.5477L16.1 15.0642H16.1L15.5562 14.5477ZM17.9728 14.2123L17.5987 14.8623H17.5987L17.9728 14.2123ZM19.8833 15.312L19.5092 15.962L19.8833 15.312ZM20.4217 18.7584L20.9655 19.2749L20.4217 18.7584ZM19.0011 20.254L18.4573 19.7375L19.0011 20.254ZM17.6763 20.9631L17.7499 21.7095L17.6763 20.9631ZM7.81536 16.4752L8.35915 15.9587L7.81536 16.4752ZM3.00289 6.96594L2.25397 7.00613L2.25397 7.00613L3.00289 6.96594ZM9.47752 8.50311L10.0213 9.01963H10.0213L9.47752 8.50311ZM9.63424 5.6931L10.2466 5.26012L9.63424 5.6931ZM8.37326 3.90961L7.76086 4.3426V4.3426L8.37326 3.90961ZM5.26145 3.60864L5.80524 4.12516L5.26145 3.60864ZM3.69185 5.26114L3.14806 4.74462L3.14806 4.74462L3.69185 5.26114ZM11.0631 13.0559L11.6069 12.5394L11.0631 13.0559ZM15.6445 15.5437L16.1 15.0642L15.0124 14.0312L14.5569 14.5107L15.6445 15.5437ZM17.5987 14.8623L19.5092 15.962L20.2575 14.662L18.347 13.5623L17.5987 14.8623ZM19.8779 18.2419L18.4573 19.7375L19.5449 20.7705L20.9655 19.2749L19.8779 18.2419ZM17.6026 20.2167C16.1676 20.3584 12.4233 20.2375 8.35915 15.9587L7.27157 16.9917C11.7009 21.655 15.9261 21.8895 17.7499 21.7095L17.6026 20.2167ZM8.35915 15.9587C4.48303 11.8778 3.83285 8.43556 3.75181 6.92574L2.25397 7.00613C2.35322 8.85536 3.1384 12.6403 7.27157 16.9917L8.35915 15.9587ZM9.7345 9.32159L10.0213 9.01963L8.93372 7.9866L8.64691 8.28856L9.7345 9.32159ZM10.2466 5.26012L8.98565 3.47663L7.76086 4.3426L9.02185 6.12608L10.2466 5.26012ZM4.71766 3.09213L3.14806 4.74462L4.23564 5.77765L5.80524 4.12516L4.71766 3.09213ZM9.1907 8.80507C8.64691 8.28856 8.64622 8.28929 8.64552 8.29002C8.64528 8.29028 8.64458 8.29102 8.64411 8.29152C8.64316 8.29254 8.64219 8.29357 8.64121 8.29463C8.63924 8.29675 8.6372 8.29896 8.6351 8.30127C8.63091 8.30588 8.62646 8.31087 8.62178 8.31625C8.61243 8.32701 8.60215 8.33931 8.59116 8.3532C8.56918 8.38098 8.54431 8.41512 8.51822 8.45588C8.46591 8.53764 8.40917 8.64531 8.36112 8.78033C8.26342 9.0549 8.21018 9.4185 8.27671 9.87257C8.40742 10.7647 8.99198 11.9644 10.5193 13.5724L11.6069 12.5394C10.1793 11.0363 9.82761 10.1106 9.76086 9.65511C9.72866 9.43536 9.76138 9.31957 9.77432 9.28321C9.78159 9.26277 9.78635 9.25709 9.78169 9.26437C9.77944 9.26789 9.77494 9.27451 9.76738 9.28407C9.76359 9.28885 9.75904 9.29437 9.7536 9.30063C9.75088 9.30375 9.74793 9.30706 9.74476 9.31056C9.74317 9.31231 9.74152 9.3141 9.73981 9.31594C9.73896 9.31686 9.73809 9.31779 9.7372 9.31873C9.73676 9.3192 9.73608 9.31992 9.73586 9.32015C9.73518 9.32087 9.7345 9.32159 9.1907 8.80507ZM10.5193 13.5724C12.0422 15.1757 13.1923 15.806 14.0698 15.9485C14.5201 16.0216 14.8846 15.9632 15.1606 15.8544C15.2955 15.8012 15.4022 15.7387 15.4823 15.6819C15.5223 15.6535 15.5556 15.6266 15.5824 15.6031C15.5959 15.5913 15.6077 15.5803 15.618 15.5703C15.6232 15.5654 15.628 15.5606 15.6324 15.5562C15.6346 15.554 15.6367 15.5518 15.6387 15.5497C15.6397 15.5487 15.6407 15.5477 15.6417 15.5467C15.6422 15.5462 15.6429 15.5454 15.6431 15.5452C15.6438 15.5444 15.6445 15.5437 15.1007 15.0272C14.5569 14.5107 14.5576 14.51 14.5583 14.5093C14.5585 14.509 14.5592 14.5083 14.5596 14.5078C14.5605 14.5069 14.5614 14.506 14.5623 14.5051C14.5641 14.5033 14.5658 14.5015 14.5674 14.4998C14.5708 14.4965 14.574 14.4933 14.577 14.4904C14.583 14.4846 14.5885 14.4796 14.5933 14.4754C14.6028 14.467 14.6099 14.4616 14.6145 14.4584C14.6239 14.4517 14.6229 14.454 14.6102 14.459C14.5909 14.4666 14.5 14.4987 14.3103 14.4679C13.9077 14.4025 13.0391 14.0472 11.6069 12.5394L10.5193 13.5724ZM8.98565 3.47663C7.97206 2.04305 5.94384 1.80119 4.71766 3.09213L5.80524 4.12516C6.32808 3.57471 7.24851 3.61795 7.76086 4.3426L8.98565 3.47663ZM3.75181 6.92574C3.73038 6.52644 3.90425 6.12654 4.23564 5.77765L3.14806 4.74462C2.61221 5.30877 2.20493 6.09246 2.25397 7.00613L3.75181 6.92574ZM18.4573 19.7375C18.1783 20.0313 17.8864 20.1887 17.6026 20.2167L17.7499 21.7095C18.497 21.6357 19.1016 21.2373 19.5449 20.7705L18.4573 19.7375ZM10.0213 9.01963C10.9889 8.00095 11.0574 6.40678 10.2466 5.26012L9.02185 6.12608C9.44399 6.72315 9.37926 7.51753 8.93372 7.9866L10.0213 9.01963ZM19.5092 15.962C20.33 16.4345 20.4907 17.5968 19.8779 18.2419L20.9655 19.2749C22.2704 17.901 21.8904 15.6019 20.2575 14.662L19.5092 15.962ZM16.1 15.0642C16.4854 14.6584 17.086 14.5672 17.5987 14.8623L18.347 13.5623C17.2485 12.93 15.8861 13.1113 15.0124 14.0312L16.1 15.0642Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </button>

                                <button type="button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-primary">
                                        <path
                                            d="M2 11.5C2 8.21252 2 6.56878 2.90796 5.46243C3.07418 5.25989 3.25989 5.07418 3.46243 4.90796C4.56878 4 6.21252 4 9.5 4C12.7875 4 14.4312 4 15.5376 4.90796C15.7401 5.07418 15.9258 5.25989 16.092 5.46243C17 6.56878 17 8.21252 17 11.5V12.5C17 15.7875 17 17.4312 16.092 18.5376C15.9258 18.7401 15.7401 18.9258 15.5376 19.092C14.4312 20 12.7875 20 9.5 20C6.21252 20 4.56878 20 3.46243 19.092C3.25989 18.9258 3.07418 18.7401 2.90796 18.5376C2 17.4312 2 15.7875 2 12.5V11.5Z"
                                            stroke="currentColor" stroke-width="1.5"></path>
                                        <path opacity="0.5"
                                            d="M17 9.50019L17.6584 9.17101C19.6042 8.19807 20.5772 7.7116 21.2886 8.15127C22 8.59094 22 9.67872 22 11.8543V12.1461C22 14.3217 22 15.4094 21.2886 15.8491C20.5772 16.2888 19.6042 15.8023 17.6584 14.8294L17 14.5002V9.50019Z"
                                            stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                </button>

                                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                    <button type="button"
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-[#f4f4f4] hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]"
                                        @click="toggle">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 rotate-90 opacity-70 hover:text-primary">
                                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5">
                                            </circle>
                                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                                stroke-width="1.5"></circle>
                                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5">
                                            </circle>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </template>
                <div class="relative h-full">
                    {{-- CHATTING USER NAME --}}
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <div class="relative flex-none">
                                <img src="{{asset('/images/avatar.png')}}"
                                    class="h-10 w-10 rounded-full object-cover sm:h-12 sm:w-12"
                                    src="assets/images/profile-16.jpeg">
                                <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                    <div class="h-4 w-4 rounded-full bg-success"></div>
                                </div>
                            </div>
                            <div class="mx-3">
                                <p class="font-semibold">Nia Hillyer</p>
                                <p class="text-xs text-white-dark">
                                    Active now</p>
                            </div>
                        </div>
                    </div>


                    {{-- CHAT DISPLAY --}}
                    <div class="perfect-scrollbar relative h-full overflow-auto sm:h-[calc(100vh_-_300px)]">
                        <div
                            class="chat-conversation-box min-h-[400px] space-y-5 p-4 pb-[68px] sm:min-h-[300px] sm:pb-0">
                            <div class="m-6 mt-0 block">
                                <h4 class="relative border-b border-[#f4f4f4] text-center text-xs dark:border-gray-800">
                                    <span class="relative top-2 bg-white px-3 dark:bg-[#0e1726]">Today, {{
                                        now()->format('h:i A') }}</span>
                                </h4>
                            </div>

                            <!-- Loop through the messages -->
                            @foreach($messages as $message)
                            <div class="flex items-start gap-3"
                                :class="{'justify-end' : selectedUser.userId === {{ $message->fromUserId }}}">
                                <div class="flex-none"
                                    :class="{'order-2' : selectedUser.userId === {{ $message->fromUserId }}}">
                                    <template x-if="selectedUser.userId === {{ $message->fromUserId }}">
                                        <img :src="`assets/images/{{ $loginUser->path }}`"
                                            class="h-10 w-10 rounded-full object-cover">
                                    </template>
                                    <template x-if="selectedUser.userId !== {{ $message->fromUserId }}">
                                        <img :src="`assets/images/{{ $selectedUser->path }}`"
                                            class="h-10 w-10 rounded-full object-cover">
                                    </template>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3">
                                        <div class="rounded-md bg-black/10 p-4 py-2 dark:bg-gray-800"
                                            :class="{{ $message->fromUserId == $selectedUser->userId ? 'ltr:rounded-br-none rtl:rounded-bl-none !bg-primary text-white' : 'ltr:rounded-bl-none rtl:rounded-br-none' }}"
                                            x-text="{{ json_encode($message->text) }}"></div>
                                        <div :class="{'hidden' : selectedUser.userId === {{ $message->fromUserId }}}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-primary">
                                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="1.5"></circle>
                                                <path
                                                    d="M9 16C9.85038 16.6303 10.8846 17 12 17C13.1154 17 14.1496 16.6303 15 16"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path
                                                    d="M16 10.5C16 11.3284 15.5523 12 15 12C14.4477 12 14 11.3284 14 10.5C14 9.67157 14.4477 9 15 9C15.5523 9 16 9.67157 16 10.5Z"
                                                    fill="currentColor"></path>
                                                <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="currentColor"></ellipse>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-xs text-white-dark"
                                        :class="{'ltr:text-right rtl:text-left' : selectedUser.userId === {{ $message->fromUserId }}}"
                                        x-text="{{ json_encode($message->created_at->diffForHumans()) }}"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SEND MESSAGE BUTTONS --}}
                    <div class="absolute bottom-0 left-0 w-full p-4">
                        <div class="w-full items-center space-x-3 rtl:space-x-reverse sm:flex">
                            <div class="relative flex-1">
                                <input id=""
                                    class="form-input rounded-full border-0 bg-[#f4f4f4] px-12 py-2 focus:outline-none"
                                    placeholder="Type a message" x-model="textMessage" @keyup.enter="sendMessage()">
                                <button type="button"
                                    class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:left-4 rtl:right-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="1.5"></circle>
                                        <path
                                            d="M9 16C9.85038 16.6303 10.8846 17 12 17C13.1154 17 14.1496 16.6303 15 16"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M16 10.5C16 11.3284 15.5523 12 15 12C14.4477 12 14 11.3284 14 10.5C14 9.67157 14.4477 9 15 9C15.5523 9 16 9.67157 16 10.5Z"
                                            fill="currentColor"></path>
                                        <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="currentColor"></ellipse>
                                    </svg>
                                </button>
                                <button type="button"
                                    class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:right-4 rtl:left-4"
                                    @click="sendMessage()">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <path
                                            d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                            stroke="currentColor" stroke-width="1.5"></path>
                                        <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <div class="hidden items-center space-x-3 py-3 rtl:space-x-reverse sm:block sm:py-0">
    <button type="button"
        class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <path
                d="M7 8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V11C17 13.7614 14.7614 16 12 16C9.23858 16 7 13.7614 7 11V8Z"
                stroke="currentColor" stroke-width="1.5"></path>
            <path opacity="0.5" d="M13.5 8L17 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path opacity="0.5" d="M13.5 11L17 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
            </path>
            <path opacity="0.5" d="M7 8L9 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path opacity="0.5" d="M7 11L9 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path opacity="0.5" d="M20 10V11C20 15.4183 16.4183 19 12 19M4 10V11C4 15.4183 7.58172 19 12 19M12 19V22"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M22 2L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="button"
        class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <path opacity="0.5"
                d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>
    <button type="button"
        class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <circle cx="12" cy="13" r="3" stroke="currentColor" stroke-width="1.5"></circle>
            <path opacity="0.5"
                d="M9.77778 21H14.2222C17.3433 21 18.9038 21 20.0248 20.2646C20.51 19.9462 20.9267 19.5371 21.251 19.0607C22 17.9601 22 16.4279 22 13.3636C22 10.2994 22 8.76721 21.251 7.6666C20.9267 7.19014 20.51 6.78104 20.0248 6.46268C19.3044 5.99013 18.4027 5.82123 17.022 5.76086C16.3631 5.76086 15.7959 5.27068 15.6667 4.63636C15.4728 3.68489 14.6219 3 13.6337 3H10.3663C9.37805 3 8.52715 3.68489 8.33333 4.63636C8.20412 5.27068 7.63685 5.76086 6.978 5.76086C5.59733 5.82123 4.69555 5.99013 3.97524 6.46268C3.48995 6.78104 3.07328 7.19014 2.74902 7.6666C2 8.76721 2 10.2994 2 13.3636C2 16.4279 2 17.9601 2.74902 19.0607C3.07328 19.5371 3.48995 19.9462 3.97524 20.2646C5.09624 21 6.65675 21 9.77778 21Z"
                stroke="currentColor" stroke-width="1.5"></path>
            <path d="M19 10H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
        </svg>
    </button>
    <button type="button"
        class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 opacity-70">
            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
        </svg>
    </button>
</div> --}}