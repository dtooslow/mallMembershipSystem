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

        <div class="form-group">
            <label class="form-label" for="image">Shop Image URL</label>
            <input type="url" id="image" name="image" class="form-control" value="{{ old('image') }}" placeholder="e.g. https://images.unsplash.com/photo-...">
        </div>

        <div style="margin-top: 2rem; margin-bottom: 2rem; padding: 2rem; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border); border-radius: 20px;">
            <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px; color: var(--secondary);">
                <i class="ph-bold ph-sparkles"></i>
                <span>Initial Sale Product (Optional)</span>
            </h3>

            <div class="form-group">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="e.g. Wireless Fast Charger">
            </div>

            <div class="form-group">
                <label class="form-label" for="product_description">Description</label>
                <textarea id="product_description" name="product_description" class="form-control" style="min-height: 80px;" placeholder="Brief details about the sale item...">{{ old('product_description') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label" for="product_price">Original Price ($)</label>
                    <input type="number" step="0.01" min="0" id="product_price" name="product_price" class="form-control" value="{{ old('product_price') }}" placeholder="e.g. 29.99">
                </div>

                <div class="form-group">
                    <label class="form-label" for="product_sale_price">Discounted Sale Price ($)</label>
                    <input type="number" step="0.01" min="0" id="product_sale_price" name="product_sale_price" class="form-control" value="{{ old('product_sale_price') }}" placeholder="e.g. 19.99">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="product_image">Product Image URL</label>
                <input type="url" id="product_image" name="product_image" class="form-control" value="{{ old('product_image') }}" placeholder="e.g. https://images.unsplash.com/photo-...">
            </div>
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
