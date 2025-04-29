<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function bookings()
    {
        $bookings = Booking::with('client','servicebooking','provider')->where('client_id', auth()->user()->id)->get();

        // $bookings = DB::table('bookings as b')->join('.')->where('b.client_id', auth()->user()->id)->get();
        return view('client.bookings.index', compact('bookings'));
    }

    public function createBookings()
    {
        $services = StudioService::with('provider')->get();
        return view('client.bookings.create', compact('services'));
    }

    public function storeBookings(Request $request){
        $request->validate([
            'service_booking_id' => 'required|exists:studio_services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
            'transaction_code' => 'required|string|max:100',
        ]);

        $booking = Booking::create([
            'client_id' => Auth::id(),
            'service_id' => $request->service_booking_id,
            'booking_date' => $request->appointment_date,
            'booking_time' => $request->appointment_time,
            'status' => 'pending',
            'payment_status' => 'pending',
            'amount_paid' => null,
            'notes' => $request->description,
        ]);

        // $provider = 

        Payment::create([
            'booking_id' => $booking->id,
            'client_id' => Auth::id(),
            'amount' => 0,
            'payment_method' => 'manual',
            'payment_date' => now(),
            'transaction_id' => strtoupper($request->transaction_code),
            'payment_status' => 'pending',
        ]);

        return redirect()->route('client.bookings')->with('success', 'Booking and payment submitted successfully.');


    }
}
