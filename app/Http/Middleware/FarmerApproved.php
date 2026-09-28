<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FarmerApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->isFarmer()) {
            $profile = $user->farmerProfile;

            if (!$profile || $profile->approval_status !== 'approved') {
                return redirect()->route('farmer.dashboard')
                                 ->with('warning', 'Your account is awaiting admin approval. Some features are restricted.');
            }
        }

        return $next($request);
    }
}
