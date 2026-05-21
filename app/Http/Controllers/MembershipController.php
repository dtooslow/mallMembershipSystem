<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('user')->get();
        return view('memberships.index', compact('memberships'));
    }

    public function create()
    {
        $users = \App\Models\User::doesntHave('membership')->get();
        return view('memberships.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:memberships,user_id',
            'tier' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);

        if (empty($validated['expires_at'])) {
            $validated['expires_at'] = now()->addYear();
        }
        $validated['last_renewed_at'] = now();

        Membership::create($validated);

        return redirect()->route('memberships.index')->with('success', 'Membership created successfully.');
    }

    public function show(Membership $membership)
    {
        $membership->load('user');
        return view('memberships.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        $membership->load('user');
        return view('memberships.edit', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $membership->load('user');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $membership->user_id,
            'tier' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
            'expires_at' => 'nullable|date',
            'status' => 'required|string|in:pending,active,expired,rejected',
        ]);

        // Update user
        $membership->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $newExpires = $validated['expires_at'] ? \Carbon\Carbon::parse($validated['expires_at']) : null;
        $oldExpires = $membership->expires_at;

        // If explicitly renewed via checkbox/button or expires_at is extended
        if ($request->boolean('renew_auto')) {
            $currentExpiry = $membership->expires_at;
            if ($currentExpiry && $currentExpiry->isFuture()) {
                $newExpires = $currentExpiry->addYear();
            } else {
                $newExpires = now()->addYear();
            }
            $membership->last_renewed_at = now();
        } elseif ($oldExpires != $newExpires) {
            $membership->last_renewed_at = now();
        }

        $membership->update([
            'tier' => $validated['tier'],
            'points' => $validated['points'],
            'expires_at' => $newExpires,
            'status' => $validated['status'],
        ]);

        return redirect()->route('memberships.index')->with('success', 'Membership updated successfully.');
    }

    public function approve(Membership $membership)
    {
        $membership->update([
            'status' => 'active',
            'expires_at' => now()->addYear(),
            'last_renewed_at' => now(),
        ]);

        return redirect()->route('memberships.index')->with('success', 'Membership application approved and activated.');
    }

    public function reject(Membership $membership)
    {
        $membership->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('memberships.index')->with('success', 'Membership application has been rejected.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('memberships.index')->with('success', 'Membership deleted successfully.');
    }
}
