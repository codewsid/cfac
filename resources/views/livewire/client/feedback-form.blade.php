<div x-data="{
    criterias: @js($criterias),
    scales : @js($scales),
    feedbacks: $wire.entangle('feedbacks'),
    push(key, value) {
        let existingValue = this.feedbacks.find(element => element.key === key );
        if (existingValue) {
            let index = this.feedbacks.indexOf(existingValue);
            this.feedbacks.splice(index, 1);
        }
        this.feedbacks.push({key, value});
    },
    isSelected(key,value){
        return this.feedbacks.find(item => item.key === key && item.value === value) ? true : false;
    }

}" class="lg:max-w-[70%] max-w-[95%] mx-auto sm:px-6 lg:px-0 mt-5">
    <form>
        <div class='mt-5'>
            {{-- <div class="mt-2 bg-kgreen flex flex-col items-center text-white py-3 w-full text-center">
                <h1 class="lg:text-4xl text-2xl font-bold font-head">Rating Criteria</h1>
                <p class="text-sm w-[80%] leading-5 mt-2">Please rate the service of the University employee/office involved
                    in terms of the criteria that shows below.</p>
            </div> --}}
            <div class='flex flex-col lg:flex-row items-center justify-between space-y-3 lg:space-y-0 lg:space-x-5 bg-white p-5 rounded-md border mt-5'>
                <div class='flex flex-col items-start w-full lg:w-1/3'>
                    <label class='font-semibold'>Choose feedback type</label>
                    <div class='bg-zinc-100 border rounded-md border-gray-300 mt-1 w-full @error(' feedBackType')
                        border-red-500 @enderror'>
                        <select wire:model="feedbackType" class='bg-transparent border-transparent w-full rounded-md focus:ring-2 focus:ring-kgreen focus:border-transparent'>
                            <option class='bg-white' hidden>Select feedback type</option>
                            @foreach ($feedbackTypes as $type)
                                <option value={{ $type->id }} class='bg-white p-0'>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('feedBackType')
                        <span class="text-red-500 text-sm mt-1">Choose feedback type you want to send.</span>
                    @enderror
                </div>
                <div class='flex flex-col items-start flex-1 w-full lg:w-2/3'>
                    <label for="office" class='font-semibold'>Choose where you want to Feedback</label>
                    <div class='bg-transparent rounded-md border-gray-300 mt-1 w-full flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-2 @error(' toOffice') border-red-500
                        @enderror'>
                        <select class='border-gray-300 bg-zinc-100 w-full lg:w-1/3 border rounded-md focus:ring-2 focus:ring-kgreen focus:border-transparent' wire:model="selectedReceiver">
                            <option class='bg-white' hidden>Make Feedback to:</option>
                            <option @selected($selectedReceiver == 1) value="1">Office only</option>
                            <option @selected($selectedReceiver == 2)  value="2">Employee only</option>
                            <option @selected($selectedReceiver == 3)  value="3">Employee in Office</option>
                        </select>
                        
                        @if ($selectedReceiver == 3)
                            <div class="flex items-center justify-between w-full space-x-2">
                                <select wire:model="selectedEmpOffice"
                                    class='flex-1 border-gray-300 bg-zinc-100 w-full lg:w-2/3 border rounded-md focus:ring-2 focus:ring-kgreen focus:border-transparent'>
                                    <option class='bg-white' hidden>Select Office</option>
                                    @forelse ($offices as $office)
                                        <option @selected($selectedEmpOffice == $office->id) value="{{ $office->id }}">{{ $office->name }}</option>
                                    @empty
                                        <option value="">No Office Data</option>
                                    @endforelse
                                </select>
                                
                                @if ($selectedEmpOffice)
                                    <select wire:model="feedbackReceiver" class='flex-1 border-gray-300 bg-zinc-100 w-full lg:w-2/3 border rounded-md focus:ring-2 focus:ring-kgreen focus:border-transparent'>
                                        <option class='bg-white' hidden selected>Select Employee here</option>
                                        @forelse ($empOffice as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->first_name . ' ' . $emp->last_name }}</option>
                                        @empty
                                        <option>No Employee in this Office yet</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                        @else
                            <select wire:model="feedbackReceiver"
                                class='border-gray-300 bg-zinc-100 w-full lg:w-2/3 border rounded-md focus:ring-2 focus:ring-kgreen focus:border-transparent'>
                                <option class='bg-white' hidden>Select first</option>
                                @if ($selectedReceiver == 1)
                                    @forelse ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @empty
                                        <option value="">No Office Data</option>
                                    @endforelse
                                @elseif ($selectedReceiver == 2)
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->first_name . ' ' . $employee->last_name}}</option>
                                    @empty
                                        <option value="">No Employee Data</option>
                                    @endforelse
                                @else
                                <option value="">Select first</option>
                                @endif
                            </select>

                        @endif
                    </div>
                    @error('toOffice')
                        <span class="text-red-500 text-sm mt-1">Please choose office where you want to send your feedback.</span>
                    @enderror
                </div>
            </div>

            <div class="select-none w-full">
                <div class='my-2 space-y-2'>
                    <template x-for="(cret, index) in criterias" :key="cret.id + ' ' + index">
                        <div class="bg-white p-5 border rounded-md">
                            <h1 class='text-lg font-bold uppercase'>
                                <span x-text="cret.id"></span> -
                                <span x-text="cret.name"></span>
                            </h1>
                            <div class="lg:grid lg:grid-cols-5 gap-x-1.5 select-none space-y-2">
                                <template x-for="(scale,index) in scales" :key="scale.id + ' ' + index">
                                    <button x-on:click="push(cret.id, scale.value)"  type="button" 
                                    x-bind:class="isSelected(cret.id, scale.value) ? 'bg-kgreen text-white' : '' "
                                    class="py-2 px-5 w-full justify-center border rounded-lg cursor-pointer focus:outline-none bg-white border-gray-300">
                                        <span x-text="scale.value"></span> - <span x-text="scale.scale_title"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Paragraph Content -->
                    <div class="mt-3 bg-white p-5 border rounded-md @error('comment') border-red-500 @enderror">
                        <h1 class="font-semibold text-lg mb-2">Your comment</h1>
                        <textarea name="comment" id="comment" wire:model="comment"
                            class=" w-full placeholder:italic border rounded-md border-gray-300 placeholder:text-sm focus:outline-kgreen focus:ring-inset focus:border-gray-300 focus:ring-0"
                            rows="5" placeholder="Start writing your comment here..."></textarea>
                    </div>
                    <div class='my-5 flex lg:justify-end justify-center'>
                        <button type="button" wire:click.prevent="sendFeedback"
                            class='bg-kgreen w-full lg:w-[11rem] text-white py-2.5 px-3 rounded-md flex justify-center items-center space-x-2'>
                            <span>Send Feedback</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>