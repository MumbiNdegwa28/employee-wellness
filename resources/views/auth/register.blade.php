<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <style>
            body {
                background: url('images/image2.jpg') no-repeat center center fixed;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 170vh;
                margin: 0;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 90%;
                max-width: 600px;
                margin: 50px;
            }

            .glass-form {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 5px;
                padding: 50px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            .glass-form .form-group {
                margin-bottom: 15px;
            }

            .glass-form label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .glass-form input,
            .glass-form select {
                width: 100%;
                padding: 10px;
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 5px;
                background: rgba(255, 255, 255, 0.5);
                color: #000;
                font-size: 14px;
            }

            .glass-form button {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background: rgba(255, 255, 255, 0.7);
                color: #000;
                font-size: 16px;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .glass-form button:hover {
                background: rgba(255, 255, 255, 0.9);
            }
        </style>

        <form method="POST" action="{{ route('register') }}" class="glass-form">
            @csrf

            <div class="form-group">
                <x-label for="fname" value="{{ __('First Name') }}" />
                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
            </div>
            <div class="form-group">
                <x-label for="lname" value="{{ __('Last Name') }}" />
                <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
            </div>
            <div class="form-group">
                <x-label for="DOB" value="{{ __('Date of Birth') }}" />
                <x-input id="DOB" class="block mt-1 w-full" type="Date" name="DOB" :value="old('DOB')" required autofocus autocomplete="DOB" />
            </div>
            <div class="form-group">
                <x-label for="gender" value="{{ __('Gender') }}" />
                <select id="gender" name="gender" class="block mt-1 w-full" required>
                    <option value="" disabled selected>{{ __('Select your gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    <option value="rather_not_say" {{ old('gender') == 'rather_not_say' ? 'selected' : '' }}>{{ __('Rather not say') }}</option>
                </select>
            </div>

            <div class="form-group">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="form-group">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="form-group">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="form-group">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="form-group flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>