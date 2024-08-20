<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Slugable;

    protected $fillable = ['name', 'slug', 'description'];
    protected $slugSource = 'name';

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_categories', 'category_id', 'video_id');
    }

    public function elearnings()
    {
        return $this->belongsToMany(Elearning::class, 'elearning_categories', 'category_id', 'elearning_id');
    }
}
