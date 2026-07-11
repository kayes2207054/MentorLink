<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading fw-bold text-white mb-0">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container page-inner">
            <div class="card card-elevated p-4 border-0">
                <div class="text-white">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
