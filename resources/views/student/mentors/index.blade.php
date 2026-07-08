<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="mb-0 text-white">
                    <i class="bi bi-search me-2 opacity-75"></i>Mentor Directory
                </h2>
                <p class="mb-0 mt-1 text-white opacity-75 small">
                    Find and connect with expert mentors in your field
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">

        {{-- Search & Filter Card --}}
        <div class="card card-elevated mb-4">
            <div class="card-header bg-white px-4 py-3 border-bottom border-soft d-flex align-items-center gap-2">
                <span class="d-inline-flex p-1 rounded-2" style="background:#ede9fe;">
                    <i class="bi bi-funnel-fill text-primary" style="font-size:.85rem;"></i>
                </span>
                <h6 class="mb-0 fw-bold">Filter Mentors</h6>
            </div>
            <div class="card-body p-4">
                <form method="GET" action="{{ route('student.mentors.index') }}" id="mentor-filter-form">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search"
                                       class="form-control"
                                       id="mentor-search-input"
                                       placeholder="Search by name, keyword or skill..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <select name="skill" class="form-select" id="filter-skill">
                                <option value="">All Skills</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}"
                                            {{ request('skill') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="min_rating" class="form-select" id="filter-rating">
                                <option value="">Any Rating</option>
                                <option value="5" {{ request('min_rating') == '5' ? 'selected' : '' }}>
                                    ⭐⭐⭐⭐⭐ 5 Stars
                                </option>
                                <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>
                                    ⭐⭐⭐⭐ 4+ Stars
                                </option>
                                <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>
                                    ⭐⭐⭐ 3+ Stars
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="sort" class="form-select" id="filter-sort">
                                <option value="">Newest First</option>
                                <option value="highest_rated"  {{ request('sort') == 'highest_rated'  ? 'selected' : '' }}>Highest Rated</option>
                                <option value="most_reviewed"  {{ request('sort') == 'most_reviewed'  ? 'selected' : '' }}>Most Reviewed</option>
                                <option value="alphabetical"   {{ request('sort') == 'alphabetical'   ? 'selected' : '' }}>Alphabetical A-Z</option>
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1 hover-lift-btn" id="btn-apply-filter">
                                <i class="bi bi-funnel me-1"></i>Apply Filters
                            </button>
                            @if(request('search') || request('skill') || request('min_rating') || request('sort'))
                                <a href="{{ route('student.mentors.index') }}"
                                   class="btn px-3"
                                   id="btn-reset-filter"
                                   style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;"
                                   title="Clear all filters">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results Area --}}
        @if(request('search') || request('skill') || request('min_rating') || request('sort'))
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="text-muted small">
                    Showing <strong>{{ $mentors->count() }}</strong> result(s)
                    @if(request('search'))
                        for "<strong>{{ request('search') }}</strong>"
                    @endif
                </span>
            </div>
        @endif

        <div class="row g-4 fade-in-stagger" id="mentor-results">
            @forelse($mentors as $mentor)
                <div class="col-md-6 col-lg-4">
                    <x-mentor-card :mentor="$mentor" />
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state" id="empty-mentors">
                        <div class="empty-state-icon">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <h5>No Mentors Found</h5>
                        <p>Try adjusting your search or filters to find what you're looking for.</p>
                        <a href="{{ route('student.mentors.index') }}"
                           class="btn btn-primary mt-3 rounded-pill px-4 hover-lift-btn"
                           id="btn-clear-filters">
                            <i class="bi bi-arrow-clockwise me-2"></i>Clear Filters
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($mentors->hasPages())
            <div class="mt-5">
                {{ $mentors->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</x-app-layout>
