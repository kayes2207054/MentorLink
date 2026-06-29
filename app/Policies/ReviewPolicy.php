<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Review $review)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === User::ROLE_STUDENT;
    }

    public function update(User $user, Review $review)
    {
        return $user->id === $review->student_id && $review->created_at->diffInDays(now()) <= 7;
    }

    public function delete(User $user, Review $review)
    {
        if ($user->role === User::ROLE_ADMIN) {
            return true;
        }

        return $user->id === $review->student_id && $review->created_at->diffInDays(now()) <= 7;
    }
}
