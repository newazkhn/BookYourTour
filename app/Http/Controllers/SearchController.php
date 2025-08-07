<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    /**
     * Get search suggestions for live search
     */
    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $destinations = Destination::where('name', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(8)
            ->get()
            ->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'name' => $destination->name,
                    'location' => $destination->location,
                    'description' => $destination->description,
                    'price_from' => $destination->price_from ?? 0,
                    'image_url' => $destination->image 
                        ? Storage::url($destination->image)
                        : 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                ];
            });

        return response()->json(['suggestions' => $destinations]);
    }

    /**
     * Handle full search with results page
     */
    public function search(Request $request)
    {
        $query = $request->get('search', '');
        
        $destinations = Destination::query();

        // Apply search filter
        if (!empty($query)) {
            $destinations->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('location', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        }



        $results = $destinations->latest()->paginate(12);
        
        // Track search analytics (optional)
        $this->trackSearch($query, $results->count());

        return view('destinations.index', [
            'destinations' => $results,
            'searchQuery' => $query,
            'totalResults' => $results->total()
        ]);
    }

    /**
     * Get popular search terms
     */
    public function popular()
    {
        // This could be enhanced to track actual popular searches
        $popularTerms = [
            'Beach',
            'Mountain',
            'City',
            'Adventure',
            'Cultural',
            'Luxury',
            'Budget',
            'Family'
        ];

        return response()->json(['popular' => $popularTerms]);
    }

    /**
     * Track search for analytics (optional enhancement)
     */
    private function trackSearch($query, $resultCount)
    {
        // This could log to database or analytics service
        // For now, just log to Laravel log
        if (!empty($query)) {
            \Log::info('Search performed', [
                'query' => $query,
                'results' => $resultCount,
                'timestamp' => now(),
                'ip' => request()->ip()
            ]);
        }
    }
}