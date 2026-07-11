<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card card-elevated p-4 border-0">
                @include('student.profile.partials.form', [
                    'action' => route('student.profile.update'),
                    'method' => 'PATCH',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
