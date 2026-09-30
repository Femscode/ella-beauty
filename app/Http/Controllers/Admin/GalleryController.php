<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::with('serviceCategory');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('category', 'like', "%{$s}%")
                  ->orWhere('caption', 'like', "%{$s}%");
            });
        }

        if ($request->service_category_id === 'uncategorized') {
            $query->whereNull('service_category_id');
        } elseif ($request->filled('service_category_id')) {
            $query->where('service_category_id', $request->service_category_id);
        } elseif ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->orderBy('sort_order')->latest()->paginate(24)->withQueryString();
        $serviceCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.gallery.index', compact('items', 'serviceCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $serviceCategoryId = $validated['service_category_id'] ?? null;
        $categoryName = $validated['category'] ?? null;

        if ($serviceCategoryId && empty($categoryName)) {
            $catObj = ServiceCategory::find($serviceCategoryId);
            $categoryName = $catObj ? $catObj->name : null;
        }

        if (empty($categoryName)) {
            $categoryName = $serviceCategoryId ? 'Hair Artistry' : 'General Lookbook';
        }

        $baseTitle = !empty($validated['title']) ? $validated['title'] : ($serviceCategoryId ? $categoryName . ' Look' : 'Lookbook Artwork');
        $caption = $validated['caption'] ?? null;
        $sortOrder = $validated['sort_order'] ?? 0;
        $isFeatured = $request->has('is_featured');
        $createdCount = 0;

        // 1. Bulk Upload (Multiple Images)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('gallery', 'public');
                $itemTitle = count($request->file('images')) > 1 ? "{$baseTitle} #" . ($idx + 1) : $baseTitle;

                Gallery::create([
                    'service_category_id' => $serviceCategoryId,
                    'title' => $itemTitle,
                    'category' => $categoryName,
                    'image_path' => '/storage/' . $path,
                    'caption' => $caption,
                    'is_featured' => $isFeatured,
                    'sort_order' => $sortOrder + $idx,
                    'is_active' => true,
                ]);
                $createdCount++;
            }
        }

        // 2. Single Image File Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            Gallery::create([
                'service_category_id' => $serviceCategoryId,
                'title' => $baseTitle,
                'category' => $categoryName,
                'image_path' => '/storage/' . $path,
                'caption' => $caption,
                'is_featured' => $isFeatured,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);
            $createdCount++;
        }

        // 3. Image URL
        if ($createdCount === 0 && !empty($validated['image_url'])) {
            Gallery::create([
                'service_category_id' => $serviceCategoryId,
                'title' => $baseTitle,
                'category' => $categoryName,
                'image_path' => $validated['image_url'],
                'caption' => $caption,
                'is_featured' => $isFeatured,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);
            $createdCount++;
        }

        if ($createdCount === 0) {
            return back()->withErrors(['image' => 'Please select one or more image files or enter an image URL.']);
        }

        $destText = $serviceCategoryId ? "to {$categoryName}" : "to General Lookbook";
        $msg = $createdCount > 1 ? "{$createdCount} lookbook images uploaded successfully {$destText}!" : "Gallery image added successfully!";
        return back()->with('success', $msg);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_category_id' => 'nullable',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $serviceCategoryId = !empty($validated['service_category_id']) ? $validated['service_category_id'] : null;
        $categoryName = $validated['category'] ?? null;

        if ($serviceCategoryId && empty($categoryName)) {
            $catObj = ServiceCategory::find($serviceCategoryId);
            $categoryName = $catObj ? $catObj->name : null;
        }

        if (empty($categoryName)) {
            $categoryName = $serviceCategoryId ? 'Hair Artistry' : 'General Lookbook';
        }

        $imagePath = $gallery->image_path;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $imagePath = '/storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $gallery->update([
            'service_category_id' => $serviceCategoryId,
            'title' => $validated['title'],
            'category' => $categoryName,
            'image_path' => $imagePath,
            'caption' => $validated['caption'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active') ? true : ($request->exists('is_active') ? false : $gallery->is_active),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with('success', "Lookbook item '{$gallery->title}' updated successfully!");
    }

    public function bulkClassify(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id',
            'service_category_id' => 'nullable',
        ]);

        $serviceCategoryId = !empty($validated['service_category_id']) ? $validated['service_category_id'] : null;
        $categoryName = 'General Lookbook';

        if ($serviceCategoryId) {
            $category = ServiceCategory::find($serviceCategoryId);
            $categoryName = $category ? $category->name : 'Hair Artistry';
        }

        $count = count($validated['ids']);
        Gallery::whereIn('id', $validated['ids'])->update([
            'service_category_id' => $serviceCategoryId,
            'category' => $categoryName,
        ]);

        $categoryLabel = $serviceCategoryId ? "'{$categoryName}'" : 'General Lookbook / Uncategorized';
        return back()->with('success', "{$count} gallery item(s) successfully categorized to {$categoryLabel}!");
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Gallery item deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id',
        ]);

        $count = count($validated['ids']);
        Gallery::whereIn('id', $validated['ids'])->delete();

        return back()->with('success', "{$count} gallery item(s) deleted successfully.");
    }
}
