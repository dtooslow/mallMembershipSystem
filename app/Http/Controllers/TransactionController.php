<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'shop'])->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $shops = \App\Models\Shop::all();
        return view('transactions.create', compact('users', 'shops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
            'amount' => 'required|numeric|min:0.01',
            'points_earned' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $transaction = Transaction::create($validated);

            // Add points to user's membership
            $membership = Membership::firstOrCreate(
                ['user_id' => $validated['user_id']],
                [
                    'tier' => 'Bronze',
                    'points' => 0,
                    'expires_at' => now()->addYear(),
                    'last_renewed_at' => now(),
                ]
            );
            
            $membership->points += $validated['points_earned'];
            $membership->save();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'shop']);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Typically transactions shouldn't be updated, but for completion:
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'points_earned' => 'required|integer|min:0',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
