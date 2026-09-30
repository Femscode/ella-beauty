<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'service_id',
        'title',
        'category',
        'image_path',
        'caption',
        'is_featured',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'image_url',
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the resolved, absolute image URL for the gallery item
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('assets/images/hero2.jpg');
        }

        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        if (str_starts_with($this->image_path, 'assets/')) {
            return asset($this->image_path);
        }

        // If stored as /storage/... or storage/...
        $relativePath = ltrim(str_replace('/storage/', '', $this->image_path), '/');

        // Check if STORAGE_URL custom domain is configured
        if ($storageUrl = env('STORAGE_URL')) {
            return rtrim($storageUrl, '/') . '/' . $relativePath;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($relativePath);
    }
}
