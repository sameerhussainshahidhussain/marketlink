<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\User;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $markets = Market::where('status', 'active')
                         ->whereNotNull('latitude')
                         ->whereNotNull('longitude')
                         ->withCount(['farmers' => function ($q) {
                             $q->where('status', 'active');
                         }])
                         ->get();

        $farmers = User::where('role', 'farmer')
                       ->where('status', 'active')
                       ->whereHas('farmerProfile', function ($q) {
                           $q->where('approval_status', 'approved')
                             ->whereNotNull('latitude');
                       })
                       ->with('farmerProfile')
                       ->get();

        $mapLocations = $markets->map(function ($m) {
            $hours = date('h:i A', strtotime($m->opening_time)) . ' - ' . date('h:i A', strtotime($m->closing_time));

            return [
                'id'       => $m->id,
                'slug'     => $m->slug,
                'type'     => 'market',
                'name'     => $m->market_name,
                'city'     => $m->city,
                'address'  => $m->address,
                'lat'      => (float) $m->latitude,
                'lng'      => (float) $m->longitude,
                'days'     => $m->operating_days,
                'hours'    => $hours,
                'farmers'  => $m->farmers_count . ' Verified Grower(s)',
                'url'      => route('markets.show', $m),
                'gmaps'    => "https://www.google.com/maps/dir/?api=1&destination={$m->latitude},{$m->longitude}",
            ];
        });

        return view('pages.map', compact('markets', 'farmers', 'mapLocations'));
    }
}
