<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugable
{
    public static function bootSlugable()
    {
        static::creating(function ($model) {
            $source = $model->getSlugSource();
            $model->slug = Str::slug($source) . '-' . uniqid();
        });

        static::updating(function ($model) {
            $source = $model->getSlugSource();
            $model->slug = Str::slug($source) . '-' . uniqid();
        });
    }

    protected function getSlugSource()
    {
        return $this->{$this->slugSource ?? 'title'};
    }
}
