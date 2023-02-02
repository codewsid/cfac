<div class="max-w-[95%] mx-auto sm:px-6 lg:px-0 mt-5">
    <div class='mt-3 bg-white border rounded-md'>
        <div class="px-4 pb-4 sm:px-6 lg:px-4">
            <div class="mt-4 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h1 class='font-head font-semibold text-xl uppercase'>Staff Management</h1>
                    <div class='border rounded-md px-2 flex items-center text-black'>
                        <input type="text" wire:model.debounce.300ms="" placeholder="Search staff information"
                            class='border-transparent focus:border-transparent focus:ring-0 placeholder:text-gray-400 py-2 w-[20rem]' />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>

                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class='bg-kgreen'>
                                <tr>
                                    <th scope="col"
                                        class="text-white uppercase py-3.5 pl-4 pr-3 text-left text-sm font-semibold sm:pl-6 md:pl-5 w-[20rem]">
                                        Full Name
                                    </th>
                                    <th scope="col"
                                        class="text-white uppercase py-3.5 px-3 text-left text-sm font-semibold w-[7rem]">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="text-white uppercase py-3.5 px-3 text-left text-sm font-semibold w-[7rem]">
                                        Added on
                                    </th>
                                    <th scope="col"
                                        class="text-white uppercase py-3.5 pr-10 text-right text-sm font-semibold w-[10rem]">
                                        Email Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($staffs as $staff)
                                    <tr class='odd:bg-white even:bg-gray-50'>
                                        <td
                                            class="whitespace-wrap py-4 pl-4 pr-3 text-sm font-semibold sm:pl-6 md:pl-5">
                                            {{ $staff->first_name . ' ' . $staff->last_name }}
                                        </td>
                                        <td class="whitespace-wrap py-4 px-3 text-sm">
                                            {{ $staff->email }}
                                        </td>
                                        <td class="whitespace-wrap py-4 px-3 text-sm">
                                            {{ $staff->created_at->format('F d, Y') }}
                                        </td>
                                        <td class="whitespace-wrap py-4 pr-10 text-sm text-gray-900 text-right">
                                            <span
                                                class="{{ $staff->email_verified_at ? 'text-kgreen bg-kgreen/10' : 'text-gray-600 bg-gray-100' }} inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none rounded-full">{{ $staff->email_verified_at ? 'verified' : 'unverified' }}</span>
                                        </td>
                                    </tr>

                                @empty
                                    <tr class='bg-gray-50'>
                                        <td class="whitespace-wrap py-4 pl-4 pr-3 text-gray-900 sm:pl-6 md:pl-5 text-center"
                                            colspan="6">
                                            <h1 class="text-zinc-500">No feedback yet</h1>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="mt-2">
        {{ $feedbacks->links('custom-pagination') }}
</div> --}}
</div>
