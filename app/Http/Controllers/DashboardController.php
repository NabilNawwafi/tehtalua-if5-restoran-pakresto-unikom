<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function pelayan()
    {
        return view('dashboard.pelayan', ['user' => Auth::user()]);
    }

    public function koki()
    {
        return view('dashboard.koki', ['user' => Auth::user()]);
    }

    public function kasir()
    {
        return view('dashboard.kasir', ['user' => Auth::user()]);
    }
}