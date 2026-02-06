<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    /**
     * Cache key for settings
     */
    const CACHE_KEY = 'app_settings';

    /**
     * Boot the model and register events
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when settings are saved or deleted
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * Get a setting value by key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever(self::CACHE_KEY, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value
     * 
     * @param string $key
     * @param mixed $value
     * @param string $type
     * @param string|null $description
     * @return bool
     */
    public static function set(string $key, $value, string $type = 'string', ?string $description = null): bool
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->type = $type;
        if ($description) {
            $setting->description = $description;
        }
        
        return $setting->save();
    }

    /**
     * Check if a setting exists
     * 
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        $settings = Cache::rememberForever(self::CACHE_KEY, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        return array_key_exists($key, $settings);
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
