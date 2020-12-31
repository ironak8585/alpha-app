<?php

namespace App\Models\Master;

use App\Scopes\OrderScope;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class Configuration extends Model
{
    protected $table = "master_configurations";
    public $timestamps = true;
    protected $fillable = [
        'category', 'name', 'key', 'value', 'type',
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
        static::addGlobalScope(new OrderScope('key', 'asc'));
    }

    /**
     * Mutators
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = Str::upper((Str::snake($value)));
    }

    /**
     * Get value for supplied key
     *
     * @param string $key
     * @return Configuration
     * @return mixed
     */
    public static function getValue($key)
    {
        if (Session::exists($key)) {
            //retrieve value from session
            $value = Session::get($key);
        } else {
            //retrive value from database
            $conf = Configuration::where('key', '=', $key)->get()->first();

            switch ($conf->type) {
                case 'INT':
                    $value = intval($conf->value);
                    break;
                case 'FLOAT':
                    $value = floatval($conf->value);
                    break;
                case 'BOOL':
                    $value = filter_var($conf->value, FILTER_VALIDATE_BOOLEAN);
                    break;
                case 'DATE':
                    $value = Carbon::createFromTimestamp(strtotime($conf->value));
                    break;
                default:
                    $value = $conf->value;
                    break;
            }

            //preserve value in session
            Session::put($key, $value);
        }
        return $value;
    }

    /**
     * Get list of configurations
     *
     * @return void
     */
    public static function getList()
    {
        //get all configurations
        $configs = Configuration::get();
        $settings = [];
        foreach ($configs as $conf) {
            switch ($conf->type) {
                case 'INT':
                    $value = intval($conf->value);
                    break;
                case 'FLOAT':
                    $value = floatval($conf->value);
                    break;
                case 'BOOL':
                    $value = filter_var($conf->value, FILTER_VALIDATE_BOOLEAN);
                    break;
                case 'DATE':
                    $value = Carbon::createFromTimestamp(strtotime($conf->value));
                    break;
                default:
                    $value = $conf->value;
            }
            $settings[$conf->key] = $value;
        }
        return $settings;
    }

    /**
     * Update single records
     *
     * @param array $data
     * @return void
     */
    public function safeUpdate($data)
    {
        $this->fill($data);
        try {
            $this->save();

            //update session value
            if (Session::exists($this->key)) {
                //dd($key, $value);
                Session::put($this->key, $this->value);
            }
        } catch (\Throwable $th) {
            throw new Exception("Update error : $this->key " . $th->getMessage(), 1);
        }
    }

    /**
     * Update mutiple records
     *
     * @param array $data
     * @return void
     */
    public static function updateMany($data)
    {
        DB::beginTransaction();
        foreach ($data as $key => $value) {
            try {
                Configuration::where('key', $key)->update(['value' => $value]);
            } catch (\Throwable $th) {
                DB::rollback();
                throw new Exception("Update error : $key " . $th->getMessage(), 1);
            }
        }
        DB::commit();

        //Update session
        foreach ($data as $key => $value) {
            //update session value
            if (Session::exists($key)) {
                Session::put($key, $value);
            }
        }
    }

    /**
     * Get vistar labels
     *
     * @return void
     */
    public static function getVistarLabels()
    {
        return [
            'distict' => Configuration::getValue('VISTAR_DISTRICT_LABEL'),
            'tehsil' => Configuration::getValue('VISTAR_TEHSIL_LABEL'),
            'group' => Configuration::getValue('VISTAR_GROUP_LABEL'),
            'village' => Configuration::getValue('VISTAR_VILLAGE_LABEL'),
        ];
    }
}
