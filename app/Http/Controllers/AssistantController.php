<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function query(Request $request)
    {
        $rawMessage = $request->input('message', '');
        $prompt     = strtolower(trim($rawMessage));

        if (empty($prompt)) {
            return response()->json([
                'reply' => "Hello! I am MarketLink's Assistant. You can ask me about active farmers markets, available produce and prices, farmer stalls, or pickup guidelines."
            ]);
        }

        $marketKeywords = ['market', 'timing', 'when', 'where', 'location'];
        $isMarketQuery  = false;

        foreach ($marketKeywords as $kw) {
            if (str_contains($prompt, $kw)) {
                $isMarketQuery = true;
                break;
            }
        }

        if ($isMarketQuery) {
            $markets = Market::where('status', 'active')->take(4)->get();

            if ($markets->isNotEmpty()) {
                $lines = [];
                foreach ($markets as $m) {
                    $open  = date('h:i A', strtotime($m->opening_time));
                    $close = date('h:i A', strtotime($m->closing_time));
                    $lines[] = "• **{$m->market_name}** in {$m->city}: Open on {$m->operating_days} ({$open} - {$close}). Address: {$m->address}.";
                }

                $info = implode("\n", $lines);
                $link = route('markets.index');

                return response()->json([
                    'reply' => "Here are our currently active farmers markets:\n\n{$info}\n\nYou can browse full details on our [Markets Directory]({$link})."
                ]);
            }
        }

        $terms    = explode(' ', $prompt);
        $products = Product::where('status', 'active')
            ->where('availability', '!=', 'sold_out')
            ->where(function ($q) use ($terms) {
                foreach ($terms as $t) {
                    if (strlen($t) > 2) {
                        $q->orWhere('name', 'like', "%{$t}%")
                          ->orWhere('description', 'like', "%{$t}%");
                    }
                }
            })
            ->with(['farmer.farmerProfile'])
            ->take(4)
            ->get();

        if ($products->isNotEmpty()) {
            $list = [];
            foreach ($products as $p) {
                $list[] = "• **{$p->name}**: Rs. {$p->price} / {$p->unit} (Stock: {$p->stock_quantity} available from {$p->farmer->name})";
            }

            $productLink = route('products.index');

            return response()->json([
                'reply' => "Here is what we currently have in stock from verified local farmers:\n\n" . implode("\n", $list) . "\n\nYou can reserve these on our [Produce Marketplace]({$productLink})."
            ]);
        }

        $helpKeywords = ['pay', 'pickup', 'order', 'how'];
        $isHelpQuery  = false;

        foreach ($helpKeywords as $kw) {
            if (str_contains($prompt, $kw)) {
                $isHelpQuery = true;
                break;
            }
        }

        if ($isHelpQuery) {
            return response()->json([
                'reply' => "MarketLink operates on a transparent **Pre-Order & Pickup** model:\n\n1. Browse fresh produce harvested by local growers.\n2. Add items to your pickup basket.\n3. Choose your designated market pickup slot.\n4. **No online payment required!** You inspect your produce and settle payment in person at the stall upon pickup."
            ]);
        }

        $marketsUrl  = route('markets.index');
        $farmersUrl  = route('farmers.index');
        $catalogUrl  = route('products.index');

        return response()->json([
            'reply' => "I couldn't find a direct match, but you can explore our active [Markets]({$marketsUrl}), meet our [Farmers]({$farmersUrl}), or view our harvest [Catalog]({$catalogUrl}). How else can I assist you today?"
        ]);
    }
}
