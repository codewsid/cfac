<x-guest-layout>
    <div class="w-full h-screen flex relative">

        <!-- BG Image -->
        <div class='fixed -bottom-[10rem] -left-[15rem] -z-50 opacity-[5%]'>
            <img src="{{ asset('/assets/images/logo-with-deer.png') }}" alt="sksu logo with deer" class='h-[40rem]'>
        </div>

        <div class='flex w-full'>
            <div class='w-3/5 h-full px-20 py-10'>
                <div>
                    <x-logo />
                    <h1 class="mt-1 font-semibold text-lg">Client Feedback and Complaint Web-based Mechanism</h1>
                </div>

                <div class='lg:mt-20'>
                    <x-title-heading title="Login with your account" class="text-gray-700 text-2xl" />
                    <p>If you have an account, you can login with it.</p>
                </div>

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mt-10">
                        <x-jet-label for="clientType" value="{{ __('User Role') }}" />
                        <select name="clientType" id="clientType"
                            class="w-full rounded-md border-gray-300 mt-1 bg-zinc-100">
                            @foreach (\App\Models\ClientType::all() as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                                @if ($type->id == 2)
                                Staff
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required
                            autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <div class='mt-5 space-y-3.5'>
                        <button type='submit' class="bg-kgreen text-white py-3 w-full rounded-md font-medium">Continue
                            Login</button>

                        <h1 class='text-zinc-500 font-medium'>
                            Don't have an account?
                            <span class='text-kgreen hover:underline'><a href="{{ route('register') }}">Sign
                                    up</a></span>
                        </h1>
                    </div>
                </form>
            </div>
            <div class='bg-kgreen w-4/5 h-full overflow-hidden relative p-10 z-50'>
                <div class="-z-10">
                    <!-- Middle right -->
                    <svg width="512" height="478" viewBox="0 0 512 478" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class='absolute top-0 -right-[20rem] opacity-50'>
                        <path
                            d="M360.519 450.451C408.152 434.781 469.569 429.943 492.834 385.523C516.42 340.491 469.944 288.359 472.02 237.567C474.107 186.491 530.64 135.103 504.872 90.9551C479.148 46.8824 409.421 64.5585 361.235 47.7591C321.022 33.7398 287.759 -3.28543 245.339 0.472698C202.771 4.24381 170.71 38.712 139.074 67.4417C109.108 94.6557 87.8603 127.447 67.1936 162.254C41.0983 206.204 -11.3123 248.499 2.32127 297.761C16.0311 347.297 87.5649 349.879 127.928 381.702C163.685 409.893 181.613 460.633 225.278 473.54C270.042 486.771 316.178 465.038 360.519 450.451Z"
                            fill="#00A340" />
                    </svg>

                    <!-- Bottom right -->
                    <svg width="475" height="540" viewBox="0 0 475 540" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class='absolute -bottom-[22rem] -right-[10rem] opacity-70'>
                        <path
                            d="M249.988 538.679C297.013 534.764 333.978 500.872 372.408 473.491C409.041 447.391 452.517 424.85 468.67 382.871C484.574 341.54 465.811 296.648 457.167 253.214C448.997 212.161 441.611 171.648 419.554 136.073C394.565 95.7696 364.564 57.9357 322.506 36.0287C275.1 11.3352 220.043 -8.66284 168.439 5.27066C116.566 19.2767 80.5151 65.4717 49.9086 109.633C21.6041 150.473 4.83362 197.648 0.785117 247.172C-3.09688 294.655 7.67161 341.29 27.4261 384.643C47.1931 428.023 74.5276 467.9 113.727 495.029C153.755 522.733 201.476 542.718 249.988 538.679Z"
                            fill="#00A340" />
                    </svg>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg isolate">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" wire:poll>
                        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white">
                            <div class="flex items-start justify-between">
                                <div>
                                    <x-title-heading title="SKSU Offices Statistics" class="text-gray-800" />

                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                        These are the list of offices ranked base on their received feedbacks.
                                    </p>
                                </div>
                                <button x-on:click="window.location.reload()"
                                    class="flex items-center space-x-2 text-sm border rounded-md p-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <span>Refresh page</span>
                                </button>
                            </div>
                        </caption>

                        <thead class="text-xs uppercase bg-kgreen text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Office Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Compliments
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Suggestions
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Complaints
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach (\App\Models\Office::with('feedbacks')->get()
                            ->sortByDesc(function ($office) {
                            return $office->feedbacks->where('feedback_type_id', 2)->count();
                            })
                            as $officeFeedbackStats)
                            {{-- ->sortByDesc(function ($office) {
                            return $office->feedbacks->where('feedback_type_id', 3)->count();
                            })
                            ->sortByDesc(function ($office) {
                            return $office->feedbacks->where('feedback_type_id', 1)->count();
                            }) --}}
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                    {{ $officeFeedbackStats->name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $officeFeedbackStats->feedbacks->where('feedback_type_id', 2)->count() }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $officeFeedbackStats->feedbacks->where('feedback_type_id', 3)->count() }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $officeFeedbackStats->feedbacks->where('feedback_type_id', 1)->count() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>