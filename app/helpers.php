<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get or set application settings
     * 
     * Usage:
     * - Get: setting('FONNTE_TOKEN')
     * - Get with default: setting('FONNTE_TOKEN', 'default-value')
     * - Set: setting('FONNTE_TOKEN', 'new-value')
     * 
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    function setting(string $key, $value = null)
    {
        // If value is provided, set the setting
        if (func_num_args() === 2) {
            return Setting::set($key, $value);
        }
        
        // Otherwise, get the setting
        return Setting::get($key, $value);
    }
}

if (!function_exists('settings')) {
    /**
     * Get all settings as an array
     * 
     * @return array
     */
    function settings(): array
    {
        return Cache::rememberForever(Setting::CACHE_KEY, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }
}
