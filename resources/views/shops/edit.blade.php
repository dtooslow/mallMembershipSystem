@extends('layouts.premium')

@section('title', 'Edit Shop')

@section('actions')
    <a href="{{ route('shops.index') }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Shops</span>
    </a>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 1fr; gap: 2.5rem; max-width: 900px; margin: 0 auto;">
    
    <!-- Shop Information Card -->
    <div class="glass-card" style="padding: 2.5rem;">
        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="ph-bold ph-storefront"></i>
            <span>Shop Information</span>
        </h3>

        @if (session('success'))
            <div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #10B981; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;">
                <i class="ph-bold ph-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                <ul style="margin-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shops.update', $shop) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="name">Shop Name <span style="color: var(--accent);">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $shop->name) }}" placeholder="e.g. NCCC Supermarket" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $shop->category) }}" placeholder="e.g. Fashion, Electronics">
            </div>

            <div class="form-group">
                <label class="form-label" for="location">Location / Unit No.</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $shop->location) }}" placeholder="e.g. Level 1, L1-04">
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Shop Image URL</label>
                <input type="url" id="image" name="image" class="form-control" value="{{ old('image', $shop->image) }}" placeholder="e.g. https://images.unsplash.com/photo-..." oninput="previewShopImage(this.value)">
                <div id="shop-img-wrap" style="margin-top: 12px; display: {{ $shop->image ? 'block' : 'none' }};">
                    <img id="shop-img-preview" src="{{ $shop->image ?? '' }}" onerror="this.parentElement.style.display='none';" alt="Shop image" style="width: 100%; max-height: 180px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border);">
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-glow">
                    <i class="ph-bold ph-check"></i>
                    <span>Update Shop</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Products Catalog Card -->
    <div class="glass-card" style="padding: 2.5rem;">
        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--secondary); display: flex; align-items: center; gap: 8px;">
            <i class="ph-bold ph-tag"></i>
            <span>Products Catalog</span>
        </h3>
        <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 2rem;">Manage your products. Use the toggles to instantly enable/disable discounts and show/hide products on the public shop page.</p>

        @if(isset($products) && $products->count() > 0)
            <div style="overflow-x: auto; margin-bottom: 3rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--border); color: #64748B; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">
                            <th style="padding: 0.8rem 0.5rem;">Product</th>
                            <th style="padding: 0.8rem 0.5rem;">Price</th>
                            <th style="padding: 0.8rem 0.5rem; text-align: center;">Points</th>
                            <th style="padding: 0.8rem 0.5rem; text-align: center;">Discount</th>
                            <th style="padding: 0.8rem 0.5rem; text-align: center;">Visible</th>
                            <th style="padding: 0.8rem 0.5rem; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            @php
                                $discount = 0;
                                if ($product->price > 0 && $product->sale_price > 0) {
                                    $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                                }
                            @endphp
                            <tr style="border-bottom: 1px solid var(--border); font-size: 0.93rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(79,70,229,0.02)'" onmouseout="this.style.background='transparent'">

                                {{-- Product Name + Image --}}
                                <td style="padding: 1rem 0.5rem;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=100' }}"
                                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=100';"
                                             alt="{{ $product->name }}"
                                             style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); flex-shrink: 0;">
                                        <div>
                                            <div style="font-weight: 600; color: var(--text-dark);">{{ $product->name }}</div>
                                            <div style="font-size: 0.78rem; color: #94A3B8; max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->description }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Price & Sale Price --}}
                                <td style="padding: 1rem 0.5rem;">
                                    @if($product->has_discount)
                                        <div style="font-weight: 700; color: var(--primary); font-size: 1rem;">₱{{ number_format($product->sale_price, 2) }}</div>
                                        <div style="text-decoration: line-through; color: #94A3B8; font-size: 0.8rem;">₱{{ number_format($product->price, 2) }}</div>
                                    @else
                                        <div style="font-weight: 700; color: var(--text-dark); font-size: 1rem;">₱{{ number_format($product->price, 2) }}</div>
                                    @endif
                                </td>

                                {{-- Points Earned --}}
                                <td style="padding: 1rem 0.5rem; text-align: center;">
                                    <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(245,158,11,.1);color:#D97706;padding:4px 10px;border-radius:50px;font-size:.8rem;font-weight:700;">
                                        <i class="ph-fill ph-coin"></i> {{ $product->points_earned }}
                                    </span>
                                </td>

                                {{-- Discount Toggle --}}
                                <td style="padding: 1rem 0.5rem; text-align: center;">
                                    <form action="{{ route('products.toggle_discount', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            style="border: none; background: none; cursor: pointer; padding: 0; display: inline-flex; align-items: center; flex-direction: column; gap: 4px;"
                                            title="{{ $product->has_discount ? 'Turn discount off' : 'Turn discount on' }}">
                                            <div style="
                                                width: 38px; height: 20px; border-radius: 50px;
                                                background: {{ $product->has_discount ? 'linear-gradient(135deg, #F43F5E, #E11D48)' : '#CBD5E1' }};
                                                position: relative; transition: background 0.3s; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
                                                <div style="
                                                    width: 14px; height: 14px; border-radius: 50%; background: white;
                                                    position: absolute; top: 3px;
                                                    left: {{ $product->has_discount ? '21px' : '3px' }};
                                                    box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></div>
                                            </div>
                                            @if($product->has_discount && $discount > 0)
                                                <span style="color: var(--accent); font-weight: 700; font-size: 0.75rem;">{{ $discount }}% OFF</span>
                                            @else
                                                <span style="color: #94A3B8; font-size: 0.75rem;">No Disc.</span>
                                            @endif
                                        </button>
                                    </form>
                                </td>

                                {{-- Sale Status (Visibility) Toggle --}}
                                <td style="padding: 1rem 0.5rem; text-align: center;">
                                    <form action="{{ route('products.toggle', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            style="border: none; background: none; cursor: pointer; padding: 0; display: inline-flex; align-items: center; flex-direction: column; gap: 4px;"
                                            title="{{ $product->is_on_sale ? 'Hide from public shop' : 'Show on public shop' }}">
                                            <div style="
                                                width: 38px; height: 20px; border-radius: 50px;
                                                background: {{ $product->is_on_sale ? 'linear-gradient(135deg, #10B981, #059669)' : '#CBD5E1' }};
                                                position: relative; transition: background 0.3s; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
                                                <div style="
                                                    width: 14px; height: 14px; border-radius: 50%; background: white;
                                                    position: absolute; top: 3px;
                                                    left: {{ $product->is_on_sale ? '21px' : '3px' }};
                                                    box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></div>
                                            </div>
                                            <span style="font-size: 0.75rem; font-weight: 700; color: {{ $product->is_on_sale ? '#10B981' : '#94A3B8' }};">
                                                {{ $product->is_on_sale ? 'Visible' : 'Hidden' }}
                                            </span>
                                        </button>
                                    </form>
                                </td>

                                {{-- Actions --}}
                                <td style="padding: 1rem 0.5rem; text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="{{ route('products.edit', $product) }}" class="btn-glow" style="padding: 5px 11px; font-size: 0.78rem; background: rgba(79,70,229,0.08); color: var(--primary); border: none;">
                                            <i class="ph-bold ph-pencil"></i>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-glow" style="padding: 5px 11px; font-size: 0.78rem; background: rgba(244,63,94,0.08); color: var(--accent); border: none;">
                                                <i class="ph-bold ph-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="background: rgba(0,0,0,0.02); border-radius: 16px; padding: 3rem 1.5rem; text-align: center; margin-bottom: 3rem; border: 1px dashed var(--border);">
                <i class="ph-bold ph-tag-slash" style="font-size: 2.5rem; color: #94A3B8; margin-bottom: 1rem; display: block;"></i>
                <h4 style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 4px;">No Products Yet</h4>
                <p style="color: #64748B; font-size: 0.9rem;">Add your first product below.</p>
            </div>
        @endif

        <!-- Add Product Form -->
        <div style="border-top: 1px solid var(--border); padding-top: 2rem;">
            <h4 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                <i class="ph-bold ph-plus-circle"></i>
                <span>Add Product to Shop</span>
            </h4>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                <div class="form-group">
                    <label class="form-label" for="prod_name">Product Name <span style="color: var(--accent);">*</span></label>
                    <input type="text" id="prod_name" name="name" class="form-control" placeholder="e.g. Noise-Cancelling Headphones" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="prod_description">Description</label>
                    <textarea id="prod_description" name="description" class="form-control" style="min-height: 80px;" placeholder="Brief details about the product..."></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label" for="prod_price">Original Price (₱) <span style="color: var(--accent);">*</span></label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748B; font-weight: 700;">₱</span>
                            <input type="number" step="0.01" min="0.01" id="prod_price" name="price" class="form-control" style="padding-left: 2rem;" placeholder="0.00" required oninput="calcAddDiscount()">
                        </div>
                    </div>
                    
                    {{-- Discount Toggle for Add Product inline --}}
                    <div class="form-group" style="display: flex; align-items: flex-end; padding-bottom: 8px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; user-select: none; margin-bottom: 0;">
                            <input type="checkbox" id="add_has_discount" name="has_discount" value="1" onchange="toggleAddDiscount(this.checked)" style="display: none;">
                            <div id="add-toggle-track" style="
                                width: 44px; height: 24px; border-radius: 50px; cursor: pointer; transition: background 0.3s;
                                background: #CBD5E1; position: relative; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
                                <div id="add-toggle-thumb" style="
                                    width: 18px; height: 18px; border-radius: 50%; background: white;
                                    position: absolute; top: 3px; transition: left 0.3s ease; left: 3px;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                </div>
                            </div>
                            <span id="add-toggle-label" style="font-weight: 700; font-size: 0.9rem; color: #94A3B8;">No Discount</span>
                        </label>
                    </div>
                </div>

                <div id="add-sale-group" style="display: none;">
                    <div class="form-group">
                        <label class="form-label" for="prod_sale_price">Sale Price (₱) <span style="color: var(--accent);">*</span></label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--accent); font-weight: 700;">₱</span>
                            <input type="number" step="0.01" min="0.01" id="prod_sale_price" name="sale_price" class="form-control" style="padding-left: 2rem;" placeholder="0.00" oninput="calcAddDiscount()">
                        </div>
                    </div>

                    {{-- Live discount preview --}}
                    <div id="add-discount-preview" style="display: none; margin-top: -0.5rem; margin-bottom: 1.5rem; padding: 10px 14px; border-radius: 10px; background: rgba(244,63,94,0.07); font-size: 0.88rem; color: var(--text-dark);">
                        <i class="ph-bold ph-tag" style="color: var(--accent);"></i>
                        Discount: <strong id="add-discount-pct" style="color: var(--accent);"></strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="prod_image">Product Image URL</label>
                    <input type="url" id="prod_image" name="image" class="form-control" placeholder="e.g. https://images.unsplash.com/photo-..." oninput="previewAddImage(this.value)">
                    <div id="add-img-wrap" style="display: none; margin-top: 12px;">
                        <img id="add-img-preview" src="" onerror="this.parentElement.style.display='none';" alt="Preview" style="width: 100%; max-height: 160px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border);">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="prod_points">
                        <i class="ph-fill ph-coin" style="color:#D97706;margin-right:4px;"></i>
                        Points Earned per Purchase
                    </label>
                    <div style="position:relative;">
                        <input type="number" min="0" id="prod_points" name="points_earned" class="form-control" placeholder="e.g. 50" style="padding-right:4rem;" value="0">
                        <span style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#D97706;font-weight:700;font-size:.85rem;">PTS</span>
                    </div>
                    <p style="font-size:.8rem;color:#94A3B8;margin-top:5px;">Loyalty points the buyer earns on each unit purchased.</p>
                </div>

                <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-glow" style="background: linear-gradient(135deg, var(--secondary), #0891B2);">
                        <i class="ph-bold ph-plus"></i>
                        <span>Add Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewShopImage(url) {
    const wrap = document.getElementById('shop-img-wrap');
    const img = document.getElementById('shop-img-preview');
    if (url) { img.src = url; wrap.style.display = 'block'; img.onerror = () => wrap.style.display = 'none'; }
    else { wrap.style.display = 'none'; }
}
function previewAddImage(url) {
    const wrap = document.getElementById('add-img-wrap');
    const img = document.getElementById('add-img-preview');
    if (url) { img.src = url; wrap.style.display = 'block'; img.onerror = () => wrap.style.display = 'none'; }
    else { wrap.style.display = 'none'; }
}

function toggleAddDiscount(isOn) {
    const saleGroup = document.getElementById('add-sale-group');
    const saleInput = document.getElementById('prod_sale_price');
    const track = document.getElementById('add-toggle-track');
    const thumb = document.getElementById('add-toggle-thumb');
    const label = document.getElementById('add-toggle-label');

    saleGroup.style.display = isOn ? 'block' : 'none';
    saleInput.required = isOn;
    
    track.style.background = isOn ? 'linear-gradient(135deg, #F43F5E, #E11D48)' : '#CBD5E1';
    thumb.style.left = isOn ? '23px' : '3px';
    label.textContent = isOn ? 'Discount On' : 'No Discount';
    label.style.color = isOn ? '#F43F5E' : '#94A3B8';

    if (isOn) calcAddDiscount();
}

function calcAddDiscount() {
    const isOn = document.getElementById('add_has_discount').checked;
    if (!isOn) return;
    
    const orig = parseFloat(document.getElementById('prod_price').value) || 0;
    const sale = parseFloat(document.getElementById('prod_sale_price').value) || 0;
    const preview = document.getElementById('add-discount-preview');
    const pctEl = document.getElementById('add-discount-pct');
    if (orig > 0 && sale > 0 && sale < orig) {
        const pct = Math.round(((orig - sale) / orig) * 100);
        pctEl.textContent = pct + '% OFF';
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endsection
