<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Profile: ') }} {{ $mentor->name }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        .bootstrap-wrapper { font-family: 'Inter', sans-serif; }
    </style>

    <div class="py-12 bootstrap-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left Sidebar -->
                        <div class="col-md-4 col-lg-3 bg-light border-end">
                            <div class="p-5 text-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=random&size=150" class="rounded-circle img-thumbnail mb-4 shadow-sm" alt="{{ $mentor->name }}">
                                
                                <h3 class="fw-bold mb-1">{{ $mentor->name }}</h3>
                                <p class="text-muted mb-3">{{ $mentor->mentorProfile->designation }}</p>
                                
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="text-warning me-2">
                                        @php $rating = $mentor->mentorProfile->averageRating() ?? 0; @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="fw-bold">{{ number_format($rating, 1) }}</span>
                                    <span class="text-muted small ms-1">({{ $mentor->mentorProfile->totalReviews() }} reviews)</span>
                                </div>
                                
                                <hr class="my-4">
                                
                                <h6 class="text-uppercase text-muted fw-bold mb-3 text-start"><i class="bi bi-tools me-2"></i>Skills</h6>
                                <div class="d-flex flex-wrap justify-content-start gap-1">
                                    @foreach($mentor->mentorProfile->skills as $skill)
                                        <span class="badge bg-white text-dark border">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Content -->
                        <div class="col-md-8 col-lg-9">
                            <div class="p-5">
                                <h5 class="fw-bold text-uppercase text-primary mb-3"><i class="bi bi-briefcase me-2"></i>Experience</h5>
                                <p class="text-secondary mb-5" style="white-space: pre-line;">{{ $mentor->mentorProfile->experience }}</p>

                                <h5 class="fw-bold text-uppercase text-primary mb-3"><i class="bi bi-person-lines-fill me-2"></i>Bio</h5>
                                <p class="text-secondary mb-5" style="white-space: pre-line;">{{ $mentor->mentorProfile->bio }}</p>

                                <hr class="my-5">

                                @if($pendingRequest)
                                    <div class="alert alert-warning border-warning-subtle d-flex align-items-center shadow-sm" role="alert">
                                        <i class="bi bi-hourglass-split fs-4 me-3 text-warning"></i>
                                        <div>
                                            <h6 class="alert-heading fw-bold mb-1">Request Pending</h6>
                                            <p class="mb-0 small">You have a pending mentorship request with this mentor. Please wait for their response.</p>
                                        </div>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('student.mentorship-requests.destroy', $pendingRequest->id) }}" class="mt-3 text-end">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger shadow-sm"><i class="bi bi-x-circle me-2"></i>Cancel Request</button>
                                    </form>
                                @else
                                    <div class="card border border-primary-subtle bg-primary bg-opacity-10 shadow-sm">
                                        <div class="card-body p-4">
                                            <h5 class="fw-bold mb-3"><i class="bi bi-send me-2 text-primary"></i>Request Mentorship</h5>
                                            <form method="POST" action="{{ route('student.mentorship-requests.store') }}">
                                                @csrf
                                                <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                                <div class="mb-3">
                                                    <label for="message" class="form-label fw-medium text-dark">Message to Mentor</label>
                                                    <textarea name="message" id="message" rows="4" class="form-control shadow-sm" required placeholder="Introduce yourself and explain why you want this mentor..."></textarea>
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary shadow-sm"><i class="bi bi-paperclip me-2"></i>Send Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-4 text-start">
                <a href="{{ route('student.mentors.index') }}" class="btn btn-light shadow-sm"><i class="bi bi-arrow-left me-2"></i>Back to Directory</a>
            </div>
        </div>
    </div>
</x-app-layout>
