<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=ffffff&color=4f46e5&size=150"
                         class="rounded-circle shadow-lg border border-4 border-white"
                         style="width:90px;height:90px;object-fit:cover;" alt="{{ $mentor->name }}">
                </div>
                <div>
                    <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                        {{ $mentor->name }}
                    </h2>
                    <p class="mb-0 text-white opacity-90 fs-5 fw-medium">
                        {{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}
                        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                            <span class="badge bg-success border border-white ms-2 rounded-pill align-text-bottom"><i class="bi bi-patch-check-fill me-1"></i>Verified</span>
                        @endif
                    </p>
                </div>
            </div>
            <a href="{{ route('student.mentors.index') }}" class="btn btn-light btn-lg text-primary fw-bold shadow-sm rounded-pill px-4 hover-lift-btn">
                <i class="bi bi-arrow-left me-2"></i>Directory
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="card card-elevated border-0 shadow-lg mb-4">
                    <div class="card-body p-4 p-md-5">
                        
                        <h4 class="font-heading fw-bold mb-4 d-flex align-items-center gap-2 text-dark">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2"><i class="bi bi-person-lines-fill"></i></div>
                            About Me
                        </h4>
                        
                        @if($mentor->mentorProfile->bio)
                            <p class="text-secondary fs-5" style="white-space:pre-line;line-height:1.8;">{{ $mentor->mentorProfile->bio }}</p>
                        @else
                            <div class="bg-slate-50 rounded-4 p-4 text-center border border-soft">
                                <p class="text-muted fst-italic mb-0">This mentor hasn't added a bio yet.</p>
                            </div>
                        @endif

                        <hr class="my-5 border-soft">

                        <h4 class="font-heading fw-bold mb-4 d-flex align-items-center gap-2 text-dark">
                            <div class="bg-success bg-opacity-10 text-success rounded p-2"><i class="bi bi-briefcase-fill"></i></div>
                            Professional Experience
                        </h4>
                        
                        @if($mentor->mentorProfile->experience)
                            <p class="text-secondary" style="white-space:pre-line;line-height:1.75;">{{ $mentor->mentorProfile->experience }}</p>
                        @else
                            <div class="bg-slate-50 rounded-4 p-4 text-center border border-soft">
                                <p class="text-muted fst-italic mb-0">No experience details provided.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Stats / Department --}}
                <div class="card card-elevated border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        @php $rating = $mentor->mentorProfile->averageRating() ?? 0; @endphp
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-4 border-bottom border-soft">
                            <div>
                                <p class="text-uppercase fw-bold text-muted small mb-1">Rating</p>
                                <div class="d-flex align-items-center gap-2">
                                    <h3 class="font-heading fw-bold mb-0 text-dark">{{ number_format($rating, 1) }}</h3>
                                    <div class="text-warning fs-5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-uppercase fw-bold text-muted small mb-1">Reviews</p>
                                <h3 class="font-heading fw-bold mb-0 text-dark">{{ $mentor->mentorProfile->totalReviews() }}</h3>
                            </div>
                        </div>

                        @if($mentor->mentorProfile && $mentor->mentorProfile->department)
                            <div class="mb-4">
                                <p class="text-uppercase fw-bold text-muted small mb-2">Department</p>
                                <div class="bg-slate-50 rounded-3 p-3 border border-soft d-flex align-items-center gap-3">
                                    <div class="bg-white rounded-circle p-2 shadow-sm"><i class="bi bi-building text-primary fs-5"></i></div>
                                    <span class="fw-bold text-dark">{{ $mentor->mentorProfile->department->name }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="mb-2">
                            <p class="text-uppercase fw-bold text-muted small mb-2">Expertise & Skills</p>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($mentor->mentorProfile->skills as $skill)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-muted small fst-italic">No specific skills listed.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                @if($pendingRequest)
                    <div class="card border-warning bg-warning bg-opacity-10 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-hourglass-split text-warning display-4 mb-3"></i>
                            <h5 class="fw-bold text-dark font-heading">Request Pending</h5>
                            <p class="text-muted small mb-4">You have a pending mentorship request. Please wait for their response.</p>
                            <form method="POST" action="{{ route('student.mentorship-requests.destroy', $pendingRequest->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 fw-bold rounded-pill">Withdraw Request</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card border-0 bg-primary text-white shadow-lg rounded-4 overflow-hidden position-relative">
                        <div class="position-absolute top-0 end-0 p-4 opacity-25">
                            <i class="bi bi-rocket-takeoff-fill" style="font-size: 8rem;"></i>
                        </div>
                        <div class="card-body p-4 position-relative z-1">
                            <h4 class="font-heading fw-bold mb-2 text-white">Start Your Journey</h4>
                            <p class="text-white-50 mb-4">Send a request to connect with this mentor and schedule sessions.</p>
                            <form method="POST" action="{{ route('student.mentorship-requests.store') }}">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                <div class="mb-4">
                                    <textarea name="message" rows="3" class="form-control border-0 bg-white bg-opacity-10 text-white placeholder-light shadow-none" required placeholder="Hi! I'd love your guidance on..."></textarea>
                                </div>
                                <button type="submit" id="btn-send-request" class="btn bg-white w-100 fw-bold text-primary rounded-pill btn-lg">
                                    <i class="bi bi-send-fill"></i>Send Request
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    
    <style>
    .placeholder-light::placeholder { color: rgba(255,255,255,0.6); }
    
    #btn-send-request {
        border: 2px solid transparent;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18) !important;
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
    }
    #btn-send-request:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.28) !important;
        background-color: #f8fafc !important;
        border-color: rgba(255, 255, 255, 0.4);
    }
    #btn-send-request:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.18) !important;
    }
    #btn-send-request i {
        font-size: 1.05rem;
        margin-right: 0.5rem;
    }
    </style>
</x-app-layout>
