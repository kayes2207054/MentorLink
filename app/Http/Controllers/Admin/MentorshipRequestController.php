<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;

class MentorshipRequestController extends Controller
{
    public function index()
    {
        $requests = MentorshipRequest::with(['mentor', 'student'])->latest()->paginate(15);

        $total = MentorshipRequest::count();
        $pending = MentorshipRequest::where('status', 'pending')->count();
        $accepted = MentorshipRequest::where('status', 'accepted')->count();
        $rejected = MentorshipRequest::where('status', 'rejected')->count();

        return view('admin.mentorship-requests.index', compact('requests', 'total', 'pending', 'accepted', 'rejected'));
    }
}
