<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\User;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $query = Market::withCount('farmers');

        $search = $request->input('search');
        if ($search) {
            $query->where('market_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
        }

        $markets = $query->latest()->paginate(15)->withQueryString();

        return view('admin.markets.index', compact('markets'));
    }

    public function create()
    {
        return view('admin.markets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'market_name'    => 'required|string|max:191',
            'description'    => 'nullable|string',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'operating_days' => 'required|string|max:191',
            'opening_time'   => 'required',
            'closing_time'   => 'required',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'map_provider'   => 'nullable|in:google,openstreetmap',
            'status'         => 'required|in:active,inactive',
        ]);

        Market::create($data);

        return redirect()->route('admin.markets.index')->with('success', 'Market created.');
    }

    public function show(Market $market)
    {
        $market->load('farmers.farmerProfile');

        $assignedIds      = $market->farmers->pluck('id');
        $availableFarmers = User::where('role', 'farmer')
                                 ->where('status', 'active')
                                 ->whereHas('farmerProfile', function ($q) {
                                     $q->where('approval_status', 'approved');
                                 })
                                 ->whereNotIn('id', $assignedIds)
                                 ->with('farmerProfile')
                                 ->get();

        return view('admin.markets.show', compact('market', 'availableFarmers'));
    }

    public function edit(Market $market)
    {
        return view('admin.markets.edit', compact('market'));
    }

    public function update(Request $request, Market $market)
    {
        $data = $request->validate([
            'market_name'    => 'required|string|max:191',
            'description'    => 'nullable|string',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'operating_days' => 'required|string|max:191',
            'opening_time'   => 'required',
            'closing_time'   => 'required',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'map_provider'   => 'nullable|in:google,openstreetmap',
            'status'         => 'required|in:active,inactive',
        ]);

        $market->update($data);

        return redirect()->route('admin.markets.index')->with('success', 'Market updated.');
    }

    public function destroy(Market $market)
    {
        $market->delete();

        return redirect()->route('admin.markets.index')->with('success', 'Market deleted.');
    }

    public function toggle(Market $market)
    {
        $newStatus = $market->status === 'active' ? 'inactive' : 'active';
        $market->update(['status' => $newStatus]);

        return back()->with('success', 'Market status updated.');
    }
}
