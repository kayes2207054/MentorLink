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
                    <input type="hidden" name="page" id="page-input" value="{{ request('page', 1) }}">
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
            <span id="mentor-count-badge" class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary-subtle">
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

        <div class="mt-5 d-flex justify-content-center" id="pagination-container">
            @if($mentors->hasPages())
                {{ $mentors->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('mentor-filter-form');
            const pageInput = document.getElementById('page-input');
            const resultsContainer = document.getElementById('mentor-results');
            const countBadge = document.getElementById('mentor-count-badge');
            const paginationContainer = document.getElementById('pagination-container');

            function fetchMentors() {
                const formData = new FormData(form);
                const params = new URLSearchParams(formData);
                const queryString = params.toString();

                // Update URL for shareability
                history.pushState(null, '', '?' + queryString);

                // Show loading state
                resultsContainer.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2 fw-medium">Searching mentors...</p>
                    </div>
                `;

                fetch('/api/mentors?' + queryString, {
                    headers: { 'Accept': 'application/json' }
                })
                .then(response => response.json())
                .then(json => {
                    renderMentors(json.data);
                    renderPagination(json.meta);
                    countBadge.textContent = `${json.meta.total} Available`;
                })
                .catch(error => {
                    console.error('Error fetching mentors:', error);
                    resultsContainer.innerHTML = `<div class="col-12 alert alert-danger">Error loading mentors. Please try again.</div>`;
                });
            }

            function renderMentors(mentors) {
                if (mentors.length === 0) {
                    resultsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-search"></i></div>
                                <h4 class="font-heading fw-bold">No Mentors Found</h4>
                                <p class="text-muted fs-5">We couldn't find any mentors matching your exact filters.</p>
                                <button type="button" class="btn btn-primary rounded-pill px-5 mt-3 fw-bold shadow" onclick="document.getElementById('mentor-filter-form').reset(); document.getElementById('page-input').value=1; document.getElementById('mentor-filter-form').dispatchEvent(new Event('submit'));">
                                    Reset Search
                                </button>
                            </div>
                        </div>
                    `;
                    return;
                }

                resultsContainer.innerHTML = mentors.map(mentor => `
                    <div class="col-md-6 col-xl-4">
                        <div class="mentor-card h-100 d-flex flex-column">
                            <div class="mentor-card-banner">
                                ${mentor.is_verified ? `
                                    <span class="badge position-absolute top-0 end-0 m-3 shadow-sm"
                                          style="background:rgba(255,255,255,0.9);color:#10b981;border:1px solid #10b981;"
                                          title="Verified Mentor">
                                        <i class="bi bi-patch-check-fill me-1"></i>Verified
                                    </span>
                                ` : ''}
                            </div>
                            
                            <div class="text-center px-4 pb-3" style="margin-top: -40px;">
                                <img src="${mentor.avatar_url}" 
                                     alt="${mentor.name}" 
                                     class="mentor-card-avatar mb-3">
                                
                                <h5 class="fw-bold font-heading mb-1 text-dark">${mentor.name}</h5>
                                <p class="text-primary fw-medium small mb-2">${mentor.designation}</p>
                                
                                <div class="d-flex justify-content-center align-items-center gap-1 mb-2">
                                    ${mentor.rating > 0 ? `
                                        <div class="text-warning" style="font-size: 0.9rem;">
                                            ${[1,2,3,4,5].map(i => `<i class="bi bi-star${i <= Math.round(mentor.rating) ? '-fill' : ''}"></i>`).join('')}
                                        </div>
                                        <span class="text-dark fw-bold small ms-1">${mentor.rating.toFixed(1)}</span>
                                        <span class="text-muted small ms-1">(${mentor.reviews_count})</span>
                                    ` : `
                                        <span class="badge bg-light text-muted border">New Mentor</span>
                                    `}
                                </div>
                            </div>
                            
                            <div class="card-body p-4 pt-2 d-flex flex-column border-top border-soft">
                                <div class="mb-4">
                                    <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.7rem; letter-spacing: 0.05em;">Top Skills</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        ${mentor.skills.length > 0 ? mentor.skills.slice(0, 3).map(skill => `
                                            <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">${skill.name}</span>
                                        `).join('') : `
                                            <span class="text-muted small fst-italic">General Guidance</span>
                                        `}
                                        ${mentor.skills_count > 3 ? `
                                            <span class="badge bg-light text-muted border">+${mentor.skills_count - 3}</span>
                                        ` : ''}
                                    </div>
                                </div>
                                
                                <div class="mt-auto">
                                    <a href="${mentor.profile_url}"
                                       class="btn btn-outline-primary w-100 hover-lift-btn fw-bold">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            function renderPagination(meta) {
                if (!meta || meta.last_page <= 1) {
                    paginationContainer.innerHTML = '';
                    return;
                }

                let html = '<nav><ul class="pagination">';
                meta.links.forEach(link => {
                    let webUrl = link.url ? link.url.replace('/api/mentors', '/student/mentors') : '#';
                    
                    html += `
                        <li class="page-item ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}">
                            ${link.url ? `
                                <a class="page-link ajax-page-link" href="${webUrl}" data-url="${link.url}">${link.label}</a>
                            ` : `
                                <span class="page-link">${link.label}</span>
                            `}
                        </li>
                    `;
                });
                html += '</ul></nav>';
                paginationContainer.innerHTML = html;
            }

            // Bind Form Submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                // If form is submitted via button, reset page to 1
                if (e.isTrusted) {
                    pageInput.value = 1;
                }
                fetchMentors();
            });

            // Bind Select Changes
            const selects = form.querySelectorAll('select');
            selects.forEach(select => {
                select.addEventListener('change', () => {
                    pageInput.value = 1;
                    fetchMentors();
                });
            });

            // Bind Pagination Clicks
            paginationContainer.addEventListener('click', function(e) {
                const link = e.target.closest('.ajax-page-link');
                if (link) {
                    e.preventDefault();
                    const url = new URL(link.href);
                    pageInput.value = url.searchParams.get('page') || 1;
                    fetchMentors();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    </script>
</x-app-layout>
