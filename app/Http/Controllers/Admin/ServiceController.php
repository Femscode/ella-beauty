<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category')->orderBy('sort_order');

        if ($request->filled('category_id')) {
            $query->where('service_category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->paginate(20)->withQueryString();
        $categories = ServiceCategory::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('sort_order')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'duration_hours' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'deposit_percentage' => 'nullable|numeric|min:0|max:100',
            'hair_extensions_note' => 'nullable|string',
            'hair_included' => 'boolean',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $pct = $validated['deposit_percentage'] ?? 30.00;
        $validated['deposit_amount'] = round(($validated['price'] * $pct) / 100, 2);
        $validated['hair_included'] = $request->has('hair_included');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Hairstyle service created successfully!');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('sort_order')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'duration_hours' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'deposit_percentage' => 'nullable|numeric|min:0|max:100',
            'hair_extensions_note' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $pct = $validated['deposit_percentage'] ?? 30.00;
        $validated['deposit_amount'] = round(($validated['price'] * $pct) / 100, 2);
        $validated['hair_included'] = $request->has('hair_included');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Hairstyle service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Hairstyle service deleted.');
    }
}
