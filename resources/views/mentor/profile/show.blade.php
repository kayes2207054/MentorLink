<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <div class="text-sm text-gray-500">{{ __('Name') }}</div>
                    <div class="text-gray-900">{{ $profile->user->name }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Designation') }}</div>
                    <div class="text-gray-900">{{ $profile->designation }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Experience') }}</div>
                    <div class="text-gray-900">{{ $profile->experience }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Bio') }}</div>
                    <div class="text-gray-900">{{ $profile->bio }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Skills') }}</div>
                    <div class="text-gray-900">{{ $profile->skills->pluck('name')->join(', ') }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Verified') }}</div>
                    <div class="text-gray-900">{{ $profile->is_verified ? __('Yes') : __('No') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
