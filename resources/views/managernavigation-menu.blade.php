<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('manager.home') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('manager.home') }}" :active="request()->routeIs('manager.home')">
                        {{ __('Manager Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('evaluation-form-report') }}" :active="request()->routeIs('evaluation-form-report')">
                        {{ __('Evaluation Form Report') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('plan-activities') }}" :active="request()->routeIs('plan-activities')">
                        {{ __('Plan Activities') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('feedback') }}" :active="request()->routeIs('feedback')">
                        {{ __('Feedback') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <!-- Your teams dropdown code -->
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <!-- Your settings dropdown code -->
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <!-- Your hamburger code -->
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('manager.home') }}" :active="request()->routeIs('manager.home')">
                {{ __('Manager Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('evaluation-form-report') }}" :active="request()->routeIs('evaluation-form-report')">
                {{ __('Evaluation Form Report') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('plan-activities') }}" :active="request()->routeIs('plan-activities')">
                {{ __('Plan Activities') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('feedback') }}" :active="request()->routeIs('feedback')">
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <!-- Your responsive settings options code -->
        </div>
    </div>
</nav>
