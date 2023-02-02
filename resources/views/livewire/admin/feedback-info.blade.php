<div class="px-5 mt-16" x-data="{ modal: @entangle('sendEmailModal') }">
    <div>
        <div class="flex items-start">
            <div class="mt-3">
                <h1 class="font-semibold text-base">Feedback Details:</h1>
                <div class="flex items-start space-x-3 mt-2 ml-3 border-l-2 border-kgreen px-3 mb-5">
                    <ul class="space-y-1">
                        <li class="text-gray-600">From: </li>
                        <li class="text-gray-600">To: </li>
                        <li class="text-gray-600">Type: </li>
                        <li class="text-gray-600">Comment: </li>
                        <li class="text-gray-600">Status: </li>
                    </ul>
                    <ul class="space-y-1">
                        @foreach ($feedbackInfo as $info)
                            <li class="font-semibold">
                                {{ $info->user->email }} -
                                <span class="text-sm text-kgreen">{{ $info->clientType->name }}</span>
                            </li>

                            @if ($info->office_id)
                                <li class="font-semibold">{{ $info->office->name }} Office</li>
                            @elseif ($info->receiver_id)
                                <li class="font-semibold">
                                    {{ $info->receiver->first_name . ' ' . $info->receiver->last_name }}</li>
                            @endif
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
                                {{ $info->comment }}
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
        <div>
            <h1 class="mb-1">Edit the comment below:</h1>
            <form wire:submit.prevent="forwardFeedback" class="w-full inline-flex flex-col">
                @csrf
                <textarea {{ $feedbackStatus >= 3 ? 'disabled' : '' }} wire:model="comment"
                    placeholder="{{ $feedbackStatus >= 3 ? "Sorry, you can't edit anymore..." : 'Rewrite the comment here...' }}"
                    rows="5"></textarea>
                <div class="flex items-center justify-between space-x-3">
                    <button type=button @click="modal = true"
                        class="px-3 py-2 bg-kgreen text-white rounded-md mt-5 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path class="fill-current"
                                d="M22 13h-2V7.238l-7.928 7.1L4 7.216V19h10v2H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v9zM4.511 5l7.55 6.662L19.502 5H4.511zM21 18h3v2h-3v3h-2v-3h-3v-2h3v-3h2v3z" />
                        </svg>
                        <span>Send mail</span>
                    </button>
                    <button type="submit"
                        class="{{ $feedbackStatus >= 3 ? 'bg-gray-400' : 'bg-kgreen' }} px-3 py-2 text-white rounded-md mt-5"
                        {{ $feedbackStatus >= 3 ? 'disabled' : '' }}>{{ $feedbackStatus >= 3 ? 'Forwarded already' : 'Forward feedback' }}</button>
                </div>
            </form>
        </div>
    </div>

    <x-modal class="w-3/6" headTitle="Send Email" modalAction="modal" x-cloak>
        <section class="mb-1">
            <h1 class="text-center bg-gray-200 py-3">
                You are sending mail to:
                <span class="font-semibold italic">
                    {{ $email->email }}
                </span>
            </h1>
        </section>

        <div class="mt-3 space-y-2">
            <div>
                <label for="subject">Email Subject</label>
                <input wire:loading.attr="disabled" type="text" name="subject" wire:model.defer="emailSubject"
                    placeholder="Enter mail subject" class="mt-1 w-full placeholder:text-gray-400">
            </div>
            <div>
                <label for="mail" class="text-gray-600 font-semibold">Email Content</label>
                <textarea wire:loading.attr="disabled" name="mail" placeholder="Write email content here" rows="5"
                    class="mt-1 w-full" wire:model.defer="emailContent"></textarea>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-end space-x-2">
            <x-page-button @click="modal = false" textValue="Cancel" class="text-gray-600 border" />

            <x-modal-button wire:loading.attr="disabled" type="submit" wire:click.prevent="sendEmail" textValue=""
                class="bg-kgreen hover:bg-kgreen/90 text-white">
                <section wire:loading.inline-flex>
                    <svg wire:loading wire:target="sendEmail" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        width="24" height="24" class="animate-spin">
                        <path class="fill-current"
                            d="M18.364 5.636L16.95 7.05A7 7 0 1 0 19 12h2a9 9 0 1 1-2.636-6.364z" />
                    </svg>
                    <span wire:loading wire:target="sendEmail" class="ml-2">sending...</span>
                </section>
                <span wire:loading.remove wire:target="sendEmail">Proceed sending</span>
            </x-modal-button>
            {{-- <x-modal-button wire:click.prevent="sendEmail()" type="submit" textValue="Proceed sending"
                class="bg-kgreen hover:bg-kgreen/90 text-white" wire:loading.attr="disabled" /> --}}
        </div>
    </x-modal>
</div>
