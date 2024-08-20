<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'category_id',
        'created_by',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function scopeStatus($query, $status = 'published')
    {
        return $query->where('status', $status);
    }
}
