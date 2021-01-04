<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;

class DiamondShape extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_shapes";
    public $timestamps = true;

    protected $fillable = [
        'name'
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

    /**
     * Get list of shapes
     */
    public static function getList()
    {
        return DiamondShape::get()->pluck('name', 'id');
    }

    /**
     * Get objects of shapes
     */
    public static function getObjects()
    {
        return DiamondShape::select('id', 'name')->get();
    }
}
