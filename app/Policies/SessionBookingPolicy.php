<?php

namespace App\Policies;

use App\Models\SessionBooking;
use App\Models\User;

class SessionBookingPolicy
{
    public function cancel(User $user, SessionBooking $sessionBooking): bool
    {
        return $user->id === $sessionBooking->student_id && $sessionBooking->status === 'pending';
    }

    public function manage(User $user, SessionBooking $sessionBooking): bool
    {
        return $user->id === $sessionBooking->mentor_id;
    }
}
