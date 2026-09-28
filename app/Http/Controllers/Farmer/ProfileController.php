<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->load('farmerProfile');
        return view('farmer.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'          => 'required|string|max:191',
            'phone'         => 'nullable|string|max:20',
            'business_name' => 'required|string|max:191',
            'address'       => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'location_name' => 'nullable|string|max:191',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($user->profile_image) Storage::disk('public')->delete($user->profile_image);
            $user->update(['profile_image' => $request->file('image')->store('avatars', 'public')]);
        }

        $user->update(['name' => $data['name'], 'phone' => $data['phone'] ?? null]);

        $user->farmerProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'business_name' => $data['business_name'],
                'address'       => $data['address'] ?? null,
                'description'   => $data['description'] ?? null,
                'location_name' => $data['location_name'] ?? null,
                'latitude'      => $data['latitude'] ?? null,
                'longitude'     => $data['longitude'] ?? null,
            ]
        );

        return back()->with('success', 'Profile updated.');
    }
}
