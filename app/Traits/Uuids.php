<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
    /**
     * Boot function from Laravel.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->keyType = 'string';
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    // public function getIncrementing()
    // {
    //     return false;
    // }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    // public function getKeyType()
    // {
    //     return 'string';
    // }
}
