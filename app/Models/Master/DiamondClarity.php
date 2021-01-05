<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
use Illuminate\Support\Str;

class DiamondClarity extends Model
{
    use UuidTrait;

    protected $table = "master_diamond_clarities";
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
     * Get list of clarities
     */
    public static function getList()
    {
        return DiamondClarity::get()->pluck('name', 'id');
    }

    /**
     * Get objects of clarities
     */
    public static function getObjects()
    {
        return DiamondClarity::select('id', 'name', 'code')->get();
    }
}
