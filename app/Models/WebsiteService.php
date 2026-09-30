<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_name',
        'category_slug',
        'badge',
        'image',
        'price_prefix',
        'price_value',
        'duration',
        'deposit_tag',
        'description',
        'button_text',
        'button_link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get displayable image URL
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('assets/images/hero2.jpg');
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL) || str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        $relativePath = ltrim(str_replace('/storage/', '', $this->image), '/');

        if ($storageUrl = env('STORAGE_URL')) {
            return rtrim($storageUrl, '/') . '/' . $relativePath;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($relativePath);
    }
}
