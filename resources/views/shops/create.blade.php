@extends('layouts.premium')

@section('title', 'Add New Shop')

@section('actions')
    <a href="{{ route('shops.index') }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Shops</span>
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

    <form action="{{ route('shops.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Shop Name <span style="color: var(--accent);">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. NCCC Supermarket" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. Fashion, Electronics">
        </div>

        <div class="form-group">
            <label class="form-label" for="location">Location / Unit No.</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. Level 1, L1-04">
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-glow">
                <i class="ph-bold ph-check"></i>
                <span>Save Shop</span>
            </button>
        </div>
    </form>
</div>
@endsection
