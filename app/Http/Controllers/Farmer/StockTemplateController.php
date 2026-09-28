<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\WeeklyStockTemplate;
use App\Models\WeeklyStockItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTemplateController extends Controller
{
    public function index()
    {
        $templates = WeeklyStockTemplate::where('farmer_id', Auth::id())
                                         ->with('items.product')
                                         ->latest()
                                         ->paginate(10);
        return view('farmer.stock-templates.index', compact('templates'));
    }

    public function create()
    {
        $products = Auth::user()->products()->where('status', 'active')->get();
        return view('farmer.stock-templates.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:191',
            'day_of_week'=> 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'items'      => 'required|array|min:1',
            'items.*.product_id'       => 'required|exists:products,id',
            'items.*.default_quantity' => 'required|integer|min:1',
            'items.*.default_price'    => 'required|numeric|min:0',
        ]);

        $template = WeeklyStockTemplate::create([
            'farmer_id'  => Auth::id(),
            'name'        => $data['name'],
            'day_of_week' => $data['day_of_week'],
            'status'      => 'active',
        ]);

        foreach ($data['items'] as $item) {
            $template->items()->create($item);
        }

        return redirect()->route('farmer.stock-templates.index')
                         ->with('success', 'Stock template saved.');
    }

    public function edit(WeeklyStockTemplate $stockTemplate)
    {
        abort_unless($stockTemplate->farmer_id === Auth::id(), 403);
        $stockTemplate->load('items.product');
        $products = Auth::user()->products()->where('status', 'active')->get();
        return view('farmer.stock-templates.edit', compact('stockTemplate', 'products'));
    }

    public function update(Request $request, WeeklyStockTemplate $stockTemplate)
    {
        abort_unless($stockTemplate->farmer_id === Auth::id(), 403);

        $data = $request->validate([
            'name'       => 'required|string|max:191',
            'day_of_week'=> 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'status'     => 'required|in:active,inactive',
            'items'      => 'required|array|min:1',
            'items.*.product_id'       => 'required|exists:products,id',
            'items.*.default_quantity' => 'required|integer|min:1',
            'items.*.default_price'    => 'required|numeric|min:0',
        ]);

        $stockTemplate->update([
            'name'        => $data['name'],
            'day_of_week' => $data['day_of_week'],
            'status'      => $data['status'],
        ]);

        $stockTemplate->items()->delete();
        foreach ($data['items'] as $item) {
            $stockTemplate->items()->create($item);
        }

        return redirect()->route('farmer.stock-templates.index')
                         ->with('success', 'Template updated.');
    }

    public function destroy(WeeklyStockTemplate $stockTemplate)
    {
        abort_unless($stockTemplate->farmer_id === Auth::id(), 403);
        $stockTemplate->items()->delete();
        $stockTemplate->delete();
        return redirect()->route('farmer.stock-templates.index')
                         ->with('success', 'Template deleted.');
    }

    public function show(WeeklyStockTemplate $stockTemplate)
    {
        abort_unless($stockTemplate->farmer_id === Auth::id(), 403);
        $stockTemplate->load('items.product');
        return view('farmer.stock-templates.show', compact('stockTemplate'));
    }
}
