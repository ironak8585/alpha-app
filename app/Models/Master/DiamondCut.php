<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;

class DiamondCut extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_cuts";
    public $timestamps = true;

    protected $fillable = [
        'code', 'name'
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
     * Get list of cuts
     */
    public static function getList()
    {
        return DiamondCut::get()->pluck('name', 'id');
    }

    /**
     * Get objects of cuts
     */
    public static function getObjects()
    {
        return DiamondCut::select('id', 'name')->get();
    }
}
