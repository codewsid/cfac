<div class="max-w-[95%] mx-auto sm:px-6 lg:px-0 mt-5">

    <a href="{{ route('main') }}"
        class="bg-kgreen rounded-md text-white py-2 px-2.5 inline-flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="21" height="21">
            <path fill="none" d="M0 0h24v24H0z" />
            <path d="M7.828 11H20v2H7.828l5.364 5.364-1.414 1.414L4 12l7.778-7.778 1.414 1.414z"
                fill="rgba(255,255,255,1)" />
        </svg>
        <span class="pr-1.5">Back</span>
    </a>
    <div class="mt-7 flex items-start justify-start">
        <section class="w-3/6">
            <div>
                <h1 class="text-lg font-semibold uppercase">Feedback Details</h1>
                <div class="flex items-start space-x-5 text-lg mt-5">
                    <ul>
                        <li class="text-gray-600">Feedback Type: </li>
                        <li class="text-gray-600">Comment: </li>

                        @if ($feedbackDetails->office)
                        <li class="text-gray-600">Office: </li>
                        @else
                        <li class="text-gray-600">Receiver: </li>
                        @endif
                    </ul>
                    <ul>
                        <li>{{ $feedbackDetails->feedbackType->name }}</li>
                        <li>{{ $feedbackDetails->comment }}</li>
                        <li>
                            @if ($feedbackDetails->office)
                            {{ $feedbackDetails->office->name }} Office
                            @else
                            {{ $feedbackDetails->receiver->first_name . ' ' . $feedbackDetails->receiver->last_name }}
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8">
                <h1 class="text-lg font-semibold uppercase">Your ratings:</h1>
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
        </section>

        <div>
            <h1 class="text-lg font-semibold uppercase">Feedback timeline tracker</h1>
            <ol class="mt-5">
                <li class="{{ $timeline->status ? 'border-kgreen' : 'border-gray-300' }} border-l-2">
                    <div class="flex flex-start items-center">
                        <div
                            class="{{ $timeline->status ? 'bg-kgreen' : 'bg-gray-200' }} w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                        </div>
                        <section>
                            <h4
                                class="font-semibold text-lg -mt-2 {{ $timeline->status ? 'text-kgreen' : 'text-gray-200' }}">
                                Completed
                                @if ($timeline->status)
                                <span class="text-sm text-gray-500">-
                                    {{ date('F d, Y • h:i A', strtotime($timeline->updated_at)) }}</span>
                                @endif
                            </h4>
                        </section>
                    </div>
                </li>
                <li
                    class="{{ $timeline->receiver_received && $timeline->status ? 'border-kgreen' : 'border-gray-300' }} border-l-2">
                    <div class="ml-6 mb-6 pb-6"></div>
                    <div class="flex flex-start items-center">
                        @php
                        $received = $timeline->receiver_received && $timeline->status;
                        $underReceived = $timeline->receiver_received && $timeline->status == null;
                        @endphp
                        <div
                            class="{{ $received ? 'bg-kgreen' : ($underReceived ? 'bg-korange' : 'bg-gray-200') }} w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                        </div>
                        <section>
                            <h4
                                class="font-semibold text-lg -mt-2 {{ $received ? 'text-kgreen' : ($underReceived ? 'text-korange' : 'text-gray-200') }}">
                                Received by receiver
                                @if ($timeline->receiver_received)
                                <span class="text-sm text-gray-500">-
                                    {{ date('F d, Y • h:i A', strtotime($timeline->receiver_received)) }}</span>
                                @endif
                            </h4>
                            <div class="text-gray-600 duration-300 transition ease-in-out text-sm">
                                {{ $received
                                    ? 'The receiver reviewed your feedback.'
                                    : ($underReceived
                                        ? 'The receiver is reviewing your feedback and it is almost complete.'
                                        : '') }}
                            </div>
                        </section>
                    </div>
                </li>
                <li
                    class="{{ $timeline->forwarded_receiver && $timeline->receiver_received ? 'border-kgreen' : 'border-gray-300' }} border-l-2">
                    <div class="ml-6 mb-6 pb-6"></div>
                    <div class="flex flex-start items-center">
                        @php
                        $forwardReceived = $timeline->forwarded_receiver && $timeline->receiver_received;
                        $forwardTo = $timeline->forwarded_receiver && $timeline->receiver_received == null;
                        @endphp
                        <div
                            class="{{ $forwardReceived ? 'bg-kgreen' : ($forwardTo ? 'bg-korange' : 'bg-gray-200') }} w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                        </div>
                        <section>
                            <h4
                                class="font-semibold text-lg -mt-2 {{ $forwardReceived ? 'text-kgreen' : ($forwardTo ? 'text-korange' : 'text-gray-200') }}">
                                Forwarded to Receiver
                                @if ($timeline->forwarded_receiver)
                                <span class="text-sm text-gray-500">-
                                    {{ date('F d, Y • h:i A', strtotime($timeline->forwarded_receiver)) }}</span>
                                @endif
                            </h4>
                            <div class="text-gray-600 duration-300 transition ease-in-out text-sm">
                                {{ $forwardReceived
                                    ? 'The receiver already receive your feedback.'
                                    : ($forwardTo
                                        ? 'Waiting for the receiver to receive your feedback.'
                                        : '') }}
                            </div>
                        </section>
                    </div>
                </li>
                <li
                    class="{{ $timeline->admin_receive && $timeline->forwarded_receiver ? 'border-kgreen' : 'border-gray-300' }} border-l-2">
                    <div class="ml-6 mb-6 pb-6"></div>
                    <div class="flex flex-start items-center">
                        @php
                        $adminForward = $timeline->admin_receive && $timeline->forwarded_receiver;
                        $adminReceive = $timeline->admin_receive && $timeline->forwarded_receiver == null;
                        @endphp
                        <div
                            class="{{ $adminForward ? 'bg-kgreen' : ($adminReceive ? 'bg-korange' : 'bg-gray-200') }} w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                        </div>
                        <section>
                            <h4
                                class="font-semibold text-lg -mt-2 {{ $adminForward ? 'text-kgreen' : ($adminReceive ? 'text-korange' : 'text-gray-200') }}">
                                Admin Received
                                @if ($timeline->admin_receive)
                                <span class="text-sm text-gray-500">-
                                    {{ date('F d, Y • h:i A', strtotime($timeline->admin_receive)) }}</span>
                                @endif
                            </h4>
                            <div class="text-gray-600 duration-300 transition ease-in-out text-sm">
                                {{ $adminForward
                                    ? 'The admin already forwarded your feedback to receiver.'
                                    : ($adminReceive
                                        ? 'The admin is viewing the details of your feedback.'
                                        : '') }}
                            </div>
                        </section>
                    </div>
                </li>
                <li
                    class="{{ $timeline->pending && $timeline->admin_receive ? 'border-kgreen' : 'border-gray-300' }} border-l-2">
                    <div class="ml-6 mb-6 pb-6"></div>
                    <div class="flex flex-start items-center">
                        <div
                            class="{{ $timeline->pending && $timeline->admin_receive == null ? 'bg-korange' : 'bg-kgreen' }} w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                        </div>
                        <section>
                            <h4
                                class="font-semibold text-lg -mt-2 {{ $timeline->pending && $timeline->admin_receive == null ? 'text-korange' : 'text-kgreen' }}">
                                Pending
                                @if ($timeline->admin_receive)
                                <span class="text-sm text-gray-500">-
                                    {{ date('F d, Y • h:i A', strtotime($timeline->admin_receive)) }}</span>
                                @endif
                            </h4>
                            <div class="text-gray-600 duration-300 transition ease-in-out text-sm">
                                {{ $timeline->pending && $timeline->admin_receive == null ? 'This feedback is still pending.' : 'The admin already received this feedback.' }}
                            </div>
                        </section>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>