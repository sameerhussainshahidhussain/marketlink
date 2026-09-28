<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function markets()
    {
        return view('admin.markets');
    }

    public function farmers()
    {
        return view('admin.farmers');
    }

    public function customers()
    {
        return view('admin.customers');
    }

    public function products()
    {
        return view('admin.products');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function announcements()
    {
        return view('admin.announcements');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
