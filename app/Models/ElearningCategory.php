<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearningCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'elearning_id',
        'category_id',
    ];

    public function elearning()
    {
        return $this->belongsTo(Elearning::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
