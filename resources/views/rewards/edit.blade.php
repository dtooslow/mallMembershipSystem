@extends('layouts.premium')

@section('title', 'Edit Reward')

@section('actions')
    <a href="{{ route('rewards.index') }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Catalog</span>
    </a>
@endsection

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    
    @if ($errors->any())
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
            <ul style="margin-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rewards.update', $reward) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="name">Reward Name <span style="color: var(--accent);">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $reward->name) }}" placeholder="e.g. Free Coffee Voucher" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" style="background: rgba(0,0,0,0.2); color: white; resize: vertical; min-height: 100px;" placeholder="Describe what the customer gets with this reward...">{{ old('description', $reward->description) }}</textarea>
        </div>

        <div class="grid-fields" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label" for="points_required">Points Required <span style="color: var(--accent);">*</span></label>
                <input type="number" min="1" id="points_required" name="points_required" class="form-control" value="{{ old('points_required', $reward->points_required) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="stock">Available Stock <span style="color: var(--accent);">*</span></label>
                <input type="number" min="0" id="stock" name="stock" class="form-control" value="{{ old('stock', $reward->stock) }}" required>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-glow">
                <i class="ph-bold ph-check"></i>
                <span>Update Reward</span>
            </button>
        </div>
    </form>
</div>
@endsection
