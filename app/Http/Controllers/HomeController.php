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
            'recentDestinations',
            'allDestinations'
        ));
    }


}
