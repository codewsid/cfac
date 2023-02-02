@extends('layouts.base-layout')

@section('body')
    <div class="flex items-start">
        @switch(auth()->user()->role)
            @case(1)
                <x-sidebars.admin-sidebar />
            @break

            @default
        @endswitch

        <!-- Main Page -->
        <div x-data="{ showNotification: false }" class="flex-1 {{ auth()->user()->role == 1 ? 'ml-[17rem]' : '' }} relative">
            @switch (auth()->user()->role == 1)
                @case(1)
                    <div
                        class="{{ request()->routeIs('admin.dashboard') ? 'bg-kgreen text-white' : 'bg-transparent' }} fixed top-0 right-0 left-[17rem] h-16 flex items-center justify-between px-5">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="fill-current" d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z" />
                                {{-- class="{{ request()->routeIs('admin.dashboard') ? 'text-white' : ''}}" --}}
                            </svg>
                        </button>

                        <div class="flex items-center mt-2 relative">
                            <livewire:notification />
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ asset('assets/admin-avatar.png') }}" alt="{{ Auth::user()->name }}" />
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition">
                                                    <div class="text-left text-black">
                                                        <h1 class="font-semibold"> {{ Auth::user()->first_name }}
                                                            {{ Auth::user()->last_name }}
                                                        </h1>
                                                        <p class="text-gray-500">{{ Auth::user()->types[0]->name }}</p>
                                                    </div>

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                @break

                @default
                    <nav class="text-white flex items-center justify-between lg:px-10 mx-auto mt-2.5">
                        <x-logo />

                        @if (auth()->user()->role == 2)
                            <div class="flex items-center">
                                <x-office-nav-link href="{{ route('office.main') }}" :active="request()->routeIs('office.main', 'office.details*')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                                        class="mr-2">
                                        <path class="fill-current"
                                            d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>
                                    {{ __('Feedbacks') }}
                                </x-office-nav-link>
                                <x-office-nav-link href="{{ route('office.staff-management') }}" :active="request()->routeIs('office.staff-management')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                                        class="mr-2">
                                        <path class="fill-current"
                                            d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>
                                    {{ __('Staff Management') }}
                                </x-office-nav-link>
                            </div>
                        @endif

                        <div class="flex items-center space-x-5 text-black">
                            <div class="mt-1">
                                <livewire:notification />
                            </div>
                            <x-jet-dropdown align="right" width="48" class="z-[99999]">
                                <x-slot name="trigger">

                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ asset('assets/placeholder-avatar.png') }}"
                                                alt="{{ Auth::user()->name }}" />
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition">
                                                    <div class="text-left text-black">
                                                        <h1 class="font-semibold"> {{ Auth::user()->first_name }}
                                                            {{ Auth::user()->last_name }}
                                                        </h1>
                                                        @if (auth()->user()->role == 2)
                                                            <p class="text-gray-500">{{ auth()->user()->manageBy->name }} Office
                                                            </p>
                                                        @else
                                                            <p class="text-gray-500">
                                                                {{ \App\Models\ClientType::find(session()->get('type'))->name }}
                                                            </p>
                                                        @endif
                                                    </div>

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </nav>
                @break
            @endswitch

            <main class="-z-50">
                {{ $slot }}
            </main>
        </div>
    </div>
@endsection
