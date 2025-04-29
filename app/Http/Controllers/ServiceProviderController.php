<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\ServiceCategory;
use App\Models\StudioService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceProviderController extends Controller
{
    public function dashboard()
    {

        return view('providers.dashboard');
    }

    public function bookings()
    {

        $bookings = DB::table('bookings')->join('users', 'users.id', '=', 'bookings.client_id')->join('studio_services', 'studio_services.id', '=', 'bookings.service_id')->join('payments', 'payments.booking_id', '=', 'bookings.id')->where('bookings.provider_id', auth()->user()->id)->select('bookings.*', 'users.name as client_name', 'studio_services.min_price', 'studio_services.max_price','studio_services.title as service_title', 'payments.transaction_id as transaction_code', 'payments.payment_status as payment_status')->get();
        return view('providers.bookings.index', compact('bookings'));
    }

    public function createBooking()
    {
        $clients = User::role('client')->get();
        $services = StudioService::where('provider_id', auth()->user()->id)->with('studio')->get();

        return view('providers.bookings.create', compact('clients', 'services'));
    }

    public function services()
    {
        $services = StudioService::with('studio')->where('provider_id', auth()->user()->id)->get();

        return view('providers.services.index', compact('services'));
    }

    public function createService()
    {
        $serviceCategories = ServiceCategory::all();
        return view('providers.services.create', compact('serviceCategories'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|gte:min_price',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $data = $request->only(['title', 'description', 'min_price', 'max_price', 'category', 'location']);
        $data['provider_id'] = auth()->user()->id;

        $portfolioPaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $portfolioPaths[] = $image->store('studio_services', 'public');
            }
        }
        $data['image'] = json_encode($portfolioPaths);

        // if ($request->hasFile('image')) {
        //     $data['image'] = $request->file('image')->store('studio_services', 'public');
        // }

        StudioService::create($data);

        return redirect()->route('provider.services')->with('success', 'Service created successfully.');
    }

    public function editService($slug)
    {
        $service = StudioService::findOrFail($slug);
        if (!$service) {
            return back()->with('error', 'Unable to get the service.');
        }
        $serviceCategories = ServiceCategory::all();
        return view('providers.services.edit', compact('service', 'serviceCategories'));
    }

    public function updateService(Request $request,  $slug)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|gte:min_price',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = StudioService::findOrFail($slug);
        if (!$service) {
            return back()->with('error', 'Unable to get the service.');
        }

        $service->fill($request->only(['title', 'description', 'min_price', 'max_price', 'category', 'location']));

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $request->file('image')->store('studio_services', 'public');
        }
        $service->provider_id = auth()->user()->id;
        $service->save();

        return redirect()->route('provider.services')->with('success', 'Service updated successfully.');
    }
    public function deleteService($slug)
    {
        $service = StudioService::findOrFail($slug);
        if (!$service) {
            return back()->with('error', 'Unable to get the service.');
        }
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('provider.services')->with('success', 'Service deleted successfully.');
    }

    public function confirmBooking($slug){
        $booking = Booking::with('payment')->where('id', $slug)->first();

        if(!$booking){
            return redirect()->back()->with('error', 'Unable to confirm this booking');
        }

        if($booking->status == "confirmed"){
            return redirect()->back()->with('error', 'Booking is already confirmed');
        }

        $booking->update([
            'status'=>'confirmed',
            'payment_status'=>'paid'
        ]);
        $payment = Payment::where('booking_id', $booking->id)->first();
        $payment->update([
            'payment_status'=>'completed'
        ]);

        return redirect()->back()->with('success', 'Payment Approved successfully');
    }
}
