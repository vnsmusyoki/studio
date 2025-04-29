<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminClientsController extends Controller
{

    public function allClients()
    {
        $clients = User::role('client')->get();
        return view('admin.clients.index', compact('clients'));
    }
}
