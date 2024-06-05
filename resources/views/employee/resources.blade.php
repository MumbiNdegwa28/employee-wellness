<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resources') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Blog Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Blogs') }}
                    </h3>
                    <div class="mt-4">
                        <!-- Blog Items -->
                        <div class="space-y-4">
                            @foreach($blogs as $blog)
                                <div class="p-4 bg-gray-100 rounded-lg">
                                    <h4 class="text-xl font-semibold">{{ $blog->title }}</h4>
                                    <p class="mt-2 text-gray-600">{{ $blog->description }}</p>
                                    <a href="{{ $blog->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">{{ __('Read more') }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Videos') }}
                    </h3>
                    <div class="mt-4">
                        <!-- Video Items -->
                        <div class="space-y-4">
                            @foreach($videos as $video)
                                <div class="p-4 bg-gray-100 rounded-lg">
                                    <h4 class="text-xl font-semibold">{{ $video->title }}</h4>
                                    <div class="mt-2">
                                        <iframe width="560" height="315" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <p class="mt-2 text-gray-600">{{ $video->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>