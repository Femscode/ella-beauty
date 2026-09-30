<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_name')->nullable();
            $table->string('category_slug')->default('braids');
            $table->string('badge')->nullable();
            $table->string('image')->nullable();
            $table->string('price_prefix')->default('From');
            $table->string('price_value')->default('£80.00');
            $table->string('duration')->nullable();
            $table->string('deposit_tag')->default('30% Deposit');
            $table->text('description')->nullable();
            $table->string('button_text')->default('Book Now');
            $table->string('button_link')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default 6 showcase services from homepage
        DB::table('website_services')->insert([
            [
                'title' => 'Braids',
                'category_name' => 'Braids',
                'category_slug' => 'braids',
                'badge' => '✦ Signature Braids',
                'image' => 'assets/images/hero2.jpg',
                'price_prefix' => 'From',
                'price_value' => '£80.00',
                'duration' => '⏱ 4–10 hrs',
                'deposit_tag' => '30% Deposit',
                'description' => 'Knotless braids, box braids, boho braids, Miracle Knots, and signature braided protective styles.',
                'button_text' => 'Book Braids',
                'button_link' => '/booking?service=braids',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Twists',
                'category_name' => 'Twists',
                'category_slug' => 'twists',
                'badge' => '✦ Natural Twists',
                'image' => 'assets/images/braided4.avif',
                'price_prefix' => 'From',
                'price_value' => '£55.00',
                'duration' => '⏱ 2.5–9 hrs',
                'deposit_tag' => '30% Deposit',
                'description' => 'From simple, elegant two-strand twists to detailed, intricate passion and Senegalese twists.',
                'button_text' => 'Book Twists',
                'button_link' => '/booking?service=twists',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Kids' Hair",
                'category_name' => "Kids' Hair",
                'category_slug' => 'kids',
                'badge' => '✦ Children & Teens',
                'image' => 'assets/images/hero4.jpg',
                'price_prefix' => 'From',
                'price_value' => '£45.00',
                'duration' => '⏱ 2–4 hrs',
                'deposit_tag' => '30% Deposit',
                'description' => 'Beautiful, age-appropriate protective styles designed specially for children with patient, gentle hands.',
                'button_text' => "Book Kids' Hair",
                'button_link' => '/booking?service=kids',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Protective Styles',
                'category_name' => 'Protective Styles',
                'category_slug' => 'protective',
                'badge' => '✦ Hair Retention',
                'image' => 'assets/images/hero1.jpg',
                'price_prefix' => 'From',
                'price_value' => '£70.00',
                'duration' => '⏱ 3–6 hrs',
                'deposit_tag' => '30% Deposit',
                'description' => 'Styles designed to look beautiful while helping you maintain, nourish, and protect your natural hair.',
                'button_text' => 'Book Protective Style',
                'button_link' => '/booking?service=protective',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mobile Braiding / Home Service',
                'category_name' => 'Mobile & Travel',
                'category_slug' => 'mobile',
                'badge' => '✦ Home Convenience',
                'image' => 'assets/images/hero3.avif',
                'price_prefix' => 'Luton Coverage',
                'price_value' => 'Mobile',
                'duration' => 'Home Comfort',
                'deposit_tag' => '30% Deposit',
                'description' => "Don't want to leave home? Ella Beauty brings the full professional braiding appointment straight to your doorstep.",
                'button_text' => 'Book Home Service',
                'button_link' => '/booking?service=mobile',
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Travel Appointments',
                'category_name' => 'Mobile & Travel',
                'category_slug' => 'mobile',
                'badge' => '✦ Regional Travel',
                'image' => 'assets/images/pexels-gen-us-grapher-452619136-16684786.jpg',
                'price_prefix' => 'Distance Based',
                'price_value' => 'Travel',
                'duration' => 'Groups & VIP',
                'deposit_tag' => '30% Deposit',
                'description' => 'Travel appointments available for selected UK destinations outside Luton. Additional distance charges apply.',
                'button_text' => 'Request Travel Booking',
                'button_link' => '/booking?service=travel',
                'sort_order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_services');
    }
};
