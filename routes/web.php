<?php

use App\Http\Controllers\Admin\AppointmentScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\WebsiteServiceController as AdminWebsiteServiceController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Ella Beauty
|--------------------------------------------------------------------------
*/

// Public Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/book-appointment', [FrontendController::class, 'booking'])->name('booking');
Route::get('/booking', [FrontendController::class, 'booking'])->name('booking.alias');
Route::post('/booking/store', [FrontendController::class, 'storeBooking'])->name('booking.store');
Route::get('/booking/confirmation/{reference}', [FrontendController::class, 'bookingConfirmation'])->name('booking.confirmation');
Route::post('/booking/upload-proof/{reference}', [FrontendController::class, 'uploadPaymentProof'])->name('booking.upload-proof');
Route::get('/our-portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact-us');
Route::post('/contact-us', [FrontendController::class, 'storeContact'])->name('contact.store');

// Authenticated Redirection
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.main');

    // Appointments & Schedule Calendar
    Route::get('/appointments', [AppointmentScheduleController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/unavailable', [AppointmentScheduleController::class, 'storeUnavailable'])->name('appointments.unavailable.store');
    Route::delete('/appointments/unavailable/{unavailableDate}', [AppointmentScheduleController::class, 'destroyUnavailable'])->name('appointments.unavailable.destroy');

    // Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [AdminBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // Services & Categories
    Route::resource('services', AdminServiceController::class);
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Website Showcase Services
    Route::get('/website-services', [AdminWebsiteServiceController::class, 'index'])->name('website-services.index');
    Route::post('/website-services', [AdminWebsiteServiceController::class, 'store'])->name('website-services.store');
    Route::put('/website-services/{websiteService}', [AdminWebsiteServiceController::class, 'update'])->name('website-services.update');
    Route::patch('/website-services/{websiteService}/toggle-active', [AdminWebsiteServiceController::class, 'toggleActive'])->name('website-services.toggle-active');
    Route::delete('/website-services/{websiteService}', [AdminWebsiteServiceController::class, 'destroy'])->name('website-services.destroy');

    // Gallery
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::post('/gallery/bulk-classify', [AdminGalleryController::class, 'bulkClassify'])->name('gallery.bulk-classify');
    Route::post('/gallery/bulk-delete', [AdminGalleryController::class, 'bulkDestroy'])->name('gallery.bulk-delete');
    Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    // Reviews
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [AdminReviewController::class, 'store'])->name('reviews.store');
    Route::patch('/reviews/{review}/toggle-approve', [AdminReviewController::class, 'toggleApprove'])->name('reviews.toggle-approve');
    Route::patch('/reviews/{review}/toggle-feature', [AdminReviewController::class, 'toggleFeature'])->name('reviews.toggle-feature');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

    // Inquiries
    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::patch('/inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
    Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
