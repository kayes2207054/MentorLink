@props(['mentor'])

<div class="mentor-card h-100 d-flex flex-column">
    <div class="mentor-card-banner">
        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
            <span class="badge position-absolute top-0 end-0 m-3 shadow-sm"
                  style="background:rgba(255,255,255,0.9);color:#10b981;border:1px solid #10b981;"
                  title="Verified Mentor">
                <i class="bi bi-patch-check-fill me-1"></i>Verified
            </span>
        @endif
    </div>
    
    <div class="text-center px-4 pb-3" style="margin-top: -40px;">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=150" 
             alt="{{ $mentor->name }}" 
             class="mentor-card-avatar mb-3">
        
        <h5 class="fw-bold font-heading mb-1 text-dark">{{ $mentor->name }}</h5>
        <p class="text-primary fw-medium small mb-2">{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>
        
        <div class="d-flex justify-content-center align-items-center gap-1 mb-2">
            @php $rating = $mentor->reviews_received_avg_rating ?? 0; @endphp
            @if($rating > 0)
                <div class="text-warning" style="font-size: 0.9rem;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                    @endfor
                </div>
                <span class="text-dark fw-bold small ms-1">{{ number_format($rating, 1) }}</span>
                <span class="text-muted small ms-1">({{ $mentor->reviews_received_count ?? 0 }})</span>
            @else
                <span class="badge bg-opacity-10 bg-secondary text-muted border border-soft">New Mentor</span>
            @endif
        </div>
    </div>
    
    <div class="card-body p-4 pt-2 d-flex flex-column border-top border-soft">
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.7rem; letter-spacing: 0.05em;">Top Skills</h6>
            <div class="d-flex flex-wrap gap-2">
                @if($mentor->mentorProfile && $mentor->mentorProfile->skills)
                    @forelse($mentor->mentorProfile->skills->take(3) as $skill)
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">{{ $skill->name }}</span>
                    @empty
                        <span class="text-muted small fst-italic">General Guidance</span>
                    @endforelse
                    @if($mentor->mentorProfile->skills->count() > 3)
                        <span class="badge bg-opacity-10 bg-secondary text-muted border border-soft">+{{ $mentor->mentorProfile->skills->count() - 3 }}</span>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="mt-auto">
            <a href="{{ route('student.mentors.show', $mentor->id) }}"
               class="btn btn-outline-primary w-100 hover-lift-btn fw-bold">
                View Profile
            </a>
        </div>
    </div>
</div>
