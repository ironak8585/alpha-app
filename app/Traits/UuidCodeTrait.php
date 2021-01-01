<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UuidCodeTrait
{
    protected static function bootUuidCodeTrait()
    {
        static::creating(function ($model) {
            $model->code = Str::uuid();
        });
    }

    /**
     * Get model by code field
     *
     * @param string $code
     * @return Model
     */
    public function findCode($code)
    {
        return $this->where('code', $code)->first();
    }
}
