<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elearning extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'teacher_id',
        'benefit_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'duration',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function benefit()
    {
        return $this->belongsTo(Benefit::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'elearning_categories');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'elearning_materials');
    }

    public function reviews()
    {
        return $this->hasMany(ElearningReview::class);
    }
}
