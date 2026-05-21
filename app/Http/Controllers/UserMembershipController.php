<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMembershipController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        if ($user->membership) {
            return redirect()->route('user.dashboard')->with('info', 'You already have a membership application or an active membership.');
        }

        return view('user.membership.apply');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->membership) {
            return redirect()->route('user.dashboard')->with('error', 'You already have a membership.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|in:gcash,maya,bdo,bpi',
        ]);

        \App\Models\Membership::create([
            'user_id' => $user->id,
            'tier' => 'Bronze', // default tier
            'points' => 0,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
        ]);

        return redirect('/')->with('success', 'Your membership application and payment have been submitted! Please wait for admin approval.');
    }
}
