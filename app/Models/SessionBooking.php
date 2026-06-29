<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionBooking extends Model
{
    protected $fillable = [
        'mentor_id',
        'student_id',
        'availability_id',
        'booking_date',
        'status',
        'note',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function availability()
    {
        return $this->belongsTo(MentorAvailability::class, 'availability_id');
    }
}
