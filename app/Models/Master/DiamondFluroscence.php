<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;

class DiamondFluroscence extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_fluroscences";
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
     * Get list of fluroscences
     */
    public static function getList()
    {
        return DiamondFluroscence::get()->pluck('name', 'id');
    }

    /**
     * Get objects of fluroscences
     */
    public static function getObjects()
    {
        return DiamondFluroscence::select('id', 'name')->get();
    }
}
