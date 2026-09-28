<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FarmerDashboardController extends Controller
{
    public function login()
    {
        return view('farmer.login');
    }

    public function register()
    {
        return view('farmer.register');
    }

    public function dashboard()
    {
        return view('farmer.dashboard');
    }

    public function products()
    {
        return view('farmer.products');
    }

    public function addProduct()
    {
        return view('farmer.add-product');
    }

    public function orders()
    {
        return view('farmer.orders');
    }

    public function pickupSlots()
    {
        return view('farmer.pickup-slots');
    }

    public function insights()
    {
        return view('farmer.insights');
    }

    public function reviews()
    {
        return view('farmer.reviews');
    }

    public function profile()
    {
        return view('farmer.profile');
    }

    public function settings()
    {
        return view('farmer.settings');
    }
}
