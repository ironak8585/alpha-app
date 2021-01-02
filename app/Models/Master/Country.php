<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Master\CountryImport;
use Exception;

class Country extends Model
{

    protected $table = "master_countries";
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
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
     * Import records from file
     *
     * @param string $file - path of file
     * @return boolean
     */
    public static function import($file)
    {
        try {
            $import = new CountryImport();
            Excel::import($import, $file);
            return true;
        } catch (ValidationException $th) {
            throw $th;
        } catch (Exception $th) {
            throw $th;
        }
    }
}
