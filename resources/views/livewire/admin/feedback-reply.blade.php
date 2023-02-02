<div class="px-5 mt-16">
    <div>

        <div class="flex items-center justify-between">
            <x-title-heading title="Feedbacks" class="text-gray-700" />
            <x-search-input placeholder="keywords" />
        </div>
        <div class="mt-3 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300 bg-white">
                        <thead>
                            <tr class="bg-kgreen">
                                <th scope="col"
                                    class="py-4 text-left text-sm font-semibold text-white pl-5 w-[13rem]">Feedback
                                    Type</th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[13rem]">
                                    Personnel
                                    Involved</th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white">Comment</th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[4rem]">FS
                                </th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[4rem]">GS
                                </th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[4rem]">RE
                                </th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[4rem]">GC/U
                                </th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white w-[4rem]">JK
                                </th>
                                <th scope="col" class="py-4 text-left text-sm font-semibold text-white pl-14">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <x-no-data-found colspan="9" />
                            {{-- @forelse ($feedbacks as $feedback)
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
                                                    class="bg-cgreen/10 text-red-500 text-md font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-cgreen/10 dark:text-cgreen">Compliment</span>
                                            </h1>
                                            @else
                                            <h1 class="font-semibold ">
                                                <span
                                                    class="bg-corange/10 text-corange text-md font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-corange/10 dark:text-corange">Suggestion</span>
                                            </h1>
                                            @endif
                                            <span class="text-xs text-gray-400">{{ $feedback->created_at }}</span>
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600 space-y1">
                                <h1><span class="text-gray-400">From: </span> {{ $feedback->user->type }}</h1>
                                <h1><span class="text-gray-400">To: </span> {{ $feedback->office->office_name }} Office</h1>
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">{{ $feedback->comment }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                {{ $feedback->fast_service }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                {{ $feedback->good_service }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                {{ $feedback->respectable_emloyee }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                {{ $feedback->good_and_clean }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600">
                                {{ $feedback->job_knowledge }}
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600 pl-10">
                                <a href="/feedbacks/edit-feedback/{{ $feedback->id }}" class="hover:text-cgreen">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-2 text-sm font-semibold text-gray-600 pl-14">
                                <button wire:key="{{ $feedback->id }}"
                                    wire:click.prevent="forwardFeedbackTo({{ $feedback->id }})" wire:loading.attr="disabled"
                                    class="inline-flex items-center rounded-md border border-transparent bg-cgreen px-2.5 py-1.5 text-sm font-medium leading-4 text-white shadow-sm hover:bg-cgreen/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span>Forward</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                                        class="ml-2">
                                        <path class="fill-current"
                                            d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zM4 18.385L5.763 17H20V5H4v13.385zM12 10V7l4 4-4 4v-3H8v-2h4z" />
                                    </svg>
                                </button>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-gray-400">No feedback data</td>
                            </tr>
                            @endforelse --}}
                        </tbody>
                    </table>

                </div>
            </div>
            {{-- <div class="mt-2">
                        {{ $feedbacks->links('custom-pagination') }}
        </div> --}}
        </div>

    </div>
</div>
