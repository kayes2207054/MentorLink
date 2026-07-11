<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading fw-bold text-white mb-0">
            {{ __('Mentor Profile') }}
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
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Designation') }}</div>
                            <div class="text-white fs-5">{{ $profile->designation }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Experience') }}</div>
                            <div class="text-white fs-5">{{ $profile->experience }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Bio') }}</div>
                            <div class="text-white fs-5">{{ $profile->bio }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Skills') }}</div>
                            <div class="text-white fs-5">{{ $profile->skills->pluck('name')->join(', ') }}</div>
                        </div>
                        <div>
                            <div class="text-muted small fw-bold text-uppercase">{{ __('Verified') }}</div>
                            <div>
                                @if($profile->is_verified)
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Yes</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-dash-circle me-1"></i>No</span>
                                @endif
                            </div>
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
