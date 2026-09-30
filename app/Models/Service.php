<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'description',
        'duration_hours',
        'price',
        'deposit_percentage',
        'deposit_amount',
        'hair_extensions_note',
        'hair_included',
        'image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'deposit_percentage' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'hair_included' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
            if (empty($service->deposit_amount) && !empty($service->price)) {
                $pct = $service->deposit_percentage ?: 30.00;
                $service->deposit_amount = round(($service->price * $pct) / 100, 2);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(Gallery::class)->where('is_active', true)->orderBy('sort_order');
    }
}
