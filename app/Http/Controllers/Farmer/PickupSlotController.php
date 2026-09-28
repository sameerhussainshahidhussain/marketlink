<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\PickupSlot;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupSlotController extends Controller
{
    public function index()
    {
        $farmer = Auth::user();
        $slots  = $farmer->pickupSlots()
                          ->with('market')
                          ->orderByDesc('pickup_date')
                          ->paginate(15);
        return view('farmer.pickup-slots.index', compact('slots'));
    }

    public function create()
    {
        $markets = Market::where('status', 'active')->get();
        return view('farmer.pickup-slots.create', compact('markets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'market_id'   => 'required|exists:markets,id',
            'pickup_date' => 'required|date|after:today',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'max_orders'  => 'required|integer|min:1|max:200',
            'cutoff_time' => 'required|date|before:pickup_date',
        ]);

        $data['farmer_id']      = Auth::id();
        $data['current_orders'] = 0;
        $data['status']         = 'available';

        PickupSlot::create($data);

        return redirect()->route('farmer.pickup-slots.index')
                         ->with('success', 'Pickup slot created.');
    }

    public function edit(PickupSlot $pickupSlot)
    {
        abort_unless($pickupSlot->farmer_id === Auth::id(), 403);
        $markets = Market::where('status', 'active')->get();
        return view('farmer.pickup-slots.edit', compact('pickupSlot', 'markets'));
    }

    public function update(Request $request, PickupSlot $pickupSlot)
    {
        abort_unless($pickupSlot->farmer_id === Auth::id(), 403);

        $data = $request->validate([
            'market_id'   => 'required|exists:markets,id',
            'pickup_date' => 'required|date|after:today',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'max_orders'  => 'required|integer|min:1',
            'cutoff_time' => 'required|date',
            'status'      => 'required|in:available,closed',
        ]);

        $pickupSlot->update($data);

        return redirect()->route('farmer.pickup-slots.index')
                         ->with('success', 'Pickup slot updated.');
    }

    public function destroy(PickupSlot $pickupSlot)
    {
        abort_unless($pickupSlot->farmer_id === Auth::id(), 403);
        abort_if($pickupSlot->current_orders > 0, 422);
        $pickupSlot->delete();
        return redirect()->route('farmer.pickup-slots.index')
                         ->with('success', 'Pickup slot deleted.');
    }

    public function show(PickupSlot $pickupSlot)
    {
        abort_unless($pickupSlot->farmer_id === Auth::id(), 403);
        $pickupSlot->load(['market', 'orders.customer']);
        return view('farmer.pickup-slots.show', compact('pickupSlot'));
    }
}
