<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'user_id',
        'service_id',
        'service_name',
        'category_name',
        'client_name',
        'client_email',
        'client_phone',
        'appointment_date',
        'appointment_time',
        'service_location_type',
        'address',
        'city',
        'postcode',
        'gel_preference',
        'hair_length_option',
        'hair_size_option',
        'total_price',
        'deposit_amount',
        'deposit_status',
        'balance_amount',
        'balance_status',
        'status',
        'payment_method',
        'payment_reference',
        'payment_proof',
        'client_notes',
        'admin_notes',
        'policies_accepted',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'total_price' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
        'policies_accepted' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'EB-' . date('Ymd') . '-' . strtoupper(Str::random(4));
            }
            if (empty($booking->balance_amount)) {
                $booking->balance_amount = max(0, $booking->total_price - $booking->deposit_amount);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
