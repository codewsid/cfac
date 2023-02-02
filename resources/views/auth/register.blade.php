<x-guest-layout>
    <div class="bg-kgreen/[5%] h-screen grid place-content-center relative">
        <!-- BG Image -->
        <div class='fixed -bottom-[5rem] -left-[10rem] -z-50 opacity-[5%]'>
            <img src="{{ asset('/assets/images/logo-with-deer.png') }}" alt="sksu logo with deer" class='h-[40rem]'>
        </div>

        <div class="bg-white w-[30rem] p-5 shadow rounded-md">
            <div class="mb-5">
                <img src="{{ asset('assets/logo.svg') }}" alt="cfac logo" class="h-10">
                <h1 class="mt-1 font-semibold text-kgreen">Client Feedback and Complaint Web-based Mechanism</h1>
            </div>
            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="client_type" class="font-medium text-gray-600">Client Type</label>
                    <select name="client_type" value="{{ old('client_type') }}"
                        class="w-full rounded-md mt-1 bg-zinc-100 border-zinc-300 shadow">
                        <option value="3" class="py-2">Alumni</option>
                        <option value="4" class="py-2">Employee</option>
                        <option value="5" class="py-2">Parent</option>
                        <option value="6" class="py-2">Student</option>
                        <option value="7" class="py-2">Visitor</option>
                    </select>
                </div>

                <div>
                    <x-jet-label for="fname" value="{{ __('First Name') }}" />
                    <x-jet-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')"
                        required autofocus autocomplete="fname" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="lname" value="{{ __('Last Name') }}" />
                    <x-jet-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')"
                        required autofocus autocomplete="lname" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                    Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                    Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                @endif

                <div class="mt-4 text-center">
                    <button type='submit'
                        class="bg-kgreen text-white py-2.5 mb-2 w-full rounded-md font-medium">Register</button>
                </div>
            </form>
        </div>

        <div class="flex items-center space-x-2 justify-center mt-4 text-zinc-500 font-medium">
            <h1>Already have an account? </h1>
            <a class="underline text-kgreen hover:text-kgreen/80" href="{{ route('login') }}">
                {{ __('Login here') }}
            </a>
        </div>
    </div>
</x-guest-layout>