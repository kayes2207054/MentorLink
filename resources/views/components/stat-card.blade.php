@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'opacity' => '10'
])

<div class="card border-0 shadow-sm h-100 hover-lift stat-card">
    <div class="card-body p-4 d-flex align-items-center">
        <div class="bg-{{ $color }} bg-opacity-{{ $opacity }} text-{{ $color }} rounded-circle d-flex align-items-center justify-content-center me-3 stat-icon-wrapper" style="width: 56px; height: 56px;">
            <i class="bi bi-{{ $icon }} fs-3"></i>
        </div>
        <div>
            <h6 class="text-uppercase fw-bold mb-1 text-muted small tracking-wide">{{ $title }}</h6>
            <h2 class="mb-0 fw-bold">{{ $value }}</h2>
        </div>
    </div>
</div>
