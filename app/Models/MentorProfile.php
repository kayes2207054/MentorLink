<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MentorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation',
        'experience',
        'bio',
        'is_verified',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availabilities()
    {
        return $this->hasMany(MentorAvailability::class);
    }

    public function averageRating()
    {
        return $this->user->reviewsReceived()->avg('rating') ?? 0;
    }

    public function totalReviews()
    {
        return $this->user->reviewsReceived()->count();
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'mentor_skill');
    }
}
