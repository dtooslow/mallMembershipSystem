<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_id'       => 'required|exists:shops,id',
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric|min:0.01',
            'sale_price'    => 'required|numeric|min:0.01',
            'image'         => 'nullable|url',
            'points_earned' => 'nullable|integer|min:0',
        ]);

        $validated['is_on_sale']    = true;
        $validated['has_discount']  = $request->has('has_discount');
        $validated['points_earned'] = (int) ($request->input('points_earned', 0));

        Product::create($validated);

        return redirect()->route('shops.edit', $request->shop_id)
            ->with('success', 'Product added to catalog successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric|min:0.01',
            'sale_price'    => 'nullable|numeric|min:0.01',
            'image'         => 'nullable|url',
            'is_on_sale'    => 'boolean',
            'has_discount'  => 'boolean',
            'points_earned' => 'nullable|integer|min:0',
        ]);

        $validated['is_on_sale']    = $request->has('is_on_sale');
        $validated['has_discount']  = $request->has('has_discount');
        $validated['points_earned'] = (int) ($request->input('points_earned', 0));

        $product->update($validated);

        return redirect()->route('shops.edit', $product->shop_id)
            ->with('success', 'Product updated successfully.');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_on_sale' => !$product->is_on_sale]);
        $status = $product->is_on_sale ? 'marked as Visible' : 'Hidden from public view';
        return redirect()->route('shops.edit', $product->shop_id)
            ->with('success', "\"$product->name\" is now $status.");
    }

    public function toggleDiscount(Product $product)
    {
        $product->update(['has_discount' => !$product->has_discount]);
        $status = $product->has_discount ? 'Discount enabled' : 'Discount disabled';
        return redirect()->route('shops.edit', $product->shop_id)
            ->with('success', "\"$product->name\": $status.");
    }

    public function destroy(Product $product)
    {
        $shopId = $product->shop_id;
        $product->delete();

        return redirect()->route('shops.edit', $shopId)
            ->with('success', 'Product removed from catalog.');
    }
}
