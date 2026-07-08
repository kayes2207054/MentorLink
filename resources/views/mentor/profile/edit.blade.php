<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-person-badge me-2 opacity-75"></i>Edit Mentor Profile
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Update your professional information and expertise
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card card-elevated">
                    <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                        <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                            <i class="bi bi-pencil-fill text-primary" style="font-size:.85rem;"></i>
                        </span>
                        <h6 class="mb-0 fw-bold">Profile Information</h6>
                    </div>
                    <div class="card-body p-4">
                        @include('mentor.profile.partials.form', [
                            'action' => route('mentor.profile.update'),
                            'method' => 'PATCH',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
