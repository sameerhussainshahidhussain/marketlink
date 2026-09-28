<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showCustomerForm()
    {
        return view('auth.register-customer');
    }

    public function showFarmerForm()
    {
        return view('auth.register-farmer');
    }

    public function registerCustomer(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:191'],
            'email'    => ['required', 'email', 'max:191', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'address'  => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => 'customer',
            'status'   => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard')
                         ->with('success', 'Welcome to MarketLink, ' . $user->name . '!');
    }

    public function registerFarmer(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'email'         => ['required', 'email', 'max:191', 'unique:users,email'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'password'      => ['required', 'confirmed', Password::min(8)],
            'business_name' => ['required', 'string', 'max:191'],
            'address'       => ['nullable', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => 'farmer',
            'status'   => 'pending',
        ]);

        $user->farmerProfile()->create([
            'business_name'   => $data['business_name'],
            'contact_person'  => $data['name'],
            'address'         => $data['address'] ?? null,
            'description'     => $data['description'] ?? null,
            'approval_status' => 'pending',
        ]);

        Auth::login($user);

        return redirect()->route('farmer.dashboard')
                         ->with('info', 'Your farmer account is pending admin approval.');
    }
}
