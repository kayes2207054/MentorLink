<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading fw-bold text-white mb-0">
            {{ __('Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container page-inner">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-elevated p-4 border-0">
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Name') }}</div>
                            <div class="text-white fs-5">{{ $profile->user->name }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Student ID') }}</div>
                            <div class="text-white fs-5">{{ $profile->student_id }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Department') }}</div>
                            <div class="text-white fs-5">{{ $profile->department->name }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Academic Year') }}</div>
                            <div class="text-white fs-5">{{ $profile->academic_year }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Semester') }}</div>
                            <div class="text-white fs-5">{{ $profile->semester }}</div>
                        </div>
                        <div>
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Bio') }}</div>
                            <div class="text-white fs-5">{{ $profile->bio }}</div>
                        </div>
                        
                        <!-- BATCH 1 VERIFIED MARKER -->
                        <div class="mt-5 text-center">
                            <span class="badge bg-danger text-white px-4 py-2 fs-5 fw-bold border border-warning shadow-lg">🔥 BATCH 1 VERIFIED 🔥</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
