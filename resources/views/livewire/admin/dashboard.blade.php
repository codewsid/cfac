<div class='relative -z-40'>
    <div class="h-[13rem] absolute top-0 w-full bg-kgreen text-white -z-50"></div>
    <main class="px-5 absolute top-16">
        <div class="text-white">
            <x-title-heading title="Dashboard" />
            <p class="text-sm" wire:poll.delay.1000ms>{{ now()->format('F d, Y h:i:s A') }}</p>
        </div>

        <div>
        </div>
        <div class="grid grid-cols-5 gap-5 mt-10">
            @foreach ($offices as $office)
                <div class="bg-white rounded-md p-4 border w-[15rem]" wire:ignore>
                    <h1 class="text-gray-400 text-sm">Feedback statistics</h1>
                    <div class="h-[12.5rem] p-2">
                        <canvas id="chart{{ $office->id }}" width="400" height="400"
                            style="margin-right: 5px;"></canvas>
                        @push('chartjs')
                            <script>
                                var ctx = document.getElementById('chart{{ $office->id }}').getContext('2d');

                                var data = [
                                    {{ $office->feedbacks->where('feedback_type_id', 1)->count() }},
                                    {{ $office->feedbacks->where('feedback_type_id', 2)->count() }},
                                    {{ $office->feedbacks->where('feedback_type_id', 3)->count() }},
                                ];

                                if (ctx) {
                                    var chart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Complaints', 'Compliments', 'Suggestions'],
                                            datasets: [{
                                                data: data,
                                                backgroundColor: [
                                                    '#ef4444',
                                                    '#009A3C',
                                                    '#FF9549'
                                                ],
                                                hoverOffset: 4,
                                            }, ]
                                        },
                                        options: {
                                            cutoutPercentage: 65,
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            legend: {
                                                position: 'bottom',
                                                display: false,
                                            },
                                            plugins: {
                                                labels: [{
                                                        render: 'label',
                                                        position: 'outside',
                                                        fontSize: 10,
                                                        fontStyle: 'normal',
                                                        arc: true,
                                                        fontColor: [
                                                            '#ef4444',
                                                            '#009A3C',
                                                            '#FF9549'
                                                        ],
                                                    },
                                                    {
                                                        render: 'value',
                                                        precision: 0,
                                                        showZero: true,
                                                        fontSize: 12,
                                                        fontColor: '#fff',
                                                        fontStyle: 'normal',
                                                        arc: true,
                                                    },
                                                ]
                                            },
                                            animation: {
                                                animateScale: true,
                                                animateRotate: true
                                            },
                                        }
                                    });
                                }
                            </script>
                        @endpush
                    </div>
                    <div class="pb-2 space-x-5">
                        <div>
                            <div class="leading-4">
                                <p class="text-sm text-gray-400">Manage by</p>
                                <h1 class="font-bold">
                                    @if ($office->manage_by)
                                        {{ $office->manageBy->first_name . ' ' . $office->manageBy->last_name }}
                                    @else
                                        <h1 class="text-gray-600 line-through">No manager assign yet.</h1>
                                    @endif
                                </h1>
                            </div>
                            <div class="leading-4 mt-3">
                                <p class="text-sm text-gray-400">Office</p>
                                <h1 class="font-bold">{{ $office->name }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
