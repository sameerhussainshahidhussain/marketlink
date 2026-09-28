<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'farmer')->with(['farmerProfile', 'products']);

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('farmerProfile', function ($p) use ($search) {
                      $p->where('business_name', 'like', "%{$search}%");
                  });
            });
        }

        $status = $request->input('status');
        if ($status && in_array($status, ['active', 'suspended', 'pending'])) {
            $query->where('status', $status);
        }

        $approval = $request->input('approval_status');
        if ($approval) {
            $query->whereHas('farmerProfile', function ($p) use ($approval) {
                $p->where('approval_status', $approval);
            });
        }

        $farmers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.farmers.index', compact('farmers'));
    }

    public function pending()
    {
        $farmers = User::where('role', 'farmer')
                        ->whereHas('farmerProfile', function ($q) {
                            $q->where('approval_status', 'pending');
                        })
                        ->with('farmerProfile')
                        ->latest()
                        ->paginate(15);

        return view('admin.farmers.pending', compact('farmers'));
    }

    public function show(User $farmer)
    {
        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        $farmer->load(['farmerProfile', 'products.category', 'markets', 'pickupSlots.market', 'farmerOrders']);

        return view('admin.farmers.show', compact('farmer'));
    }

    public function approve(User $farmer)
    {
        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        $farmer->update(['status' => 'active']);
        $farmer->farmerProfile()->update(['approval_status' => 'approved']);

        return back()->with('success', "Farmer account approved successfully.");
    }

    public function suspend(User $farmer)
    {
        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        $farmer->update(['status' => 'suspended']);
        $farmer->farmerProfile()->update(['approval_status' => 'suspended']);

        return back()->with('success', "Farmer account suspended.");
    }

    public function activate(User $farmer)
    {
        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        $farmer->update(['status' => 'active']);
        $farmer->farmerProfile()->update(['approval_status' => 'approved']);

        return back()->with('success', "Farmer account activated.");
    }
}
