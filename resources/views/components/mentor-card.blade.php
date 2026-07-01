@props(['mentor'])

<div class="card h-100 border-0 shadow-sm mentor-card hover-lift rounded-4 overflow-hidden">
    <div class="position-relative bg-light p-4 text-center border-bottom border-light">
        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
            <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm rounded-pill" title="Verified Mentor" aria-label="Verified Mentor">
                <i class="bi bi-patch-check-fill me-1"></i>Verified
            </span>
        @endif
        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=0d6efd&color=fff&size=120" 
             alt="{{ $mentor->name }}'s Avatar" 
             class="rounded-circle border border-white border-4 shadow-sm mb-3" style="width: 100px; height: 100px; object-fit: cover;">
        <h5 class="fw-bold mb-1">{{ $mentor->name }}</h5>
        <p class="text-muted small mb-2"><i class="bi bi-briefcase me-1"></i>{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>
        
        <div class="d-flex justify-content-center gap-1 mb-2 align-items-center">
            @php $rating = $mentor->reviews_received_avg_rating ?? 0; @endphp
            @if($rating > 0)
                <div class="text-warning small" aria-label="Rating: {{ number_format($rating, 1) }} out of 5">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($rating))
                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted small ms-1 fw-bold">({{ number_format($rating, 1) }})</span>
            @else
                <span class="text-muted small fst-italic">New Mentor</span>
            @endif
        </div>
    </div>
    
    <div class="card-body p-4 d-flex flex-column">
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-muted small mb-2 tracking-wide">Expertise</h6>
            <div class="d-flex flex-wrap gap-2">
                @if($mentor->mentorProfile && $mentor->mentorProfile->skills)
                    @forelse($mentor->mentorProfile->skills->take(4) as $skill)
                        <span class="badge bg-light text-dark border border-secondary border-opacity-10 rounded-pill px-2 py-1">{{ $skill->name }}</span>
                    @empty
                        <span class="text-muted small fst-italic">No skills listed</span>
                    @endforelse
                    @if($mentor->mentorProfile->skills->count() > 4)
                        <span class="badge bg-light text-dark border border-secondary border-opacity-10 rounded-pill px-2 py-1">+{{ $mentor->mentorProfile->skills->count() - 4 }}</span>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center small text-muted mb-3 border-top pt-3">
                <span><i class="bi bi-building me-1"></i>{{ $mentor->mentorProfile->department->name ?? 'N/A' }}</span>
                <span><i class="bi bi-chat-text me-1"></i>{{ $mentor->reviews_received_count ?? 0 }} Reviews</span>
            </div>
            
            <a href="{{ route('student.mentors.show', $mentor->id) }}" class="btn btn-outline-primary w-100 rounded-pill hover-lift-btn">
                <i class="bi bi-person-fill me-1"></i>View Profile
            </a>
        </div>
    </div>
</div>
