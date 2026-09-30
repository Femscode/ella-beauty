<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebsiteServiceController extends Controller
{
    public function index()
    {
        $services = WebsiteService::orderBy('sort_order')->latest('id')->paginate(20);
        return view('admin.website-services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'price_prefix' => 'nullable|string|max:50',
            'price_value' => 'required|string|max:50',
            'duration' => 'nullable|string|max:100',
            'deposit_tag' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $catName = $validated['category_name'] ?? 'Braids';
        $validated['category_name'] = $catName;
        $validated['category_slug'] = Str::slug($catName);
        if (empty($validated['category_slug'])) {
            $validated['category_slug'] = 'general';
        }

        $validated['price_prefix'] = $validated['price_prefix'] ?? 'From';
        $validated['deposit_tag'] = $validated['deposit_tag'] ?? '30% Deposit';
        $validated['button_text'] = $validated['button_text'] ?? 'Book Now';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        // Handle image upload or image URL
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('website-services', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        } else {
            $validated['image'] = 'assets/images/hero2.jpg';
        }

        WebsiteService::create($validated);

        return back()->with('success', 'Website showcase service added successfully!');
    }

    public function update(Request $request, WebsiteService $websiteService)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'price_prefix' => 'nullable|string|max:50',
            'price_value' => 'required|string|max:50',
            'duration' => 'nullable|string|max:100',
            'deposit_tag' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $catName = $validated['category_name'] ?? 'Braids';
        $validated['category_name'] = $catName;
        $validated['category_slug'] = Str::slug($catName);
        if (empty($validated['category_slug'])) {
            $validated['category_slug'] = 'general';
        }

        $validated['price_prefix'] = $validated['price_prefix'] ?? 'From';
        $validated['deposit_tag'] = $validated['deposit_tag'] ?? '30% Deposit';
        $validated['button_text'] = $validated['button_text'] ?? 'Book Now';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        // Handle image update
        if ($request->hasFile('image')) {
            if ($websiteService->image && !str_starts_with($websiteService->image, 'assets/') && !str_starts_with($websiteService->image, 'http')) {
                Storage::disk('public')->delete($websiteService->image);
            }
            $path = $request->file('image')->store('website-services', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }

        $websiteService->update($validated);

        return back()->with('success', 'Website showcase service updated successfully!');
    }

    public function destroy(WebsiteService $websiteService)
    {
        if ($websiteService->image && !str_starts_with($websiteService->image, 'assets/') && !str_starts_with($websiteService->image, 'http')) {
            Storage::disk('public')->delete($websiteService->image);
        }

        $websiteService->delete();

        return back()->with('success', 'Website showcase service deleted successfully.');
    }

    public function toggleActive(WebsiteService $websiteService)
    {
        $websiteService->update([
            'is_active' => !$websiteService->is_active,
        ]);

        return back()->with('success', 'Status updated.');
    }
}
