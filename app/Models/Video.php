<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'description',
        'thumbnail',
        'video',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'video_categories', 'video_id', 'category_id');
    }
}
