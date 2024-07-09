<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('loginbackground.jpg') }}')">
        <x-authentication-card class="bg-opacity-20 backdrop-blur-lg p-6 rounded-lg shadow-lg">
            <x-slot name="logo">
                <x-authentication-card-logo class="bg-transparent" />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @if(session('status'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-white" />
                    <x-input id="email" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4 text-white">
                    <x-label for="password" value="{{ __('Password') }}" class="text-white" />
                    <x-input id="password" class="block mt-1 w-full border-lilac bg-white bg-opacity-20 text-black placeholder-white focus:ring-lilac focus:border-lilac" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <x-label for="remember_me" class="flex items-center" />
                    <x-checkbox id="remember_me" name="remember" class="text-lilac border-lilac" />
                    <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                </div>

                <div class="flex items-center justify-end mt-4 text-white">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-lilac hover:text-peach rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lilac" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-button class="ms-4 bg-lilac text-black hover:bg-peach">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
<!-- <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-lg p-4 shadow-lg max-w-md w-full">
</div> -->