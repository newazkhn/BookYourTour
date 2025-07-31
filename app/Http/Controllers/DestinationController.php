<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    // Frontend
    public function index(Request $request)
    {
        $query = Destination::query();
        
        // Handle search parameter
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Handle category filter
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }
        
        $destinations = $query->latest()->paginate(12);
        
        return view('destinations.index', [
            'destinations' => $destinations,
            'searchQuery' => $request->get('search', ''),
            'selectedCategory' => $request->get('category', ''),
            'totalResults' => $destinations->total()
        ]);
    }

    public function show(Destination $destination)
    {
        // Ensure gallery and amenities are properly decoded if they're JSON strings
        if (is_string($destination->gallery)) {
            $destination->gallery = json_decode($destination->gallery, true) ?? [];
        }
        
        if (is_string($destination->amenities)) {
            $destination->amenities = json_decode($destination->amenities, true) ?? [];
        }
        
        return view('destinations.show', compact('destination'));
    }

    // Admin
    public function adminIndex(Request $request)
    {
        // Handle view mode with session persistence
        $viewMode = $request->get('view', session('destinations_view', 'card'));
        session(['destinations_view' => $viewMode]);
        
        $query = Destination::query();
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }
        
        // Apply featured filter
        if ($request->filled('featured')) {
            $query->where('featured', $request->boolean('featured'));
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort column to prevent SQL injection
        $allowedSortColumns = ['name', 'location', 'price_from', 'rating', 'created_at', 'updated_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $sortDirection);
        
        $destinations = $query->paginate(20);
        
        // Handle AJAX requests for dynamic view updates
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.destinations.partials.' . $viewMode, compact('destinations'))->render(),
                'pagination' => $destinations->links()->render()
            ]);
        }
        
        return view('admin.destinations.index', compact('destinations', 'viewMode'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|string|in:delete,toggle_featured',
            'destination_ids' => 'required|array',
            'destination_ids.*' => 'exists:destinations,id'
        ]);

        $action = $request->get('action');
        $destinationIds = $request->get('destination_ids', []);
        
        try {
            switch ($action) {
                case 'delete':
                    $destinations = Destination::whereIn('id', $destinationIds)->get();
                    foreach ($destinations as $destination) {
                        // Delete associated image files
                        if ($destination->image) {
                            Storage::disk('public')->delete($destination->image);
                        }
                        $destination->delete();
                    }
                    $message = count($destinationIds) . ' destination(s) deleted successfully.';
                    break;
                    
                case 'toggle_featured':
                    $destinations = Destination::whereIn('id', $destinationIds)->get();
                    foreach ($destinations as $destination) {
                        $destination->update(['featured' => !$destination->featured]);
                    }
                    $message = 'Featured status toggled for ' . count($destinationIds) . ' destination(s).';
                    break;
                    
                default:
                    return response()->json(['success' => false, 'message' => 'Invalid action.'], 400);
            }
            
            return response()->json([
                'success' => true, 
                'message' => $message,
                'count' => count($destinationIds)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'An error occurred while processing the bulk action.'
            ], 500);
        }
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gallery' => 'required|array|min:3|max:10',
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'category' => 'required|string|in:beach,mountain,city,adventure,cultural,wildlife',
            'price_from' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'rating' => 'required|numeric|min:1|max:5',
            'featured' => 'nullable|boolean',
            'amenities' => 'nullable|string',
        ]);

        // Store main image
        $imagePath = $request->file('image')->store('destinations', 'public');

        // Store gallery images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('destinations/gallery', 'public');
            }
        }

        // Process amenities
        $amenities = null;
        if ($request->filled('amenities')) {
            $amenities = array_map('trim', explode(',', $request->amenities));
            $amenities = json_encode(array_filter($amenities));
        }

        Destination::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $imagePath,
            'gallery' => json_encode($galleryPaths),
            'category' => $request->category,
            'price_from' => $request->price_from,
            'duration' => $request->duration,
            'rating' => $request->rating,
            'amenities' => $amenities,
            'featured' => $request->boolean('featured'),
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gallery' => 'nullable|array|max:10',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'existing_gallery' => 'nullable|array',
            'category' => 'required|string|in:beach,mountain,city,adventure,cultural,wildlife',
            'price_from' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'rating' => 'required|numeric|min:1|max:5',
            'featured' => 'nullable|boolean',
            'amenities' => 'nullable|string',
        ]);

        $updateData = $request->only('name', 'location', 'description', 'category', 'price_from', 'duration', 'rating');
        $updateData['featured'] = $request->boolean('featured');

        // Handle main image update
        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $updateData['image'] = $request->file('image')->store('destinations', 'public');
        }

        // Handle gallery images update
        $galleryPaths = [];
        
        // Keep existing gallery images that weren't removed
        if ($request->has('existing_gallery')) {
            $galleryPaths = $request->existing_gallery;
        }
        
        // Add new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('destinations/gallery', 'public');
            }
        }
        
        // Clean up removed gallery images
        $currentGallery = is_string($destination->gallery) ? json_decode($destination->gallery, true) : ($destination->gallery ?? []);
        $keptImages = $request->existing_gallery ?? [];
        $removedImages = array_diff($currentGallery, $keptImages);
        
        foreach ($removedImages as $removedImage) {
            Storage::disk('public')->delete($removedImage);
        }
        
        // Validate minimum gallery images
        if (count($galleryPaths) < 3) {
            return back()->withErrors(['gallery' => 'At least 3 gallery images are required.'])->withInput();
        }
        
        $updateData['gallery'] = json_encode($galleryPaths);

        // Process amenities
        if ($request->filled('amenities')) {
            $amenities = array_map('trim', explode(',', $request->amenities));
            $updateData['amenities'] = json_encode(array_filter($amenities));
        } else {
            $updateData['amenities'] = null;
        }

        $destination->update($updateData);
        
        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated successfully!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) Storage::disk('public')->delete($destination->image);
        $destination->delete();
        return back()->with('success', 'Destination deleted!');
    }
}
