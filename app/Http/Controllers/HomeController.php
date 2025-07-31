<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch featured destinations (marked as featured)
        $featuredDestinations = Destination::where('featured', true)
            ->latest()
            ->limit(6)
            ->get();

        // Fetch popular destinations (highest rated)
        $popularDestinations = Destination::orderBy('rating', 'desc')
            ->limit(8)
            ->get();

        // Get unique categories for filtering
        $categories = Destination::whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        // Get recent destinations as fallback content
        $recentDestinations = Destination::latest()
            ->limit(12)
            ->get();

        // Get all destinations for category filtering
        $allDestinations = Destination::orderBy('featured', 'desc')
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.index', compact(
            'featuredDestinations',
            'popularDestinations', 
            'categories',
            'recentDestinations',
            'allDestinations'
        ));
    }

    /**
     * Filter destinations by category via AJAX
     */
    public function filterByCategory(Request $request)
    {
        $category = $request->get('category');
        
        $query = Destination::query();
        
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }
        
        $destinations = $query->orderBy('featured', 'desc')
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'destinations' => $destinations->map(function($destination) {
                return [
                    'id' => $destination->id,
                    'name' => $destination->name,
                    'location' => $destination->location,
                    'description' => $destination->description,
                    'image' => $destination->image ? asset('storage/' . $destination->image) : null,
                    'category' => $destination->category,
                    'rating' => $destination->rating,
                    'price_from' => $destination->price_from,
                    'duration' => $destination->duration,
                    'url' => route('destinations.show', $destination)
                ];
            }),
            'count' => $destinations->count()
        ]);
    }
}
