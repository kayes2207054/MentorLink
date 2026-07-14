<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_profile_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    public function mentorProfile()
    {
        return $this->belongsTo(MentorProfile::class);
    }
}
