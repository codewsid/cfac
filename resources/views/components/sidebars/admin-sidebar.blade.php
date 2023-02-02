<aside class="h-screen w-[17rem] fixed left-0 inset-y-0 border-r bg-white">
    <div class="mt-5 px-5 mb-10">
        <x-logo />
    </div>
    <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
        @if (request()->routeIs('admin.dashboard'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-1.5">
                <path class="fill-current" d="M3 3h8v8H3V3zm0 10h8v8H3v-8zM13 3h8v8h-8V3zm0 10h8v8h-8v-8z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-1.5">
                <path class="fill-current"
                    d="M3 3h8v8H3V3zm0 10h8v8H3v-8zM13 3h8v8h-8V3zm0 10h8v8h-8v-8zm2-8v4h4V5h-4zm0 10v4h4v-4h-4zM5 5v4h4V5H5zm0 10v4h4v-4H5z" />
            </svg>
        @endif

        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link href="{{ route('admin.offices') }}" :active="request()->routeIs('admin.offices')">
        @if (request()->routeIs('admin.offices'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-1.5">
                <path class="fill-current"
                    d="M21 19h2v2H1v-2h2V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v15h2V9h3a1 1 0 0 1 1 1v9zM7 11v2h4v-2H7zm0-4v2h4V7H7z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-1.5">
                <path class="fill-current"
                    d="M21 19h2v2H1v-2h2V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v15h4v-8h-2V9h3a1 1 0 0 1 1 1v9zM5 5v14h8V5H5zm2 6h4v2H7v-2zm0-4h4v2H7V7z" />
            </svg>
        @endif

        {{ __('Offices') }}
    </x-nav-link>

    <x-nav-link href="{{ route('admin.report') }}" :active="request()->routeIs('admin.report')">
        @if (request()->routeIs('admin.report'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-2">
                <path class="fill-current" d="M2 13h6v8H2v-8zM9 3h6v18H9V3zm7 5h6v13h-6V8z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-2">
                <path class="fill-current"
                    d="M2 13h6v8H2v-8zm14-5h6v13h-6V8zM9 3h6v18H9V3zM4 15v4h2v-4H4zm7-10v14h2V5h-2zm7 5v9h2v-9h-2z" />
            </svg>
        @endif
        {{ __('Reports') }}
    </x-nav-link>

    <section class="mt-5 border-t">
        <h1 class="text-sm text-gray-400 font-semibold px-5 py-1 uppercase">Feedbacks</h1>

        <x-nav-link href="{{ route('admin.feedback') }}" class="flex items-center justify-between" :active="request()->routeIs(
            'admin.feedback',
            'admin.edit-feedbacks*',
            'admin.office-replies',
            'admin.feedback-info*',
        )">
            <div class="flex items-center">
                @if (request()->routeIs('admin.feedback'))
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                        class="mr-2">
                        <path class="fill-current"
                            d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zM11 13v2h2v-2h-2zm0-6v5h2V7h-2z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                        class="mr-2">
                        <path class="fill-current"
                            d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zM4 18.385L5.763 17H20V5H4v13.385zM11 13h2v2h-2v-2zm0-6h2v5h-2V7z" />
                    </svg>
                @endif

                {{ __('Client Feedbacks') }}
            </div>
        </x-nav-link>

        {{-- <x-nav-link href="{{ route('admin.reply') }}" class="flex items-center justify-between" :active="request()->routeIs('admin.reply')">
            <div class="flex items-center">
                @if (request()->routeIs('admin.reply'))
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                        class="mr-2">
                        <path class="fill-current"
                            d="M8 18h10.237L20 19.385V9h1a1 1 0 0 1 1 1v13.5L17.545 20H9a1 1 0 0 1-1-1v-1zm-2.545-2L1 19.5V4a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1v12H5.455z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                        class="mr-2">
                        <path class="fill-current"
                            d="M5.455 15L1 18.5V3a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1v12H5.455zm-.692-2H16V4H3v10.385L4.763 13zM8 17h10.237L20 18.385V8h1a1 1 0 0 1 1 1v13.5L17.545 19H9a1 1 0 0 1-1-1v-1z" />
                    </svg>
                @endif
                {{ __('Feedback Replies') }}
            </div>
        </x-nav-link> --}}

        <x-nav-link href="{{ route('admin.criteria') }}" :active="request()->routeIs('admin.criteria')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mr-2">
                <path class="fill-current"
                    d="M11 4h10v2H11V4zm0 4h6v2h-6V8zm0 6h10v2H11v-2zm0 4h6v2h-6v-2zM3 4h6v6H3V4zm2 2v2h2V6H5zm-2 8h6v6H3v-6zm2 2v2h2v-2H5z" />
            </svg>
            {{ __('Criteria') }}
        </x-nav-link>
    </section>

    <section class="mt-5 border-t">
        <h1 class="text-sm text-gray-400 font-semibold px-5 py-1 uppercase">Account Management</h1>
        <x-nav-link href="{{ route('admin.admin-account') }}" :active="request()->routeIs('admin.admin-account')">
            @if (request()->routeIs('admin.admin-account'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm2.595 5.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 17a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                </svg>
            @endif
            {{ __('Administrator') }}
        </x-nav-link>

        <x-nav-link href="{{ route('admin.office-account') }}" :active="request()->routeIs('admin.office-account')">
            @if (request()->routeIs('admin.office-account'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M11 14.062V20h2v-5.938c3.946.492 7 3.858 7 7.938H4a8.001 8.001 0 0 1 7-7.938zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M4 22a8 8 0 1 1 16 0H4zm9-5.917V20h4.659A6.009 6.009 0 0 0 13 16.083zM11 20v-3.917A6.009 6.009 0 0 0 6.341 20H11zm1-7c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                </svg>
            @endif
            {{ __('Office Staff') }}
        </x-nav-link>

        <x-nav-link href="{{ route('admin.employee') }}" :active="request()->routeIs('admin.employee')">
            @if (request()->routeIs('admin.employee'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M16 2l5 5v14.008a.993.993 0 0 1-.993.992H3.993A1 1 0 0 1 3 21.008V2.992C3 2.444 3.445 2 3.993 2H16zm-4 9.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM7.527 17h8.946a4.5 4.5 0 0 0-8.946 0z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M15 4H5v16h14V8h-4V4zM3 2.992C3 2.444 3.447 2 3.999 2H16l5 5v13.993A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992zm9 8.508a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zM7.527 17a4.5 4.5 0 0 1 8.946 0H7.527z" />
                </svg>
            @endif
            {{ __('Employees') }}
        </x-nav-link>

        <x-nav-link href="{{ route('admin.client-account') }}" :active="request()->routeIs('admin.client-account')">
            @if (request()->routeIs('admin.client-account'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M4 22a8 8 0 1 1 16 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                </svg>
            @endif
            {{ __('Clients') }}
        </x-nav-link>

        {{-- <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf

            <x-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
                    class="mr-2">
                    <path class="fill-current"
                        d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3h-2V4H6v16h12v-2h2v3a1 1 0 0 1-1 1H5zm13-6v-3h-7v-2h7V8l5 4-5 4z" />
                </svg>
                {{ __('Logout') }}
            </x-nav-link>
        </form> --}}

    </section>
</aside>
