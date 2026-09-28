<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function orders()
    {
        return view('customer.orders');
    }

    public function favorites()
    {
        return view('customer.favorites');
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function notifications()
    {
        return view('customer.notifications');
    }

    public function reviews()
    {
        return view('customer.reviews');
    }
}
