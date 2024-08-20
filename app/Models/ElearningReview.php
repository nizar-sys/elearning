<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearningReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'elearning_id',
        'reviewer_id',
        'review',
        'rating',
    ];

    public function elearning()
    {
        return $this->belongsTo(Elearning::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
