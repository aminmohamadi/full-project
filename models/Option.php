<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
      'key',
      'value'
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
        return static::where('key', $key)->first()->value ?? null;
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
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }
}
