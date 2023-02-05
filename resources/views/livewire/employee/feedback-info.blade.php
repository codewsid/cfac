<div class="px-5 mt-5">
    <a href="{{ route('office.main') }}" class="inline-flex items-center space-x-2 bg-kgreen text-white rounded-md p-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
            <path class="fill-current" d="M7.828 11H20v2H7.828l5.364 5.364-1.414 1.414L4 12l7.778-7.778 1.414 1.414z" />
        </svg>
        <span class="pr-1.5">Go Back</span>
    </a>
    <div>
        <div class="flex items-start">
            <div class="mt-3">
                <h1 class="font-semibold text-base">Feedback Details:</h1>
                <div class="flex items-start space-x-3 mt-2 ml-3 border-l-2 border-kgreen px-3 mb-5">
                    <ul class="space-y-1">
                        <li class="text-gray-600">From: </li>
                        <li class="text-gray-600">Type: </li>
                        <li class="text-gray-600">Comment: </li>
                        <li class="text-gray-600">Status: </li>
                    </ul>
                    <ul class="space-y-1">
                        @foreach ($feedbackInfo as $info)
                        <li class="font-semibold">
                            Forwarded by Admin
                        </li>
                        <li class="font-semibold">
                            @if ($info->feedback_type_id == 1)
                            <span
                                class="bg-red-100 text-red-500 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-100 dark:text-red-500">Complaint</span>
                            @elseif ($info->feedback_type_id == 2)
                            <span
                                class="bg-kgreen/10 text-kgreen text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-kgreen/10 dark:text-kgreen">Compliment</span>
                            @else
                            <span
                                class="bg-korange/10 text-korange text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-korange/10 dark:text-korange">Suggestion</span>
                            @endif
                        </li>
                        <li class="font-semibold">
                            @if ($info->edited)
                            {{ $info->edited->edited_comment }}
                            @else
                            {{ $info->comment }}
                            @endif
                        </li>
                        <li class="text-korange">{{ $info->status->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-2 ml-[20rem]">
                <h1 class="font-semibold text-base">Feedback Rating:</h1>
                <div class="flex items-start space-x-5 mt-2 mb-5">
                    <ul class="space-y-1">
                        @foreach ($ratings as $rating)
                        @foreach ($rating->criteria as $criteria)
                        <li class="text-gray-600">{{ $criteria->name }}:</li>
                        @endforeach
                        @endforeach
                    </ul>
                    <ul class="space-y-1">
                        @foreach ($ratings as $rating)
                        <li class="font-semibold">{{ $rating->value }} / {{ $ratings->count() }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        @php
        foreach ($feedbackInfo as $info) {
        if ($info->edited) {
        $showTextArea = true;
        } else {
        $showTextArea = false;
        }
        }
        @endphp

        @if ($showTextArea)
        <div>
            <h1 class="mb-1">Write your reply below</h1>
            <form wire:submit.prevent="sendReply" class="w-full inline-flex flex-col">
                @csrf
                <textarea wire:model="comment" placeholder="Your reply here..." rows="5"></textarea>
                <div class="flex items-center justify-end space-x-3">
                    <button type="submit"
                        class="{{ $feedbackStatus == 6 || $feedbackStatus == 7 ? 'bg-gray-400' : 'bg-kgreen' }} px-3 py-2 text-white rounded-md mt-5"
                        {{ $feedbackStatus==6 || $feedbackStatus==7 ? 'disabled' : ''
                        }}>{{ $feedbackStatus == 6 || $feedbackStatus == 7 ? "You've sent reply already" : 'Send Reply and Complete' }}</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>