<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;

class DiamondPolish extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_polishes";
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
     * Get list of polishes
     */
    public static function getList()
    {
        return DiamondPolish::get()->pluck('name', 'id');
    }

    /**
     * Get objects of polishes
     */
    public static function getObjects()
    {
        return DiamondPolish::select('id', 'name')->get();
    }
}
