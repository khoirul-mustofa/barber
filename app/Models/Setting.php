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
     * @var array
     */
    protected $casts = [
        'value' => 'string',
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
     * @param  mixed  $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever(self::CACHE_KEY, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        $value = $settings[$key] ?? $default;

        // Try to decode if looks like JSON
        if (is_string($value) && (str_starts_with($value, '[') || str_starts_with($value, '{'))) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $value;
    }

    /**
     * Set a setting value
     *
     * @param  mixed  $value
     */
    public static function set(string $key, $value, string $type = 'string', ?string $description = null): bool
    {
        $setting = self::firstOrNew(['key' => $key]);

        if (is_array($value)) {
            $value = json_encode(array_values(array_unique(array_filter($value, fn ($v) => $v !== '' && $v !== null))));
            $type = 'json';
        }

        $setting->value = (string) ($value ?? '');
        $setting->type = $type;
        if ($description) {
            $setting->description = $description;
        }

        $result = $setting->save();

        // Clear cache explicitly
        Cache::forget(self::CACHE_KEY);

        return $result;
    }

    /**
     * Check if a setting exists
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
