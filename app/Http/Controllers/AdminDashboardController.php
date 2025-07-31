<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics
     */
    public function index()
    {
        try {
            $dashboardData = [
                'destinations' => $this->getDestinationStatistics(),
                'bookings' => $this->getBookingStatistics(),
                'revenue' => $this->getRevenueStatistics()
            ];

            return view('admin.dashboard', compact('dashboardData'));
        } catch (\Exception $e) {
            Log::error('Dashboard statistics calculation failed: ' . $e->getMessage());
            
            // Return default values in case of error
            $dashboardData = $this->getDefaultStatistics();
            return view('admin.dashboard', compact('dashboardData'))
                ->with('error', 'Some statistics could not be loaded. Please try again later.');
        }
    }

    /**
     * Calculate destination-related statistics
     */
    private function getDestinationStatistics()
    {
        try {
            return [
                'total' => Destination::count(),
                'active' => Destination::active()->count(),
                'featured' => Destination::featured()->count(),
                'highlighted' => Destination::highlighted()->count(),
                'categories' => Destination::whereNotNull('category')->distinct('category')->count('category'),
                'averagePrice' => round(Destination::whereNotNull('price_from')->avg('price_from') ?? 0, 2)
            ];
        } catch (\Exception $e) {
            Log::error('Destination statistics calculation failed: ' . $e->getMessage());
            return [
                'total' => 0,
                'active' => 0,
                'featured' => 0,
                'highlighted' => 0,
                'categories' => 0,
                'averagePrice' => 0
            ];
        }
    }

    /**
     * Calculate booking-related statistics
     */
    private function getBookingStatistics()
    {
        try {
            return [
                'total' => Booking::count(),
                'pending' => Booking::pending()->count(),
                'confirmed' => Booking::confirmed()->count(),
                'cancelled' => Booking::cancelled()->count()
            ];
        } catch (\Exception $e) {
            Log::error('Booking statistics calculation failed: ' . $e->getMessage());
            return [
                'total' => 0,
                'pending' => 0,
                'confirmed' => 0,
                'cancelled' => 0
            ];
        }
    }

    /**
     * Calculate revenue-related statistics
     */
    private function getRevenueStatistics()
    {
        try {
            // Since there's no total_amount field in the current schema,
            // we'll calculate estimated revenue based on destination prices and confirmed bookings
            $confirmedBookings = Booking::with('destination')
                ->confirmed()
                ->get();

            $totalRevenue = 0;
            $thisMonthRevenue = 0;
            $currentMonth = now()->format('Y-m');

            foreach ($confirmedBookings as $booking) {
                $estimatedAmount = $booking->destination->price_from ?? 0;
                $totalRevenue += $estimatedAmount;
                
                if ($booking->created_at->format('Y-m') === $currentMonth) {
                    $thisMonthRevenue += $estimatedAmount;
                }
            }

            // Calculate growth percentage (simplified - comparing this month to total average)
            $averageMonthlyRevenue = $totalRevenue > 0 ? $totalRevenue / max(1, $confirmedBookings->count()) : 0;
            $growth = $averageMonthlyRevenue > 0 ? 
                round((($thisMonthRevenue - $averageMonthlyRevenue) / $averageMonthlyRevenue) * 100, 1) : 0;

            return [
                'total' => round($totalRevenue, 2),
                'thisMonth' => round($thisMonthRevenue, 2),
                'growth' => $growth
            ];
        } catch (\Exception $e) {
            Log::error('Revenue statistics calculation failed: ' . $e->getMessage());
            return [
                'total' => 0,
                'thisMonth' => 0,
                'growth' => 0
            ];
        }
    }

    /**
     * Get default statistics in case of errors
     */
    private function getDefaultStatistics()
    {
        return [
            'destinations' => [
                'total' => 0,
                'active' => 0,
                'featured' => 0,
                'highlighted' => 0,
                'categories' => 0,
                'averagePrice' => 0
            ],
            'bookings' => [
                'total' => 0,
                'pending' => 0,
                'confirmed' => 0,
                'cancelled' => 0
            ],
            'revenue' => [
                'total' => 0,
                'thisMonth' => 0,
                'growth' => 0
            ]
        ];
    }
}