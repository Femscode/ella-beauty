<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class)->orderBy('sort_order', 'asc');
    }

    public function activeServices()
    {
        return $this->hasMany(Service::class)->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function galleryImages()
    {
        return $this->hasMany(Gallery::class, 'service_category_id')->where('is_active', true)->orderBy('sort_order', 'asc');
    }
}
