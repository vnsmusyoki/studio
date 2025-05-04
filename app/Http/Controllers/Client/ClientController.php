<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Complain;
use App\Models\Payment;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function bookings()
    {
        $bookings = Booking::with('client', 'servicebooking', 'provider')->where('client_id', auth()->user()->id)->get();

        // $bookings = DB::table('bookings as b')->join('.')->where('b.client_id', auth()->user()->id)->get();
        return view('client.bookings.index', compact('bookings'));
    }

    public function createBookings()
    {
        $services = StudioService::with('provider')->get();
        return view('client.bookings.create', compact('services'));
    }

    public function storeBookings(Request $request)
    {
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

    public function allComplains()
    {
        $complains = Complain::with('client', 'booking', 'provider')->where('client_id', auth()->user()->id)->get();
        return view('client.complains.index', compact('complains'));
    }

    public function createComplains()
    {
        $bookings = Booking::with('client', 'servicebooking', 'provider')->where('client_id', auth()->user()->id)->get();
        return view('client.complains.create', compact('bookings'));
    }
    public function storeComplains(Request $request)
    {
        Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'complain' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePaths = [];


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('complaint_images', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        $booking = Booking::where('id', $request->booking_id)->first();

        $complaint = Complain::create([
            'client_id' => auth()->user()->id,
            'booking_id' => $booking->id,
            'provider_id' => $booking->provider_id,
            'complain' => $request->complain,
            'slug' => Str::slug(Str::limit($request->complain, 50)) . '-' . uniqid(),
            'images' => implode(',', $imagePaths),
        ]);


        return redirect()->route('client.complains')
            ->with('success', 'Complaint submitted successfully.');
    }
}
