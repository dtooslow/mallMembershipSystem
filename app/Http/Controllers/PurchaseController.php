<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Show the purchase confirmation page for a product.
     */
    public function confirm(Product $product)
    {
        $membership = Auth::user()->membership ?? null;
        return view('purchase.confirm', compact('product', 'membership'));
    }

    /**
     * Process the purchase and award points.
     */
    public function buy(Request $request, Product $product)
    {
        $user = Auth::user();

        // Verify product is visible
        if (!$product->is_on_sale) {
            return redirect()->route('shops.public.show', $product->shop_id)
                ->with('error', 'This product is no longer available.');
        }

        $quantity  = max(1, (int) $request->input('quantity', 1));
        $unitPrice = $product->effectivePrice();
        $total     = $unitPrice * $quantity;
        $points    = $product->points_earned * $quantity;

        DB::transaction(function () use ($user, $product, $quantity, $total, $points) {
            // Record the transaction
            Transaction::create([
                'user_id'      => $user->id,
                'shop_id'      => $product->shop_id,
                'product_id'   => $product->id,
                'quantity'     => $quantity,
                'description'  => "Purchase: {$product->name} × {$quantity} @ ₱" . number_format($product->effectivePrice(), 2),
                'amount'       => $total,
                'points_earned' => $points,
            ]);

            // Award points to membership (only if active)
            $membership = Membership::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if ($membership) {
                $membership->increment('points', $points);
            }
        });

        return redirect()->route('purchase.receipt', [
            'product'  => $product->id,
            'quantity' => $quantity,
            'total'    => $total,
            'points'   => $points,
        ]);
    }

    /**
     * Show the purchase receipt page.
     */
    public function receipt(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->query('quantity', 1));
        $total    = (float) $request->query('total', $product->effectivePrice());
        $points   = (int) $request->query('points', $product->points_earned);
        $membership = Auth::user()->membership ?? null;

        // Get the latest transaction for this user/product for display
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->latest()
            ->first();

        return view('purchase.receipt', compact('product', 'quantity', 'total', 'points', 'membership', 'transaction'));
    }
}
