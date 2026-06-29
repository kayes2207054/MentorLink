@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Total Students</h5>
                <h2 class="display-4">{{ $totalStudents }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Total Mentors</h5>
                <h2 class="display-4">{{ $totalMentors }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-info h-100">
            <div class="card-body">
                <h5 class="card-title">Verified Mentors</h5>
                <h2 class="display-4">{{ $verifiedMentors }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Pending Requests</h5>
                <h2 class="display-4">{{ $pendingRequests }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <h5 class="card-title">Total Departments</h5>
                <h2 class="display-4">{{ $totalDepartments }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-dark h-100">
            <div class="card-body">
                <h5 class="card-title">Total Skills</h5>
                <h2 class="display-4">{{ $totalSkills }}</h2>
            </div>
        </div>
    </div>
</div>

<h2 class="h3 mt-4 mb-3">Session Bookings</h2>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Total</h5>
                <h2 class="display-5">{{ $totalSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-4">
        <div class="card text-dark bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <h2 class="display-5">{{ $pendingSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Accepted</h5>
                <h2 class="display-5">{{ $acceptedSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-4">
        <div class="card text-white bg-info h-100">
            <div class="card-body">
                <h5 class="card-title">Completed</h5>
                <h2 class="display-5">{{ $completedSessions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <h5 class="card-title">Cancelled/Rejected</h5>
                <h2 class="display-5">{{ $cancelledSessions }}</h2>
            </div>
        </div>
    </div>
</div>

<h2 class="h3 mt-4 mb-3">Reviews & Ratings</h2>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-dark h-100">
            <div class="card-body">
                <h5 class="card-title">Total Reviews</h5>
                <h2 class="display-4">{{ $totalReviews }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-success text-white">Highest Rated Mentors</div>
            <ul class="list-group list-group-flush">
                @forelse($highestRatedMentors as $mentor)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $mentor->name }}
                        <span>{{ number_format($mentor->reviews_received_avg_rating, 1) }} ⭐ ({{ $mentor->reviews_received_count }})</span>
                    </li>
                @empty
                    <li class="list-group-item">No reviews yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-danger text-white">Lowest Rated Mentors</div>
            <ul class="list-group list-group-flush">
                @forelse($lowestRatedMentors as $mentor)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $mentor->name }}
                        <span>{{ number_format($mentor->reviews_received_avg_rating, 1) }} ⭐ ({{ $mentor->reviews_received_count }})</span>
                    </li>
                @empty
                    <li class="list-group-item">No reviews yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
