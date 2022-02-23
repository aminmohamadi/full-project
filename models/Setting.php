<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
//    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'is_translatable', 'plain_value'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_translatable' => 'boolean',
    ];

    /**
     * Determine if the given setting key exists.
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return static::where('key', $key)->exists();
    }

    /**
     * Get setting for the given key.
     *
     * @param string $key
     * @return string|array
     */
    public static function get($key)
    {
        return static::where('key', $key)->first()->plain_value;
    }

    /**
     * Set the given settings.
     *
     * @param array $settings
     * @return void
     */
    /**
     * Set the given setting.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
    }

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }


}
