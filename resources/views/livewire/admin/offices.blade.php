<div x-data="{ openModal: @entangle('addOfficeModal'), updateOffice: @entangle('updateOfficeModal') }">
    <div class="px-5 mt-16">
        <div>
            <div class="bg-white p-5 rounded-md border">
                <div class="flex items-center justify-between">
                    <x-title-heading title="Offices" class="text-gray-700" />
                    <x-page-button @click="openModal = true" textValue="Add office"
                        class="bg-kgreen hover:bg-kgreen/90 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path class="fill-current" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" />
                        </svg>
                    </x-page-button>
                </div>

                <div class="mt-5 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 bg-white">
                                <thead>
                                    <tr class="bg-kgreen uppercase">
                                        <th scope="col"
                                            class="py-3 text-left text-sm font-bold text-white pl-5 w-[5rem]">ID</th>
                                        <th scope="col"
                                            class="py-3 text-left text-sm font-bold text-white w-[30rem]">Office Name
                                        </th>
                                        <th scope="col"
                                            class="py-3 text-left text-sm font-bold text-white w-[30rem]">Manage By</th>
                                        <th scope="col"
                                            class="py-3 text-right text-sm font-bold text-white w-[10rem] pr-20">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($offices as $office)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-3 text-base font-semibold text-gray-600 pl-5">
                                                {{ $office->id }}
                                            </td>
                                            <td class="whitespace-nowrap py-3 text-base font-semibold text-gray-600">
                                                {{ $office->name }}
                                            </td>
                                            <td class="whitespace-nowrap py-3 text-base font-semibold text-gray-600">
                                                @if ($office->manageBy)
                                                    <span>{{ $office->manageBy->first_name . ' ' . $office->manageBy->last_name }}</span>
                                                @else
                                                    <span class="text-gray-400 font-normal">No assigned yet</span>
                                                @endif
                                            </td>
                                            <td
                                                class="py-3 text-base text-gray-600 pr-20 flex items-center justify-end space-x-1.5">
                                                <x-action-button wire:click="editOffice({{ $office->id }})"
                                                    class="hover:text-kgreen">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="20" height="20">
                                                        <path class="fill-current"
                                                            d="M15.728 9.686l-1.414-1.414L5 17.586V19h1.414l9.314-9.314zm1.414-1.414l1.414-1.414-1.414-1.414-1.414 1.414 1.414 1.414zM7.242 21H3v-4.243L16.435 3.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 21z" />
                                                    </svg>
                                                </x-action-button>
                                                {{-- <x-action-button wire:click.prevent="deleteOffice({{ $office->id }})"
                                                    class="hover:text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="20" height="20">
                                                        <path class="fill-current"
                                                            d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-4.586 6l1.768 1.768-1.414 1.414L12 15.414l-1.768 1.768-1.414-1.414L10.586 14l-1.768-1.768 1.414-1.414L12 12.586l1.768-1.768 1.414 1.414L13.414 14zM9 4v2h6V4H9z" />
                                                    </svg>
                                                </x-action-button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <x-no-data-found colspan="5" />
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Criteria Modal -->
        <x-modal headTitle="Add Office" modalAction="openModal">
            <form>
                <div class="space-y-2.5">
                    <x-group-input model="officeName" label="Office Name" placeholder="Enter office name"
                        name="office" />
                </div>

                <div class="mt-5 flex items-center justify-end space-x-2">
                    <x-page-button @click="openModal = false" textValue="Cancel" class="text-gray-600 border" />
                    <x-modal-button wire:click.prevent="saveOffice" type="submit" textValue="Save Office"
                        class="bg-kgreen hover:bg-kgreen/90 text-white" wire:loading.attr="disabled" />
                </div>
            </form>
        </x-modal>

        <x-modal headTitle="Update Office" modalAction="updateOffice">
            <form>
                <div class="space-y-2.5">
                    <x-group-input model="officeName" label="Office Name" placeholder="Enter office name"
                        name="office" />
                </div>

                <div class="mt-5 flex items-center justify-end space-x-2">
                    <x-page-button @click="updateOffice = false" textValue="Cancel" class="text-gray-600 border" />
                    <x-modal-button wire:click.prevent="updateOffice" type="submit" textValue="Update Office"
                        class="bg-kgreen hover:bg-kgreen/90 text-white" wire:loading.attr="disabled" />
                </div>
            </form>
        </x-modal>
    </div>

</div>
