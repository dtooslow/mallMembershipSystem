@extends('layouts.premium')

@section('title', 'Edit Product')

@section('actions')
    <a href="{{ route('shops.edit', $product->shop_id) }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Shop</span>
    </a>
@endsection

@section('content')
<div class="glass-card" style="max-width: 640px; margin: 0 auto; padding: 2.5rem;">
    <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--primary); display: flex; align-items: center; gap: 8px;">
        <i class="ph-bold ph-pencil-simple"></i>
        <span>Edit Product Details</span>
    </h3>
    <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 2rem;">
        Shop: <strong>{{ $product->shop->name }}</strong>
    </p>

    @if ($errors->any())
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
            <ul style="margin-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="form-group">
            <label class="form-label" for="name">Product Name <span style="color: var(--accent);">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" style="min-height: 90px;" placeholder="Brief details about the product...">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Image URL with live preview --}}
        <div class="form-group">
            <label class="form-label" for="image">Product Image URL</label>
            <input type="url" id="image" name="image" class="form-control" value="{{ old('image', $product->image) }}" placeholder="https://images.unsplash.com/..." oninput="updateImagePreview(this.value)">
            <div id="image-preview-wrap" style="margin-top: 12px; display: {{ $product->image ? 'block' : 'none' }};">
                <img id="image-preview" src="{{ $product->image ?? '' }}" alt="Preview" onerror="this.parentElement.style.display='none';" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border);">
            </div>
        </div>

        {{-- Original Price --}}
        <div class="form-group">
            <label class="form-label" for="price">Original Price (₱) <span style="color: var(--accent);">*</span></label>
            <div style="position: relative;">
                <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748B; font-weight: 700; font-size: 1rem;">₱</span>
                <input type="number" step="0.01" min="0.01" id="price" name="price" class="form-control" style="padding-left: 2rem;" value="{{ old('price', $product->price) }}" required oninput="updateDiscount()">
            </div>
        </div>

        {{-- Discount Toggle --}}
        <div style="background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                <div>
                    <div style="font-weight: 700; font-size: 1rem; color: var(--text-dark);">Discount Status</div>
                    <div style="font-size: 0.85rem; color: #64748B; margin-top: 2px;">Enable to apply a discount to this product</div>
                </div>

                {{-- Toggle Switch --}}
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; user-select: none;">
                    <input type="checkbox" id="has_discount" name="has_discount" value="1" {{ old('has_discount', $product->has_discount) ? 'checked' : '' }} onchange="toggleDiscountFields(this.checked)" style="display: none;">
                    <div id="toggle-discount-track" style="
                        width: 52px; height: 28px; border-radius: 50px; cursor: pointer; transition: background 0.3s;
                        background: {{ old('has_discount', $product->has_discount) ? 'linear-gradient(135deg, #F43F5E, #E11D48)' : '#CBD5E1' }};
                        position: relative; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                        <div id="toggle-discount-thumb" style="
                            width: 22px; height: 22px; border-radius: 50%; background: white;
                            position: absolute; top: 3px; transition: left 0.3s ease;
                            left: {{ old('has_discount', $product->has_discount) ? '27px' : '3px' }};
                            box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        </div>
                    </div>
                    <span id="toggle-discount-label" style="font-weight: 700; font-size: 0.95rem; color: {{ old('has_discount', $product->has_discount) ? '#F43F5E' : '#94A3B8' }};">
                        {{ old('has_discount', $product->has_discount) ? 'Discount On' : 'No Discount' }}
                    </span>
                </label>
            </div>

            {{-- Sale Price & Discount Preview (only shown when discount is on) --}}
            <div id="discount-fields" style="margin-top: 1.5rem; display: {{ old('has_discount', $product->has_discount) ? 'block' : 'none' }};">
                <div style="border-top: 1px solid var(--border); padding-top: 1.5rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="sale_price">Discounted Price (₱) <span style="color: var(--accent);">*</span></label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--accent); font-weight: 700; font-size: 1rem;">₱</span>
                            <input type="number" step="0.01" min="0.01" id="sale_price" name="sale_price" class="form-control" style="padding-left: 2rem; border-color: rgba(244,63,94,0.3);" value="{{ old('sale_price', $product->sale_price) }}" oninput="updateDiscount()">
                        </div>
                    </div>
                    {{-- Live Discount Preview --}}
                    <div id="discount-preview" style="margin-top: 12px; padding: 10px 16px; border-radius: 10px; background: rgba(244,63,94,0.07); display: flex; align-items: center; gap: 10px;">
                        <i class="ph-bold ph-tag" style="color: var(--accent);"></i>
                        <span style="font-size: 0.9rem; color: var(--text-dark);">Discount:
                            <strong id="discount-pct" style="color: var(--accent); font-size: 1.1rem;">
                                @if($product->price > 0 && $product->sale_price > 0)
                                    {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                                @else
                                    —
                                @endif
                            </strong>
                        </span>
                        <span style="color: #94A3B8; font-size: 0.85rem;">( Original: ₱<span id="preview-orig">{{ number_format($product->price, 2) }}</span> → Sale: ₱<span id="preview-sale">{{ number_format($product->sale_price, 2) }}</span> )</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Sale Toggle --}}
        <div style="background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                <div>
                    <div style="font-weight: 700; font-size: 1rem; color: var(--text-dark);">Show on Public Sale Page</div>
                    <div style="font-size: 0.85rem; color: #64748B; margin-top: 2px;">Toggle to enable or disable displaying this item on the public shop page</div>
                </div>

                {{-- Toggle Switch --}}
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; user-select: none;">
                    <input type="checkbox" id="is_on_sale" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale) ? 'checked' : '' }} onchange="toggleSaleFields(this.checked)" style="display: none;">
                    <div id="toggle-track" style="
                        width: 52px; height: 28px; border-radius: 50px; cursor: pointer; transition: background 0.3s;
                        background: {{ old('is_on_sale', $product->is_on_sale) ? 'linear-gradient(135deg, #10B981, #059669)' : '#CBD5E1' }};
                        position: relative; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                        <div id="toggle-thumb" style="
                            width: 22px; height: 22px; border-radius: 50%; background: white;
                            position: absolute; top: 3px; transition: left 0.3s ease;
                            left: {{ old('is_on_sale', $product->is_on_sale) ? '27px' : '3px' }};
                            box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        </div>
                    </div>
                    <span id="toggle-label" style="font-weight: 700; font-size: 0.95rem; color: {{ old('is_on_sale', $product->is_on_sale) ? '#10B981' : '#94A3B8' }};">
                        {{ old('is_on_sale', $product->is_on_sale) ? 'Visible' : 'Hidden' }}
                    </span>
                </label>
            </div>
        </div>

        {{-- Points Earned --}}
        <div class="form-group">
            <label class="form-label" for="points_earned">
                <i class="ph-fill ph-coin" style="color:#D97706;margin-right:4px;"></i>
                Points Earned per Purchase
            </label>
            <div style="position: relative;">
                <input type="number" min="0" id="points_earned" name="points_earned" class="form-control"
                       value="{{ old('points_earned', $product->points_earned) }}"
                       placeholder="e.g. 50"
                       style="padding-right: 4rem;">
                <span style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#D97706;font-weight:700;font-size:.85rem;">PTS</span>
            </div>
            <p style="font-size:.8rem;color:#94A3B8;margin-top:6px;">Loyalty points the buyer earns on each unit purchased.</p>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('shops.edit', $product->shop_id) }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border); color: var(--text-dark);">Cancel</a>
            <button type="submit" class="btn-glow">
                <i class="ph-bold ph-check"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </form>
</div>


<script>
function toggleSaleFields(isOn) {
    const track = document.getElementById('toggle-track');
    const thumb = document.getElementById('toggle-thumb');
    const label = document.getElementById('toggle-label');

    track.style.background = isOn ? 'linear-gradient(135deg, #10B981, #059669)' : '#CBD5E1';
    thumb.style.left = isOn ? '27px' : '3px';
    label.textContent = isOn ? 'Visible' : 'Hidden';
    label.style.color = isOn ? '#10B981' : '#94A3B8';
}

function toggleDiscountFields(isOn) {
    const fields = document.getElementById('discount-fields');
    const track = document.getElementById('toggle-discount-track');
    const thumb = document.getElementById('toggle-discount-thumb');
    const label = document.getElementById('toggle-discount-label');

    fields.style.display = isOn ? 'block' : 'none';
    track.style.background = isOn ? 'linear-gradient(135deg, #F43F5E, #E11D48)' : '#CBD5E1';
    thumb.style.left = isOn ? '27px' : '3px';
    label.textContent = isOn ? 'Discount On' : 'No Discount';
    label.style.color = isOn ? '#F43F5E' : '#94A3B8';

    if (isOn) updateDiscount();
}

function updateDiscount() {
    const orig = parseFloat(document.getElementById('price').value) || 0;
    const sale = parseFloat(document.getElementById('sale_price')?.value) || 0;

    document.getElementById('preview-orig').textContent = orig.toFixed(2);
    document.getElementById('preview-sale').textContent = sale.toFixed(2);

    if (orig > 0 && sale > 0 && sale < orig) {
        const pct = Math.round(((orig - sale) / orig) * 100);
        document.getElementById('discount-pct').textContent = pct + '% OFF';
    } else {
        document.getElementById('discount-pct').textContent = '—';
    }
}

function updateImagePreview(url) {
    const wrap = document.getElementById('image-preview-wrap');
    const img = document.getElementById('image-preview');
    if (url) {
        img.src = url;
        wrap.style.display = 'block';
        img.onerror = () => { wrap.style.display = 'none'; };
        img.onload = () => { wrap.style.display = 'block'; };
    } else {
        wrap.style.display = 'none';
    }
}
</script>
@endsection
