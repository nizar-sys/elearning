<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'video',
    ];

    public function elearnings()
    {
        return $this->belongsToMany(Elearning::class, 'elearning_materials');
    }
}
