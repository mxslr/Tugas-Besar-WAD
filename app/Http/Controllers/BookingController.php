<?php

// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\BookingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        return view('bookings.create', compact('rooms')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'subject' => 'required|string|max:100',
            'lecturer_name' => 'nullable|string|max:100',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'participants' => 'required|integer|min:1',
            'purpose' => 'required|string',
        ]);

        $isConflict = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
                });
            })
            ->whereIn('status', ['pending', 'approved']) 
            ->exists();

        if ($isConflict) {
            return back()->withErrors(['jadwal_konflik' => 'Ruangan tidak tersedia pada tanggal dan waktu tersebut.'])->withInput();
        }

        $room = Room::find($request->room_id);
        if ($request->participants > $room->capacity) {
            return back()->withErrors(['kapasitas' => 'Jumlah peserta melebihi kapasitas ruangan (Maks: ' . $room->capacity . ').'])->withInput();
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'subject' => $request->subject,
            'lecturer_name' => $request->lecturer_name,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'participants' => $request->participants,
            'purpose' => $request->purpose,
            'status' => 'pending', 
        ]);

        BookingHistory::create([
            'booking_id' => $booking->booking_id,
            'changed_by' => Auth::id(),
            'old_status' => 'new', 
            'new_status' => 'pending',
            'notes' => 'Booking dibuat oleh pengguna.',
        ]);

        return redirect()->route('bookings.my')->with('success', 'Booking ruangan berhasil diajukan dan menunggu approval.');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
                            ->with(['room', 'approver']) 
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('bookings.my_bookings', compact('bookings')); 
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || !in_array($booking->status, ['pending'])) {
            return redirect()->route('bookings.my')->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $oldStatus = $booking->status;
        $booking->status = 'cancelled';
        $booking->save();

        BookingHistory::create([
            'booking_id' => $booking->booking_id,
            'changed_by' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => 'cancelled',
            'notes' => 'Booking dibatalkan oleh pengguna.',
        ]);

        return redirect()->route('bookings.my')->with('success', 'Booking berhasil dibatalkan.');
    }
}
