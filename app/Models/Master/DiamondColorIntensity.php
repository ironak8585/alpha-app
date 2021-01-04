<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;


class DiamondColorIntensity extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_color_intensities";
    public $timestamps = true;

    protected $fillable = [
        'name', 'is_white'
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope('name', 'asc'));
    }

    /**
     * Mutators and Accessors
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }
    public function getColorTypeAttribute()
    {
        return $this->is_white ? 'White' : 'Color';
    }
}
