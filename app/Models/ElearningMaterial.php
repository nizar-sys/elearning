<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearningMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'elearning_id',
        'material_id',
    ];

    public function elearning()
    {
        return $this->belongsTo(Elearning::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
