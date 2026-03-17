<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $guarded = ['id'];

    // relasi dengan booking, satu layanan bisa memiliki banyak booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Satu service hanya bisa memiliki satu category
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategories::class);
    }

    public function slotConfigs()
    {
        return $this->hasMany(ServiceSlotConfig::class);
    }
}
