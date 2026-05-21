<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|url',
            // Initial product optional fields
            'product_name' => 'nullable|required_with:product_price,product_sale_price|string|max:255',
            'product_description' => 'nullable|string',
            'product_price' => 'nullable|required_with:product_name|numeric|min:0.01',
            'product_sale_price' => 'nullable|required_with:product_name|numeric|min:0.01',
            'product_image' => 'nullable|url',
        ]);

        $shop = Shop::create([
            'name' => $validated['name'],
            'category' => $validated['category'] ?? null,
            'location' => $validated['location'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);

        if (!empty($validated['product_name'])) {
            $shop->products()->create([
                'name' => $validated['product_name'],
                'description' => $validated['product_description'] ?? null,
                'price' => $validated['product_price'],
                'sale_price' => $validated['product_sale_price'],
                'image' => $validated['product_image'] ?? null,
                'is_on_sale' => true,
            ]);
        }

        return redirect()->route('shops.index')->with('success', 'Shop created successfully.');
    }

    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }

    public function edit(Shop $shop)
    {
        $products = $shop->products()->latest()->get();
        return view('shops.edit', compact('shop', 'products'));
    }

    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|url',
        ]);

        $shop->update($validated);

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully.');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully.');
    }

    public function showPublic(Shop $shop)
    {
        $products = $shop->products()->where('is_on_sale', true)->get();
        return view('shops.public_show', compact('shop', 'products'));
    }
}
