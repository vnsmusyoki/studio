<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    public function dashboard()
    {
        $totalUsers = User::count();

        $totalSubscription = User::role('provider')->count();

        $totalFreeUsers = User::role('client')->count();

        $totalIncome = Payment::sum('amount');

        $totalExpense = 0;

        $serviceData = User::where('role', 'provider')
            ->whereNotNull('service_category_id')
            ->select('service_category_id', DB::raw('count(*) as total'))
            ->groupBy('service_category_id')
            ->pluck('total', 'service_category_id');

        $categories = ServiceCategory::whereIn('id', $serviceData->keys())->pluck('name', 'id');


        $labels = [];
        $data = [];

        foreach ($serviceData as $categoryId => $total) {
            $labels[] = $categories[$categoryId] ?? 'Unknown';
            $data[] = $total;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalSubscription',
            'totalFreeUsers',
            'totalIncome',
            'totalExpense',
            'labels',
            'data'
        ));
    }

    public function serviceProviders()
    {
        $providers = User::role('provider')->get();
        return view('admin.service-providers.index', compact('providers'));
    }
    public function getPayments()
    {
        $payments = Payment::with('client', 'booking')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function createServiceProvider()
    {
        $serviceCategories = ServiceCategory::all();
        return view('admin.service-providers.create', compact('serviceCategories'));
    }

    public function storeServiceProvider(Request $request)
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

        return redirect()->route('admin.providers')->with('success', 'Service Provider added successfully.');
    }

    public function confirmServiceProvider($slug)
    {
        $provider = User::findOrFail($slug);

        if (!$provider) {
            return back()->with('error', 'Unable to get the service provider.');
        }
        if ($provider->role != 'provider') {
            return back()->with('error', 'Invalid operation.');
        }

        $provider->status = 'approved';
        $provider->save();

        return redirect()->route('admin.providers')->with('success', 'Service Provider approved successfully.');
    }

    public function editServiceProvider($slug)
    {
        $provider = User::findOrFail($slug);

        if (!$provider) {
            return back()->with('error', 'Unable to get the service provider.');
        }

        $serviceCategories = ServiceCategory::all();
        return view('admin.service-providers.edit', compact('provider', 'serviceCategories'));
    }
    public function updateServiceProvider(Request $request, $slug)
    {

        $provider = User::findOrFail($slug);

        if ($provider->role != 'provider') {
            return back()->with('error', 'Invalid operation.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $provider->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $provider->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|confirmed|min:6',
            'status' => 'required|in:pending,approved,blocked',
            'description' => 'required|string',
            'service_category_id' => 'required'
        ]);

        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->phone_number = $request->phone_number;
        $provider->status = $request->status;

        if ($request->hasFile('profile_picture')) {

            if ($provider->profile_picture && Storage::disk('public')->exists($provider->profile_picture)) {
                Storage::disk('public')->delete($provider->profile_picture);
            }

            $provider->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->filled('password')) {
            $provider->password = bcrypt($request->password);
        }
        $existingImages = json_decode($provider->portfolio_images, true) ?? [];
        $newImages = [];

        if ($request->hasFile('portfolio_images')) {
            foreach ($request->file('portfolio_images') as $image) {
                $newImages[] = $image->store('portfolio_images', 'public');
            }
        }

        $allImages = array_merge($existingImages, $newImages);
        $provider->portfolio_images = json_encode($allImages);
        $provider->description = $request->description;
        $provider->service_category_id = $request->service_category_id;
        $provider->save();

        return redirect()->route('admin.providers')->with('success', 'Service Provider updated successfully.');
    }

    public function deleteServiceProvider($slug)
    {
        $provider = User::findOrFail($slug);

        if (!$provider) {
            return back()->with('error', 'Unable to get the service provider.');
        }

        if ($provider->profile_picture && Storage::disk('public')->exists($provider->profile_picture)) {
            Storage::disk('public')->delete($provider->profile_picture);
        }

        $provider->delete();

        return redirect()->route('admin.providers')->with('success', 'Service Provider deleted successfully.');
    }



    public function deleteImage($providerId, $key)
    {
        $provider = User::findOrFail($providerId);

        $images = json_decode($provider->portfolio_images, true);

        if (isset($images[$key])) {
            $path = $images[$key];

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            unset($images[$key]);

            // Reindex the array to avoid gaps
            $provider->portfolio_images = json_encode(array_values($images));
            $provider->save();
        }

        return back()->with('success', 'Image removed successfully.');
    }
}
