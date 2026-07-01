<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Directory') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        .bootstrap-wrapper { font-family: 'Inter', sans-serif; }
        .mentor-card { transition: transform 0.2s, box-shadow 0.2s; }
        .mentor-card:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
        .skill-badge { font-weight: 500; font-size: 0.75rem; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bootstrap-wrapper">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0 text-gray-800">Find a Mentor</h3>
                </div>

                <div class="card bg-light border-0 mb-5">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('student.mentors.index') }}" class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                    <input type="text" name="search" placeholder="Search by name or keyword..." value="{{ request('search') }}" class="form-control border-start-0 py-2">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <select name="skill" class="form-select shadow-sm py-2">
                                    <option value="">All Skills</option>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}" {{ request('skill') == $skill->id ? 'selected' : '' }}>{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="sort" class="form-select shadow-sm py-2">
                                    <option value="">Newest</option>
                                    <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="most_reviewed" {{ request('sort') == 'most_reviewed' ? 'selected' : '' }}>Most Reviewed</option>
                                </select>
                            </div>

                            <div class="col-md-2 d-grid gap-2 d-md-flex">
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Filter</button>
                                @if(request('search') || request('skill') || request('sort'))
                                    <a href="{{ route('student.mentors.index') }}" class="btn btn-outline-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($mentors as $mentor)
                        <div class="col-md-6 col-lg-4">
                            <x-mentor-card :mentor="$mentor" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5 bg-light rounded-4 border border-dashed hover-lift">
                                <div class="bg-white rounded-circle d-inline-flex mx-auto p-4 mb-3 shadow-sm">
                                    <i class="bi bi-search fs-1 text-muted"></i>
                                </div>
                                <h5 class="fw-bold">No mentors found</h5>
                                <p class="text-muted">Try adjusting your search or filters to find what you're looking for.</p>
                                <a href="{{ route('student.mentors.index') }}" class="btn btn-primary mt-2 rounded-pill px-4 hover-lift-btn">Clear Filters</a>
                            </div>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-5 bootstrap-wrapper">
                    {{ $mentors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
