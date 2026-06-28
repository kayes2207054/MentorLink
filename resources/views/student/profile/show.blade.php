<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Profile') }}
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
                    <div class="text-sm text-gray-500">{{ __('Student ID') }}</div>
                    <div class="text-gray-900">{{ $profile->student_id }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Department') }}</div>
                    <div class="text-gray-900">{{ $profile->department->name }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Academic Year') }}</div>
                    <div class="text-gray-900">{{ $profile->academic_year }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Semester') }}</div>
                    <div class="text-gray-900">{{ $profile->semester }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">{{ __('Bio') }}</div>
                    <div class="text-gray-900">{{ $profile->bio }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
