<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\ServiceCategory;
use App\Models\StudioService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function indexpage()
    {
        $categories = StudioService::with('provider')->get();
        return view('welcome', compact('categories'));
    }

    public function categoryImages($slug)
    {

        $record = StudioService::with('studio', 'provider')->where('id', $slug)->first();

        if (!$record) {

            return back()->with('error', 'Unable to get the images.');
        }


        return view('category-images', compact('record'));
    }

    public function registerServiceProvider(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|confirmed|min:6',
            'description' => 'nullable|string',
            'portfolio_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'service_category_id' => 'required'
        ]);

        $data = $request->only('name', 'email', 'phone_number');
        $data['role'] = 'provider';
        $data['status'] = 'pending';
        $data['service_category_id'] = $request->service_category_id;
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $portfolioPaths = [];
        if ($request->hasFile('portfolio_images')) {
            foreach ($request->file('portfolio_images') as $image) {
                $portfolioPaths[] = $image->store('portfolio_images', 'public');
            }
        }
        $data['portfolio_images'] = json_encode($portfolioPaths);

        $data['description'] = $request->description;
        $user = User::create($data);
        $user->assignRole('provider');

        return redirect()->route('login')->with('success', 'Service Provider added successfully.');
    }

    public function registerClient()
    {
        return view('auth.register-client');
    }
    public function storeClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = $request->only('name', 'email', 'phone_number');
        $data['role'] = 'client';
        $data['status'] = 'approved';
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create($data);
        $user->assignRole('client');

        return redirect()->route('login')->with('success', 'Client added successfully.');
    }
    public function storeBookings(Request $request)
    {

        $request->validate([
            'service_booking_id' => 'required|exists:studio_services,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
            'transaction_code' => 'required|string|max:10|min:10',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please login first before placing your appointment');
        }

        $pendingBookings = Booking::where('client_id', auth()->user()->id)->where('service_id', $request->service_booking_id)->where('status', 'pending')->count();

        if ($pendingBookings >= 1) {
            return redirect()->back()->with('error', 'You have a pending booking already');
        }

        $booking = Booking::create([
            'client_id' => auth()->user()->id,
            'service_id' => $request->service_booking_id,
            'booking_date' => $request->appointment_date,
            'booking_time' => $request->appointment_time,
            'status' => 'pending',
            'payment_status' => 'pending',
            'amount_paid' => null,
            'notes' => $request->description,
            'provider_id'=> DB::table('studio_services')->where('id', $request->service_booking_id)->value('provider_id'),
        ]);



        Payment::create([
            'booking_id' => $booking->id,
            'client_id' => Auth::id(),
            'amount' => 0,
            'payment_method' => 'manual',
            'payment_date' => now(),
            'transaction_id' => strtoupper($request->transaction_code),
            'payment_status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking and payment submitted successfully.');
    }
}
