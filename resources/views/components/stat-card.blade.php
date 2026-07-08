@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'opacity' => '10'
])

<div class="card stat-card border-0 h-100">
    <div class="card-body p-4 d-flex align-items-center">
        <div class="bg-{{ $color }} bg-opacity-{{ $opacity }} text-{{ $color }} d-flex align-items-center justify-content-center me-4 stat-icon-wrapper" style="width: 64px; height: 64px;">
            <i class="bi bi-{{ $icon }} fs-2"></i>
        </div>
        <div>
            <h6 class="text-uppercase fw-bold mb-1 text-muted small" style="letter-spacing: 0.05em;">{{ $title }}</h6>
            <h2 class="mb-0 fw-bold font-heading text-dark">{{ $value }}</h2>
        </div>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: var(--bs-{{ $color }}); opacity: 0.8;"></div>
</div>
