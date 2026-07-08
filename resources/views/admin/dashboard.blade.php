@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-soft">
    <div>
        <h2 class="fw-bold font-heading text-dark mb-1">Platform Overview</h2>
        <p class="text-muted mb-0 fs-5">Real-time metrics and system health</p>
    </div>
    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fw-bold shadow-sm d-flex align-items-center gap-2">
        <span class="spinner-grow spinner-grow-sm text-success" role="status"></span> System Online
    </span>
</div>

<div class="row g-4 mb-5 fade-in-stagger">
    {{-- High-level Colored Stats --}}
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-people-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Total Users</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-mortarboard-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Active Students</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalStudents }}</h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-person-badge-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Verified Mentors</p>
                <h2 class="display-5 fw-bold mb-0">{{ $verifiedMentors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card stat-colored border-0 h-100 shadow" style="background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-star-fill position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <p class="text-uppercase fw-bold mb-2 text-white opacity-75 small tracking-wide">Avg Platform Rating</p>
                <h2 class="display-5 fw-bold mb-0">{{ number_format($averagePlatformRating, 1) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5 fade-in-stagger">
    <div class="col-lg-8">
        <div class="card card-elevated h-100 border-0">
            <div class="card-header bg-white border-bottom border-soft p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                    <i class="bi bi-activity"></i>
                </div>
                <h5 class="mb-0 fw-bold font-heading">Platform Activity</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 text-center">
                    <div class="col-sm-4 border-end border-soft">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Total Requests</p>
                        <h3 class="fw-bold text-dark">{{ $totalRequests }}</h3>
                    </div>
                    <div class="col-sm-4 border-end border-soft">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Completed Sessions</p>
                        <h3 class="fw-bold text-success">{{ $completedSessions }}</h3>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-muted text-uppercase fw-bold small mb-2">Total Reviews</p>
                        <h3 class="fw-bold text-warning">{{ $totalReviews }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card card-elevated h-100 border-0 bg-dark text-white shadow-lg overflow-hidden relative">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="bg-white bg-opacity-10 p-3 rounded-circle mb-3">
                    <i class="bi bi-building fs-1 text-white"></i>
                </div>
                <h4 class="font-heading fw-bold mb-1">{{ $totalDepartments }} Departments</h4>
                <p class="text-white-50 mb-4">{{ $totalSkills }} Registered Skills</p>
                <a href="{{ route('admin.departments.index') }}" class="btn btn-light rounded-pill px-4 fw-bold text-dark">Manage Catalog</a>
            </div>
        </div>
    </div>
</div>

@endsection
