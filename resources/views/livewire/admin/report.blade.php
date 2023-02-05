<div class="px-5 mt-16 -z-40">
    <div>

        <x-title-heading title="Reports" class="text-gray-700" />

        <div class="flex items-center space-x-3 mt-3">
            <section
                class="bg-white border hover:border-kgreen hover:shadow transition rounded-md flex items-start justify-between p-3 w-[20rem]">
                <div>
                    <h1 class="font-semibold text-gray-700 text-xl">List of Clients</h1>
                    <h2 class="text-kgreen font-medium">1,925</h2>
                </div>
                <button wire:click="exportClientList" class="text-kgreen">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path class="fill-current"
                            d="M2.859 2.877l12.57-1.795a.5.5 0 0 1 .571.495v20.846a.5.5 0 0 1-.57.495L2.858 21.123a1 1 0 0 1-.859-.99V3.867a1 1 0 0 1 .859-.99zM4 4.735v14.53l10 1.429V3.306L4 4.735zM17 19h3V5h-3V3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-4v-2zm-6.8-7l2.8 4h-2.4L9 13.714 7.4 16H5l2.8-4L5 8h2.4L9 10.286 10.6 8H13l-2.8 4z" />
                    </svg>
                </button>
            </section>
            <section
                class="bg-white border hover:border-kgreen hover:shadow transition rounded-md flex items-start justify-between p-3 w-[20rem]">
                <div>
                    <h1 class="font-semibold text-gray-700 text-xl">List of Offices</h1>
                    <h2 class="text-kgreen font-medium">1,925</h2>
                </div>
                <button wire:click="exportOfficeList" class="text-kgreen">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path class="fill-current"
                            d="M2.859 2.877l12.57-1.795a.5.5 0 0 1 .571.495v20.846a.5.5 0 0 1-.57.495L2.858 21.123a1 1 0 0 1-.859-.99V3.867a1 1 0 0 1 .859-.99zM4 4.735v14.53l10 1.429V3.306L4 4.735zM17 19h3V5h-3V3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-4v-2zm-6.8-7l2.8 4h-2.4L9 13.714 7.4 16H5l2.8-4L5 8h2.4L9 10.286 10.6 8H13l-2.8 4z" />
                    </svg>
                </button>
            </section>
            <section
                class="bg-white border hover:border-kgreen hover:shadow transition rounded-md flex items-start justify-between p-3 w-[20rem]">
                <div>
                    <h1 class="font-semibold text-gray-700 text-xl">Feedback Forms</h1>
                    <h2 class="text-kgreen font-medium">1,925</h2>
                </div>


                <button wire:click.prevent="viewPDFReport" type="submit"
                    class="text-red-500 flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path class="fill-current"
                            d="M12 16H8V8h4a4 4 0 1 1 0 8zm-2-6v4h2a2 2 0 1 0 0-4h-2zm5-6H5v16h14V8h-4V4zM3 2.992C3 2.444 3.447 2 3.999 2H16l5 5v13.993A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992z" />
                    </svg>

                </button>
            </section>
            {{-- <livewire:admin.generate-p-d-f /> --}}
        </div>
    </div>
</div>