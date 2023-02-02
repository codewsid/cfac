<div>
    <button @click="showNotification = true"
        class="inline-flex items-center text-sm font-medium text-center focus:outline-none" type="button">
        <svg class="w-7 h-7" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-current"
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
        </svg>
        <div class="flex relative">
            <div
                class="relative -top-2.5 right-3 h-5 w-5 p-[5px] text-sm bg-red-500 rounded-full text-white grid place-content-center">
                <span wire:poll>{{ auth()->user()->unreadNotifications->count() }}</span>
            </div>
        </div>
    </button>
    <div x-show="showNotification" @click.away="showNotification = false" x-cloak wire:ignore
        class="bg-white border absolute top-8 right-2 z-[99999] w-[27rem] rounded-md" x-data="{ tab: '#tab2' }">
        <div class="relative">
            <div class="bg-white fixed w-[27rem] pt-4 border-b border-r">
                <h1 class="font-bold pl-4">Notifications</h1>

                <!-- Tabs -->
                <div class="flex items-center pl-4 space-x-2 mt-2">
                    <a href="#" x-on:click.prevent="tab='#tab1'"
                        class="flex items-center space-x-1.5 px-1 py-1 border-black text-gray-500 hover:text-black transition"
                        x-bind:class="{ 'text-black font-bold border-b-2': tab === '#tab1' }">
                        <h1>All</h1>
                        <span x-bind:class="{ 'bg-black text-white font-semibold': tab === '#tab1' }"
                            class="bg-gray-100 text-gray-500 font-semibold text-xs px-1 rounded-md py-[1px]">
                            {{ auth()->user()->notifications->count() }}
                        </span>
                    </a>

                    <a href="#" x-on:click.prevent="tab='#tab2'"
                        class="flex items-center space-x-1.5 px-1 py-1 border-black text-gray-500 hover:text-black transition"
                        x-bind:class="{ 'text-black font-bold border-b-2': tab === '#tab2' }">
                        <span>Unread</span>
                        <span x-bind:class="{ 'bg-black text-white font-semibold': tab === '#tab2' }"
                            class="bg-gray-100 text-gray-500 font-semibold text-xs px-1 rounded-md py-[1px]">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>

                    <a href="#" x-on:click.prevent="tab='#tab3'"
                        class="px-3 py-1 text-gray-500 border-black hover:text-black transition"
                        x-bind:class="{ 'text-black font-bold border-b-2': tab === '#tab3' }">
                        <span>Read</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-20 max-h-[35rem] overflow-y-auto">
            <div x-show="tab == '#tab1'" x-cloak>
                @forelse (auth()->user()->notifications as $notification)
                    @if ($notification->read_at == null)
                        <button
                            wire:click="markAsRead('{{ $notification->id }}', '{{ $notification->data['feedbackId'] }}', '{{ $notification->data['senderId'] }}')"
                            class="flex items-start px-4 py-2.5 w-full space-x-2 border-b bg-kgreen/5">
                            <span class="rounded-full p-2.5 bg-kgreen/10 font-semibold">AH</span>

                            <section class="leading-5 text-left">
                                <h1 class="font-semibold text-sm">{{ $notification->data['message'] }}</h1>
                                <p class="text-sm text-gray-400">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}
                                    •
                                    <span
                                        class="
                                    {{ ($notification->data['feedbackType'] == 'Complaint'
                                            ? 'bg-red-100 text-red-500'
                                            : $notification->data['feedbackType'] == 'Compliment')
                                        ? 'bg-kgreen/10 text-kgreen'
                                        : 'bg-korange/10 text-korange' }} px-1 rounded-md">
                                        {{ $notification->data['feedbackType'] }}
                                    </span>
                                </p>
                            </section>
                        </button>
                    @else
                        <a href="{{ route('admin.feedback-info', ['id' => $notification->data['feedbackId']]) }}"
                            class="flex items-start px-4 py-2.5 w-full space-x-2 border-b">
                            <span class="rounded-full p-2.5 bg-kgreen/10 font-semibold">AH</span>

                            <section class="leading-5 text-left">
                                <h1 class="font-semibold text-sm">{{ $notification->data['message'] }}</h1>
                                <p class="text-sm text-gray-400">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}
                                    •
                                    <span
                                        class="
                                    {{ ($notification->data['feedbackType'] == 'Complaint'
                                            ? 'bg-red-100 text-red-500'
                                            : $notification->data['feedbackType'] == 'Compliment')
                                        ? 'bg-kgreen/10 text-kgreen'
                                        : 'bg-korange/10 text-korange' }} px-1 rounded-md">
                                        {{ $notification->data['feedbackType'] }}
                                    </span>
                                </p>
                            </section>
                        </a>
                    @endif
                @empty
                    <section class="py-7 text-center text-gray-500">No Notifications</section>
                @endforelse
            </div>

            <div x-show="tab == '#tab2'" x-cloak>
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <button
                        wire:click="markAsRead('{{ $notification->id }}', '{{ $notification->data['feedbackId'] }}', '{{ $notification->data['senderId'] }}')"
                        class="flex items-start px-4 py-2.5 w-full space-x-2 border-b bg-kgreen/5">
                        <span class="rounded-full p-2.5 bg-kgreen/10 font-semibold">AH</span>

                        <section class="leading-5 text-left">
                            <h1 class="font-semibold text-sm">{{ $notification->data['message'] }}</h1>
                            <p class="text-sm text-gray-400">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}
                                •
                                <span
                                    class="
                                    {{ ($notification->data['feedbackType'] == 'Complaint'
                                            ? 'bg-red-100 text-red-500'
                                            : $notification->data['feedbackType'] == 'Compliment')
                                        ? 'bg-kgreen/10 text-kgreen'
                                        : 'bg-korange/10 text-korange' }} px-1 rounded-md">
                                    {{ $notification->data['feedbackType'] }}
                                </span>
                            </p>
                        </section>
                    </button>
                @empty
                    <section class="py-7 text-center text-gray-500">No Notifications</section>
                @endforelse
            </div>

            <div x-show="tab == '#tab3'" x-cloak>
                @forelse (auth()->user()->readNotifications as $notification)
                    <a href="{{ route('admin.feedback-info', ['id' => $notification->data['feedbackId']]) }}"
                        class="flex items-start px-4 py-2.5 w-full space-x-2 border-b">
                        <span class="rounded-full p-2.5 bg-kgreen/10 font-semibold">AH</span>

                        <section class="leading-5 text-left">
                            <h1 class="font-semibold text-sm">{{ $notification->data['message'] }}</h1>
                            <p class="text-sm text-gray-400">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}
                                •
                                <span
                                    class="
                                    {{ ($notification->data['feedbackType'] == 'Complaint'
                                            ? 'bg-red-100 text-red-500'
                                            : $notification->data['feedbackType'] == 'Compliment')
                                        ? 'bg-kgreen/10 text-kgreen'
                                        : 'bg-korange/10 text-korange' }} px-1 rounded-md">
                                    {{ $notification->data['feedbackType'] }}
                                </span>
                            </p>
                        </section>
                    </a>
                @empty
                    <section class="py-7 text-center text-gray-500">No Notifications</section>
                @endforelse
            </div>

        </div>
    </div>
</div>

{{-- <a href="#" class="flex items-start px-4 py-2.5 w-full space-x-2 border-b">
    <span class="rounded-full p-2.5 bg-kgreen/10 font-semibold">AH</span>

    <section class="leading-5">
        <h1 class="font-semibold">New admin feedback</h1>
        <p class="text-sm text-gray-400">2h ago • <span
                class="bg-kgreen/10 text-kgreen px-1 rounded-md">Compliment</span> </p>
    </section>
</a> --}}

{{-- $notification->data['feedbackType'] == "Compliment" --}}
