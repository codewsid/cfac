<div class="max-w-[95%] mx-auto sm:px-6 lg:px-0 mt-3">
    <div class='bg-white border rounded-md p-2 px-3 flex items-center'>
        <div class="flex items-center pl-3 rounded-md bg-zinc-100 border mr-2">
            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" class='fill-current text-zinc-500'
                    d="M3 7.99414C3 7.72892 3.10536 7.47457 3.29289 7.28703C3.48043 7.0995 3.73478 6.99414 4 6.99414H20C20.2652 6.99414 20.5196 7.0995 20.7071 7.28703C20.8946 7.47457 21 7.72892 21 7.99414C21 8.25936 20.8946 8.51371 20.7071 8.70125C20.5196 8.88878 20.2652 8.99414 20 8.99414H4C3.73478 8.99414 3.48043 8.88878 3.29289 8.70125C3.10536 8.51371 3 8.25936 3 7.99414ZM6 12.9941C6 12.7289 6.10536 12.4746 6.29289 12.287C6.48043 12.0995 6.73478 11.9941 7 11.9941H17C17.2652 11.9941 17.5196 12.0995 17.7071 12.287C17.8946 12.4746 18 12.7289 18 12.9941C18 13.2594 17.8946 13.5137 17.7071 13.7012C17.5196 13.8888 17.2652 13.9941 17 13.9941H7C6.73478 13.9941 6.48043 13.8888 6.29289 13.7012C6.10536 13.5137 6 13.2594 6 12.9941ZM9 17.9941C9 17.7289 9.10536 17.4746 9.29289 17.287C9.48043 17.0995 9.73478 16.9941 10 16.9941H14C14.2652 16.9941 14.5196 17.0995 14.7071 17.287C14.8946 17.4746 15 17.7289 15 17.9941C15 18.2594 14.8946 18.5137 14.7071 18.7012C14.5196 18.8888 14.2652 18.9941 14 18.9941H10C9.73478 18.9941 9.48043 18.8888 9.29289 18.7012C9.10536 18.5137 9 18.2594 9 17.9941Z"
                    fill="black" />
            </svg>
            <select wire:model="typeId"
                class='bg-transparent cursor-pointer border-transparent focus:border-transparent focus:ring-0 py-2.5'>
                <option value="" class='bg-white'>All feedbacks</option>
                {{-- @foreach ($feedbackTypes as $type)
                <option value="{{ $type->id }}" class='bg-white'>{{ $type->name }}</option>
                @endforeach --}}
            </select>
        </div>

        <div class='border rounded-md px-2 flex items-center flex-1 text-black'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" wire:model.debounce.300ms="search"
                placeholder="Search 'keyword' or 'term' in your recent feedbacks"
                class='border-transparent focus:border-transparent focus:ring-0 w-full placeholder:text-gray-400 py-2.5' />
        </div>
    </div>


    <div class='mt-3 bg-white border rounded-md'>
        <div class="px-4 pb-4 sm:px-6 lg:px-4">
            <div class="mt-4 flex flex-col">

                <h1 class='font-head font-semibold text-xl mb-2 uppercase'>Recent feedbacks</h1>

                <div class="flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 bg-white">
                                <thead>
                                    <tr class="bg-kgreen">
                                        <th scope="col"
                                            class="py-4 text-left text-sm font-semibold text-white pl-5 w-[20rem]">
                                            Feedback Type
                                        </th>
                                        <th scope="col" class="py-4 text-left text-sm font-semibold text-white mr-3">
                                            Comment
                                        </th>
                                        <th scope="col"
                                            class="py-4 text-left text-sm font-semibold text-white pl-14 w-[12rem]">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($feedbacks as $feedback)
                                        <tr class="odd:bg-white even:bg-gray-100/50">
                                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600 pl-5">
                                                @if ($feedback->feedback_type_id == 1)
                                                    <h1 class="font-semibold ">
                                                        <span
                                                            class="bg-red-100 text-red-500 text-md font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-text-red-100 dark:text-red-500">Complaint</span>
                                                    </h1>
                                                @elseif ($feedback->feedback_type_id == 2)
                                                    <h1 class="font-semibold ">
                                                        <span
                                                            class="bg-kgreen/10 text-kgreen text-md font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-cgreen/10 dark:text-cgreen">Compliment</span>
                                                    </h1>
                                                @else
                                                    <h1 class="font-semibold ">
                                                        <span
                                                            class="bg-korange/10 text-korange text-md font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-corange/10 dark:text-corange">Suggestion</span>
                                                    </h1>
                                                @endif
                                                <span
                                                    class="text-xs text-gray-400">{{ $feedback->created_at->format('F d, Y h:i A') }}</span>
                                            </td>
                                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                                @if ($feedback->edited)
                                                    {{ $feedback->edited->edited_comment }}
                                                @else
                                                    {{ $feedback->comment }}
                                                @endif
                                            </td>
                                            <td
                                                class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600 pl-14 pr-5 flex items-center space-x-2">
                                                <button type="submit" wire:click="viewDetails({{ $feedback->id }})"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-kgreen px-2.5 py-1.5 text-sm font-medium leading-4 text-white shadow-sm hover:bg-cgreen/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    <span>View Details</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <x-no-data-found colspan="9" />
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="mt-2">
                        {{ $feedbacks->links('custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
