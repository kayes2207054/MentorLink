<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1 text-white font-heading display-6 fw-bold">
                    Mentor Directory
                </h2>
                <p class="mb-0 text-white opacity-75 fs-5">
                    Connect with industry experts and accelerate your growth.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="fade-in">
        {{-- Search & Filter Card --}}
        <div class="card card-elevated mb-5 border-0 shadow-lg" style="margin-top: -2rem; position: relative; z-index: 20;">
            <div class="card-body p-4 p-md-5">
                <form method="GET" action="{{ route('student.mentors.index') }}" id="mentor-filter-form">
                    <div class="row g-3">
                        <div class="col-lg-12 mb-2">
                            <div class="input-group input-group-lg shadow-sm border rounded-pill overflow-hidden">
                                <span class="input-group-text bg-white border-0 ps-4 text-primary">
                                    <i class="bi bi-search fs-5"></i>
                                </span>
                                <input type="text" name="search"
                                       class="form-control border-0 px-3 shadow-none bg-white"
                                       placeholder="Search by name, keyword or skill..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary px-5 fw-bold text-uppercase" style="letter-spacing: 0.05em; border-radius: 0 50rem 50rem 0;">
                                    Search
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Expertise Area</label>
                            <select name="skill" class="form-select bg-light border-0 shadow-none fw-medium">
                                <option value="">All Skills</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ request('skill') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Minimum Rating</label>
                            <select name="min_rating" class="form-select bg-light border-0 shadow-none fw-medium text-warning">
                                <option value="" class="text-dark">Any Rating</option>
                                <option value="5" {{ request('min_rating') == '5' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9733; 5 Stars</option>
                                <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9733;&#9734; 4+ Stars</option>
                                <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>&#9733;&#9733;&#9733;&#9734;&#9734; 3+ Stars</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small ms-1">Sort By</label>
                            <div class="d-flex gap-2">
                                <select name="sort" class="form-select bg-light border-0 shadow-none fw-medium flex-grow-1">
                                    <option value="">Newest First</option>
                                    <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="most_reviewed" {{ request('sort') == 'most_reviewed' ? 'selected' : '' }}>Most Reviewed</option>
                                </select>
                                @if(request('search') || request('skill') || request('min_rating') || request('sort'))
                                    <a href="{{ route('student.mentors.index') }}" class="btn btn-light border text-danger" title="Clear Filters">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="font-heading fw-bold mb-0">Our Mentors</h4>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary-subtle">
                {{ $mentors->total() }} Available
            </span>
        </div>

        <div class="row g-4 fade-in-stagger" id="mentor-results">
            @forelse($mentors as $mentor)
                <div class="col-md-6 col-xl-4">
                    <x-mentor-card :mentor="$mentor" />
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="bi bi-search"></i></div>
                        <h4 class="font-heading fw-bold">No Mentors Found</h4>
                        <p class="text-muted fs-5">We couldn't find any mentors matching your exact filters.</p>
                        <a href="{{ route('student.mentors.index') }}" class="btn btn-primary rounded-pill px-5 mt-3 fw-bold shadow">
                            Reset Search
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($mentors->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $mentors->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</x-app-layout>
