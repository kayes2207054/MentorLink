@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mentor Verification</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mentor Name</th>
                <th>Designation</th>
                <th>Verification Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentors as $mentor)
            <tr>
                <td>{{ $mentor->id }}</td>
                <td>{{ $mentor->name }}</td>
                <td>{{ $mentor->mentorProfile->designation ?? 'N/A' }}</td>
                <td>
                    @if($mentor->mentorProfile && $mentor->mentorProfile->is_verified)
                        <span class="badge bg-success">Verified</span>
                        <small class="d-block text-muted">{{ $mentor->mentorProfile->verified_at->format('M d, Y') }}</small>
                    @else
                        <span class="badge bg-warning text-dark">Unverified</span>
                    @endif
                </td>
                <td>
                    @if($mentor->mentorProfile)
                        <form method="POST" action="{{ route('admin.mentors.verify', $mentor->mentorProfile) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_verified" value="{{ $mentor->mentorProfile->is_verified ? 0 : 1 }}">
                            <button type="submit" class="btn btn-sm {{ $mentor->mentorProfile->is_verified ? 'btn-danger' : 'btn-success' }}">
                                {{ $mentor->mentorProfile->is_verified ? 'Remove Verification' : 'Verify Mentor' }}
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $mentors->links() }}
@endsection
