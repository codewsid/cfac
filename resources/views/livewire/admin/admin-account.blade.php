<div class="px-5 mt-16" x-data="{ modal : @entangle('adminModal')}">

    {{-- <x-title-heading title="Feedbacks" class="text-gray-700" /> --}}
    <div class="flex items-center justify-between mt-5">
        <x-search-input wire:model="search" placeholder="admin user" />
        <div class="space-x-1">
            <x-page-button @click="modal = true" textValue="Add new admin" class="bg-kgreen text-white" />
        </div>

    </div>

    <div class="mt-5 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300 bg-white">
                    <thead>
                        <tr class="bg-kgreen">
                            <th scope="col" class="py-4 uppercase text-left text-sm font-semibold text-white pl-5 w-[30rem]">
                                Full name
                            </th>
                            <th scope="col" class="py-4 uppercase text-left text-sm font-semibold text-white">
                                Email
                            </th>
                            <th scope="col" class="py-4 uppercase text-left text-sm font-semibold text-white">Email
                                Verification
                            </th>
                            <th scope="col" class="py-4 uppercase text-left text-sm font-semibold text-white w-40">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($admins as $admin)
                            <tr class="odd:bg-white even:bg-gray-100/50">
                                <td class="whitespace-nowrap py-3 font-semibold text-gray-600 pl-5">
                                    {{ $admin->first_name }} {{ $admin->last_name }}
                                </td>
                                <td class="whitespace-nowrap py-3 font-semibold text-gray-600">{{ $admin->email }}
                                </td>
                                <td class="whitespace-nowrap py-3 font-semibold text-gray-600">
                                    @if ($admin->email_verified_at == null)
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-gray-600 bg-gray-100 rounded-full">Unverified</span>
                                    @else
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-kgreen bg-kgreen/10 rounded-full">Verified</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap py-3 font-semibold text-gray-600 space-x-2">
                                    <x-action-button class="hover:text-kgreen">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                            <path class="fill-current"
                                                d="M15.728 9.686l-1.414-1.414L5 17.586V19h1.414l9.314-9.314zm1.414-1.414l1.414-1.414-1.414-1.414-1.414 1.414 1.414 1.414zM7.242 21H3v-4.243L16.435 3.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 21z" />
                                        </svg>
                                    </x-action-button>
                                    <x-action-button class="hover:text-kgreen">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                            <path class="fill-current"
                                                d="M14 14.252v2.09A6 6 0 0 0 6 22l-2-.001a8 8 0 0 1 10-7.748zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm6.586 6l-1.829-1.828 1.415-1.415L22.414 18l-4.242 4.243-1.415-1.415L18.586 19H15v-2h3.586z" />
                                        </svg>
                                    </x-action-button>
                                    <x-action-button wire:click.prevent="removeAssignedUser()" class="hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                            <path class="fill-current"
                                                d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-4.586 6l1.768 1.768-1.414 1.414L12 15.414l-1.768 1.768-1.414-1.414L10.586 14l-1.768-1.768 1.414-1.414L12 12.586l1.768-1.768 1.414 1.414L13.414 14zM9 4v2h6V4H9z" />
                                        </svg>
                                    </x-action-button>
                                </td>
                            </tr>
                        @empty
                            <x-no-data-found colspan="4" />
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        <div class="mt-2">
            {{ $admins->links('custom-pagination') }}
        </div>

    <!-- Criteria Modal -->
    <x-modal headTitle="Make new admin" modalAction="modal" x-cloak>
        <div class="space-y-2.5">
            <x-group-input model="first_name" label="First Name" placeholder="Enter first name" name="first_name" />
            <x-group-input model="last_name" label="Last Name" placeholder="Enter last name" name="last_name" />
            <x-group-input type="email" model="email" label="Email Address" placeholder="Enter valid email address"
                name="email" />
        </div>

        <div class="mt-5 flex items-center justify-end space-x-2">
            <x-page-button @click="modal = false" textValue="Cancel" class="text-gray-600 border" />
            <x-modal-button wire:click.prevent="saveAdmin()" type="submit" textValue="Save admin"
                class="bg-kgreen hover:bg-kgreen/90 text-white" wire:loading.attr="disabled" />
        </div>
    </x-modal>
</div>