@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'trend' => null,
    'trendLabel' => null
])

<div class="card stat-card border-0 h-100">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="text-muted fw-medium mb-2" style="font-size: 0.85rem;">{{ $title }}</h6>
                <h2 class="mb-0 fw-bold font-heading text-dark" style="letter-spacing: -0.02em; font-size: 2rem;">{{ $value }}</h2>
            </div>
            <div class="dash-section-icon bg-{{ $color }} shadow-sm">
                <i class="bi bi-{{ $icon }}"></i>
            </div>
        </div>
        
        @if($trend || $trendLabel)
        <div class="mt-3 pt-3 border-top border-soft d-flex align-items-center">
            @if($trend)
                <span class="badge bg-{{ str_starts_with($trend, '-') ? 'danger' : 'success' }} bg-opacity-10 text-{{ str_starts_with($trend, '-') ? 'danger' : 'success' }} me-2 border-0 px-2 py-1">
                    <i class="bi bi-arrow-{{ str_starts_with($trend, '-') ? 'down' : 'up' }}-short"></i>
                    {{ trim($trend, '+-') }}%
                </span>
            @endif
            @if($trendLabel)
                <small class="text-muted">{{ $trendLabel }}</small>
            @endif
        </div>
        @endif
    </div>
</div>
