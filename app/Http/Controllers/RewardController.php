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
}
