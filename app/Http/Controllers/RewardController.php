<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('rewards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_required' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        Reward::create($validated);

        return redirect()->route('rewards.index')->with('success', 'Reward created successfully.');
    }

    public function show(Reward $reward)
    {
        return view('rewards.show', compact('reward'));
    }

    public function edit(Reward $reward)
    {
        return view('rewards.edit', compact('reward'));
    }

    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_required' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        $reward->update($validated);

        return redirect()->route('rewards.index')->with('success', 'Reward updated successfully.');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->route('rewards.index')->with('success', 'Reward deleted successfully.');
    }

    public function claim(Request $request, Reward $reward)
    {
        $user = $request->user();

        // Check if user has a membership
        if (!$user->membership) {
            return back()->with('error', 'You need to be a member to claim rewards.');
        }

        // Check stock
        if ($reward->stock <= 0) {
            return back()->with('error', 'Sorry, this reward is out of stock.');
        }

        // Check points
        if ($user->membership->points < $reward->points_required) {
            return back()->with('error', 'You do not have enough points to claim this reward.');
        }

        // Perform the claim in a transaction
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($user, $reward) {
                // Deduct points
                $user->membership->decrement('points', $reward->points_required);
                
                // Deduct stock
                $reward->decrement('stock', 1);

                // Record the redemption
                \App\Models\RewardRedemption::create([
                    'user_id' => $user->id,
                    'reward_id' => $reward->id,
                    'reward_name' => $reward->name,
                    'points_spent' => $reward->points_required,
                ]);
            });

            return back()->with('success', 'You have successfully claimed: ' . $reward->name . '!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while claiming the reward. Please try again.');
        }
    }
}
