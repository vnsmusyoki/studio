<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $user = Auth::user();

        // $user->assignRole('admin');

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('provider')) {
            return redirect()->route('provider.dashboard');
        } elseif ($user->hasRole('client')) {
            return redirect()->route('client.dashboard');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
