<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory, Slugable;

    protected $fillable = ['type', 'slug', 'description'];
    protected $slugSource = 'type';
}
