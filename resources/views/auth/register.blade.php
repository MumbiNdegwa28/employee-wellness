<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/image2.jpg')">
        <x-authentication-card class="bg-opacity-20 backdrop-blur-lg p-6 rounded-lg shadow-lg">
            <x-slot name="logo">
                <x-authentication-card-logo class="bg-transparent" />
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="fname" value="{{ __('First Name') }}" class="text-white" />
                    <x-input id="fname" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                </div>

                <div class="mt-4">
                    <x-label for="lname" value="{{ __('Last Name') }}" class="text-white" />
                    <x-input id="lname" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                </div>

                <div class="mt-4">
                    <x-label for="DOB" value="{{ __('Date of Birth') }}" class="text-white" />
                    <x-input id="DOB" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="date" name="DOB" :value="old('DOB')" required autofocus autocomplete="DOB" />
                </div>

                <div class="mt-4">
                    <x-label for="gender" value="{{ __('Gender') }}" class="text-white" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" required>
                        <option value="" disabled selected>{{ __('Select your gender') }}</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                        <option value="rather_not_say" {{ old('gender') == 'rather_not_say' ? 'selected' : '' }}>{{ __('Rather not say') }}</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-white" />
                    <x-input id="email" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-white" />
                    <x-input id="password" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-white" />
                    <x-input id="password_confirmation" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms" class="text-white">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required class="text-lilac border-lilac" />
                                <span class="ms-2 text-sm text-white">{{ __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-lilac hover:text-peach rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lilac">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-lilac hover:text-peach rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lilac">'.__('Privacy Policy').'</a>',
                                ]) }}</span>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4 text-white">
                    <a class="underline text-sm text-lilac hover:text-peach rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lilac" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ms-4 bg-lilac text-black hover:bg-peach">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
