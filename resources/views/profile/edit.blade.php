<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white font-heading fw-bold">
                    <i class="bi bi-person-gear me-2 opacity-75"></i>{{ __('Account Settings') }}
                </h2>
                <p class="mb-0 mt-1 text-white opacity-90 fs-5">
                    Manage your personal information, security, and account preferences
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 d-flex flex-column gap-4">
                
                <div class="card card-elevated border-0 shadow-sm">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-person-lines-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">{{ __('Profile Information') }}</h6>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card card-elevated border-0 shadow-sm">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#fef3c7;">
                            <i class="bi bi-shield-lock-fill text-warning" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">{{ __('Update Password') }}</h6>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card card-elevated border-0 shadow-sm border-danger border-opacity-25">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#fee2e2;">
                            <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-danger">{{ __('Danger Zone') }}</h6>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
