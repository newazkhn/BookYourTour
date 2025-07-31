<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, $destinationId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'people_count' => 'required|integer|min:1',
            'travel_date' => 'required|date|after_or_equal:today',
        ]);

        Booking::create([
            'destination_id' => $destinationId,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'people_count' => $request->people_count,
            'travel_date' => $request->travel_date,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking submitted successfully! You can track its status in your bookings page.');
    }

    public function adminIndex()
    {
        $bookings = Booking::with('destination')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,approved,cancelled']);
        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Booking status updated!');
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        $statusMessage = [
            'approved' => 'Booking approved successfully!',
            'cancelled' => 'Booking cancelled successfully!',
            'pending' => 'Booking status updated to pending!'
        ];

        return back()->with('success', $statusMessage[$request->status]);
    }

    public function userBookings()
    {
        $bookings = Booking::with('destination')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('user.bookings', compact('bookings'));
    }
}

