<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-person-circle me-2 opacity-75"></i>{{ $mentor->name }}
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    {{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}
                    @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                        &nbsp;&middot;&nbsp;<i class="bi bi-patch-check-fill"></i> Verified
                    @endif
                </p>
            </div>
            <a href="{{ route('student.mentors.index') }}"
               class="btn btn-sm"
               style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.35);border-radius:.65rem;font-weight:600;">
                <i class="bi bi-arrow-left me-1"></i>Back to Directory
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        <div class="card card-elevated overflow-hidden mb-4">
            <div class="row g-0">

                {{-- Left Sidebar: Profile --}}
                <div class="col-md-4 col-lg-3 profile-sidebar">
                    <div class="p-4 p-md-5 text-center">
                        {{-- Avatar --}}
                        <div class="position-relative d-inline-block mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=200"
                                 class="rounded-circle shadow"
                                 style="width:110px;height:110px;object-fit:cover;border:4px solid #fff;"
                                 alt="{{ $mentor->name }}">
                            @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                                <span class="position-absolute bottom-0 end-0 badge rounded-circle p-2 shadow"
                                      style="background:#4f46e5;" title="Verified Mentor">
                                    <i class="bi bi-patch-check-fill text-white" style="font-size:.85rem;"></i>
                                </span>
                            @endif
                        </div>

                        <h4 class="fw-bold mb-1">{{ $mentor->name }}</h4>
                        <p class="text-muted small mb-3">{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>

                        {{-- Star Rating --}}
                        @php $rating = $mentor->mentorProfile->averageRating() ?? 0; @endphp
                        <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="fw-bold">{{ number_format($rating, 1) }}</span>
                            <span class="text-muted small">({{ $mentor->mentorProfile->totalReviews() }})</span>
                        </div>

                        <hr class="border-soft my-3">

                        {{-- Department --}}
                        @if($mentor->mentorProfile && $mentor->mentorProfile->department)
                            <div class="mb-3 text-start">
                                <p class="text-uppercase fw-bold text-muted mb-1"
                                   style="font-size:.67rem;letter-spacing:.08em;">Department</p>
                                <span class="d-flex align-items-center gap-2 fw-medium small">
                                    <i class="bi bi-building text-primary"></i>
                                    {{ $mentor->mentorProfile->department->name }}
                                </span>
                            </div>
                        @endif

                        {{-- Skills --}}
                        <div class="text-start">
                            <p class="text-uppercase fw-bold text-muted mb-2"
                               style="font-size:.67rem;letter-spacing:.08em;">
                                <i class="bi bi-lightning-fill text-primary me-1"></i>Skills
                            </p>
                            <div class="d-flex flex-wrap gap-1">
                                @forelse($mentor->mentorProfile->skills as $skill)
                                    <span class="badge rounded-pill px-2 py-1"
                                          style="background:#ede9fe;color:#4f46e5;font-size:.72rem;font-weight:600;">
                                        {{ $skill->name }}
                                    </span>
                                @empty
                                    <span class="text-muted small fst-italic">No skills listed yet.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Content --}}
                <div class="col-md-8 col-lg-9">
                    <div class="p-4 p-md-5">

                        {{-- Experience --}}
                        <div class="mb-5">
                            <h5 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                <span class="d-inline-flex p-2 rounded-2" style="background:#ede9fe;">
                                    <i class="bi bi-briefcase-fill text-primary" style="font-size:.9rem;"></i>
                                </span>
                                Experience
                            </h5>
                            @if($mentor->mentorProfile->experience)
                                <p class="text-secondary" style="white-space:pre-line;line-height:1.75;">
                                    {{ $mentor->mentorProfile->experience }}
                                </p>
                            @else
                                <p class="text-muted fst-italic small">
                                    This mentor hasn't added their experience yet.
                                </p>
                            @endif
                        </div>

                        {{-- Bio --}}
                        <div class="mb-5">
                            <h5 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                <span class="d-inline-flex p-2 rounded-2" style="background:#d1fae5;">
                                    <i class="bi bi-person-lines-fill text-success" style="font-size:.9rem;"></i>
                                </span>
                                About
                            </h5>
                            @if($mentor->mentorProfile->bio)
                                <p class="text-secondary" style="white-space:pre-line;line-height:1.75;">
                                    {{ $mentor->mentorProfile->bio }}
                                </p>
                            @else
                                <p class="text-muted fst-italic small">
                                    This mentor hasn't added a bio yet.
                                </p>
                            @endif
                        </div>

                        <hr class="border-soft mb-4">

                        {{-- Mentorship Request Section --}}
                        @if($pendingRequest)
                            <div class="alert alert-warning d-flex align-items-start gap-3 shadow-sm mb-3" role="alert">
                                <i class="bi bi-hourglass-split fs-4 flex-shrink-0 mt-1 text-warning"></i>
                                <div>
                                    <h6 class="alert-heading fw-bold mb-1">Request Pending Review</h6>
                                    <p class="mb-3 small">
                                        You have a pending mentorship request with this mentor.
                                        Please wait for their response before sending another.
                                    </p>
                                    <form method="POST"
                                          action="{{ route('student.mentorship-requests.destroy', $pendingRequest->id) }}"
                                          id="cancel-mentorship-request">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 hover-lift-btn">
                                            <i class="bi bi-x-circle me-1"></i>Withdraw Request
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="card border-0 rounded-3 overflow-hidden"
                                 style="background:linear-gradient(135deg,#f5f3ff 0%,#ede9fe 100%);border:1px solid #c4b5fd!important;">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-1 d-flex align-items-center gap-2">
                                        <i class="bi bi-send-fill text-primary"></i>
                                        Request Mentorship
                                    </h5>
                                    <p class="text-muted small mb-4">
                                        Introduce yourself and explain why you'd like this mentor's guidance.
                                    </p>
                                    <form method="POST" action="{{ route('student.mentorship-requests.store') }}"
                                          id="mentorship-request-form">
                                        @csrf
                                        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                        <div class="mb-3">
                                            <label for="message" class="form-label">
                                                Message to Mentor <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="message" id="message" rows="4"
                                                      class="form-control shadow-sm" required
                                                      placeholder="Hi! I'm interested in your expertise on... I'd love your guidance on..."></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary rounded-pill px-4 hover-lift-btn"
                                                    id="btn-send-request">
                                                <i class="bi bi-send me-2"></i>Send Request
                                            </button>
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
</x-app-layout>
