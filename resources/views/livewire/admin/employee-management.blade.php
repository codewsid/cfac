<div class="px-5 mt-16" x-data="{ modal: @entangle('assignModal') }">
    <div>
        <div class="mt-4 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    {{-- <select class="border-gray-300 rounded-md">
                        <option value="">MSO</option>
                        <option value="">Registrar</option>
                    </select> --}}
                    <x-search-input wire:model="search" placeholder="employee information" />
                </div>
                <x-page-button @click="modal = true" textValue="Add Employee" class="bg-kgreen text-white" />
            </div>

            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class='bg-kgreen'>
                            <tr>
                                <th scope="col"
                                    class="text-white uppercase py-3.5 pl-4 pr-3 text-left font-semibold sm:pl-6 md:pl-5 w-[20rem]">
                                    Full Name
                                </th>
                                <th scope="col"
                                    class="text-white uppercase py-3.5 pl-4 pr-3 text-left font-semibold sm:pl-6 md:pl-5">
                                    Email
                                </th>
                                <th scope="col"
                                    class="text-white uppercase py-3.5 px-3 text-left font-semibold w-[15rem]">
                                    Office Assigned
                                </th>
                                <th scope="col"
                                    class="text-white uppercase py-3.5 px-3 text-right font-semibold w-[10rem] pr-7">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($employees as $employee)
                                <tr class='odd:bg-white even:bg-gray-50'>
                                    <td class="whitespace-wrap py-4 pl-4 pr-3 text-gray-900 sm:pl-6 md:pl-5">
                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                    </td>
                                    <td class="whitespace-wrap py-4 pl-4 pr-3 text-gray-900 sm:pl-6 md:pl-5">
                                        {{ $employee->email }}
                                    </td>
                                    <td class="whitespace-wrap py-4 px-3 text-gray-900 ">
                                        @if ($employee->offices->isEmpty())
                                            <select class="rounded-full py-1" wire:model="assignOffice">
                                                <option value="" hidden>Not assigned yet</option>
                                                <option value="0">Do not assign</option>
                                                @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}, {{ $employee->id }}">
                                                        {{ $office->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            @foreach ($employee->offices as $office)
                                                @if ($office->pivot_user_id == null)
                                                    <span
                                                        class="bg-kgreen/10 p-1 px-2 text-sm font-semibold rounded-md text-kgreen">
                                                        {{ $office->name }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="whitespace-wrap py-4 pl-4 pr-3 text-gray-900 sm:pl-6 md:pl-5 text-right">
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-kgreen bg-kgreen/10 rounded-full">Verified</span>
                                    </td>
                                </tr>

                            @empty
                                <tr class="bg-white">
                                    <x-no-data-found colspan="4" />
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $employees->links('custom-pagination') }}
                </div>

            </div>
        </div>
    </div>

    <x-modal headTitle="Add new Employee" modalAction="modal" x-cloak>
        <form>
            @csrf
            <div class="mb-2">
                <label for="officeId" class="font-semibold">Choose Office</label>
                <select name="officeId" wire:model="officeId" id="officeId"
                    class="w-full rounded-md border-gray-300 mt-1 bg-zinc-100">
                    <option value="" hidden>Select office to assign</option>
                    <option value="0">Do not assign yet</option>
                    @foreach ($offices as $office)
                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2.5">
                <x-group-input model="first_name" label="First Name" placeholder="Enter first name" name="first_name" />
                <x-group-input model="last_name" label="Last Name" placeholder="Enter last name" name="last_name" />
                <x-group-input model="email" type="email" label="Email Address"
                    placeholder="Enter valid email address" name="email" />
            </div>

            <div class="mt-5 flex items-center justify-end space-x-2">
                <x-page-button @click="modal = false" textValue="Cancel" class="text-gray-600 border" />
                <x-modal-button wire:click.prevent="saveEmployee()" type="submit" textValue="Save Employee"
                    class="bg-kgreen hover:bg-kgreen/90 text-white" wire:loading.attr="disabled" />
            </div>
        </form>
    </x-modal>
</div>

{{-- <span
    class="bg-gray-200 p-1 px-2 text-sm font-medium rounded-md text-gray-500">
    Not assigned yet
</span> --}}
