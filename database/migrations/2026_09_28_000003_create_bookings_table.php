<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique(); // e.g. EB-20260928-ABC1
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('service_name');
            $table->string('category_name')->nullable();
            
            // Client contact details
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            
            // Appointment details
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->string('service_location_type')->default('mobile_home'); // mobile_home, travel, salon_studio
            $table->text('address')->nullable();
            $table->string('city')->nullable()->default('Luton');
            $table->string('postcode')->nullable();
            
            // Hair styling specs
            $table->string('gel_preference')->default('undecided'); // gel, no_gel, undecided
            $table->string('hair_length_option')->nullable(); // e.g. Bob / Shoulder, Mid-back, Waist length
            $table->string('hair_size_option')->nullable(); // e.g. Small, Smedium, Medium, Large
            
            // Financial details
            $table->decimal('total_price', 8, 2);
            $table->decimal('deposit_amount', 8, 2);
            $table->string('deposit_status')->default('pending'); // pending, paid, refunded, waived
            $table->decimal('balance_amount', 8, 2);
            $table->string('balance_status')->default('pending'); // pending, paid
            
            // Booking Status & Notes
            $table->string('status')->default('pending'); // pending, confirmed, in_progress, completed, cancelled, rescheduled
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->text('client_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->boolean('policies_accepted')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
