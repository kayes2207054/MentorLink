@props(['mentor'])

<div class="card h-100 border-0 mentor-card overflow-hidden" style="box-shadow:0 4px 16px rgba(0,0,0,.07);border-radius:1.25rem!important;">
    <div class="position-relative p-4 text-center border-bottom border-soft" style="background:linear-gradient(160deg,#f8fafc 0%,#f1f5f9 100%)">
        @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
            <span class="badge position-absolute top-0 end-0 m-3 shadow-sm rounded-pill"
                  style="background:#d1fae5;color:#065f46;border:1px solid #6ee7b7;font-size:.7rem;font-weight:700;"
                  title="Verified Mentor" aria-label="Verified Mentor">
                <i class="bi bi-patch-check-fill me-1"></i>Verified
            </span>
        @endif
        <img src="https://ui-avatars.com/api/?name={{ urlencode($mentor->name) }}&background=4f46e5&color=fff&size=200" 
             alt="{{ $mentor->name }}" 
             class="rounded-circle shadow-sm mb-3" style="width:90px;height:90px;object-fit:cover;border:4px solid #fff;">
        <h5 class="fw-bold mb-1">{{ $mentor->name }}</h5>
        <p class="text-muted small mb-2"><i class="bi bi-briefcase me-1"></i>{{ $mentor->mentorProfile->designation ?? 'Professional Mentor' }}</p>
        
        <div class="d-flex justify-content-center gap-1 mb-2 align-items-center">
            @php $rating = $mentor->reviews_received_avg_rating ?? 0; @endphp
            @if($rating > 0)
                <div class="star-rating" aria-label="Rating: {{ number_format($rating, 1) }} out of 5">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }}"></i>
                    @endfor
                </div>
                <span class="text-muted small ms-1 fw-bold">{{ number_format($rating, 1) }}</span>
            @else
                <span class="badge rounded-pill px-2 py-1" style="background:#ede9fe;color:#4f46e5;font-size:.7rem;font-weight:700;">New Mentor</span>
            @endif
        </div>
    </div>
    
    <div class="card-body p-4 d-flex flex-column">
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-muted small mb-2 tracking-wide">Expertise</h6>
            <div class="d-flex flex-wrap gap-2">
                @if($mentor->mentorProfile && $mentor->mentorProfile->skills)
                    @forelse($mentor->mentorProfile->skills->take(4) as $skill)
                        <span class="badge rounded-pill px-2 py-1" style="background:#ede9fe;color:#4f46e5;font-size:.72rem;font-weight:600;">{{ $skill->name }}</span>
                    @empty
                        <span class="text-muted small fst-italic">No skills listed</span>
                    @endforelse
                    @if($mentor->mentorProfile->skills->count() > 4)
                        <span class="badge rounded-pill px-2 py-1" style="background:#f1f5f9;color:#475569;font-size:.72rem;">+{{ $mentor->mentorProfile->skills->count() - 4 }} more</span>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center small text-muted mb-3 border-top pt-3">
                <span><i class="bi bi-building me-1"></i>{{ $mentor->mentorProfile->department->name ?? 'N/A' }}</span>
                <span><i class="bi bi-chat-text me-1"></i>{{ $mentor->reviews_received_count ?? 0 }} Reviews</span>
            </div>
            
            <a href="{{ route('student.mentors.show', $mentor->id) }}"
               class="btn btn-primary w-100 rounded-pill hover-lift-btn">
                <i class="bi bi-person-fill me-1"></i>View Profile
            </a>
        </div>
    </div>
</div>
