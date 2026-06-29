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
@endsection
