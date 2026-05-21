<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shop->name }} | NCCC Mall</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --bg: #F8FAFC;
            --dark: #0F172A;
            --primary: #4F46E5;
            --secondary: #06B6D4;
            --accent: #F43F5E;
            --success: #10B981;
            --border: rgba(0,0,0,0.07);
        }
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Outfit',sans-serif;}
        body{background:var(--bg);color:var(--dark);overflow-x:hidden;padding-top:76px;}

        /* ── Navbar ── */
        .navbar{display:flex;justify-content:space-between;align-items:center;padding:1.2rem 5%;background:rgba(255,255,255,0.92);backdrop-filter:blur(16px);position:fixed;width:100%;top:0;z-index:999;box-shadow:0 2px 20px rgba(0,0,0,0.04);border-bottom:1px solid var(--border);}
        .brand{font-size:1.6rem;font-weight:800;background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:flex;align-items:center;gap:8px;text-decoration:none;}
        .nav-actions{display:flex;align-items:center;gap:1rem;}
        .btn-back{display:inline-flex;align-items:center;gap:8px;text-decoration:none;color:var(--dark);font-weight:600;padding:9px 20px;border-radius:50px;border:2px solid var(--border);background:white;transition:all .3s;font-size:0.92rem;}
        .btn-back:hover{border-color:var(--primary);color:var(--primary);}
        .points-badge{display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#FFF7ED,#FEF3C7);border:1px solid rgba(245,158,11,0.3);color:#D97706;padding:8px 16px;border-radius:50px;font-weight:700;font-size:0.9rem;}

        /* ── Hero ── */
        .hero{margin:1.5rem 5% 0;height:340px;border-radius:36px;background:url('{{ $shop->image }}') center/cover no-repeat;overflow:hidden;box-shadow:0 20px 50px rgba(0,0,0,0.1);display:flex;align-items:flex-end;position:relative;}
        .hero::before{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(15,23,42,.85) 0%,rgba(15,23,42,.2) 55%,transparent 100%);}
        .hero-content{position:relative;z-index:2;padding:2.5rem 3rem;width:100%;display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;}
        .hero h1{font-size:2.8rem;font-weight:800;color:white;text-shadow:0 4px 12px rgba(0,0,0,.3);}
        .hero-tags{display:flex;gap:8px;margin-top:.5rem;flex-wrap:wrap;}
        .hero-tag{background:rgba(255,255,255,.18);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.12);color:white;padding:7px 15px;border-radius:50px;font-size:.85rem;font-weight:600;display:flex;align-items:center;gap:6px;}
        .sale-tag{background:var(--accent);border:none;box-shadow:0 8px 20px rgba(244,63,94,.35);}

        /* ── Section ── */
        .showcase{padding:2.5rem 5% 5rem;}
        .sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;}
        .sec-title{font-size:2rem;font-weight:800;}
        .sec-title span{color:var(--accent);}
        .product-count{background:white;border:1px solid var(--border);color:#64748B;padding:6px 14px;border-radius:50px;font-size:.85rem;font-weight:600;}

        /* ── Product Grid ── */
        .product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:2rem;}

        /* ── Product Card ── */
        .product-card{background:white;border-radius:28px;overflow:hidden;border:1px solid var(--border);box-shadow:0 8px 30px rgba(0,0,0,.04);transition:all .4s cubic-bezier(.23,1,.32,1);display:flex;flex-direction:column;position:relative;}
        .product-card:hover{transform:translateY(-10px);box-shadow:0 24px 50px rgba(79,70,229,.13);border-color:rgba(79,70,229,.18);}
        .product-img-wrap{height:220px;overflow:hidden;background:#F1F5F9;position:relative;}
        .product-img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;}
        .product-card:hover .product-img{transform:scale(1.07);}
        .discount-badge{position:absolute;top:16px;left:16px;background:linear-gradient(135deg,var(--accent),#FF6B35);color:white;padding:5px 12px;border-radius:50px;font-weight:800;font-size:.8rem;box-shadow:0 6px 14px rgba(244,63,94,.4);z-index:5;}
        .points-pill{position:absolute;top:16px;right:16px;background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.25);color:#059669;padding:5px 12px;border-radius:50px;font-weight:700;font-size:.78rem;display:flex;align-items:center;gap:4px;z-index:5;}

        .product-body{padding:1.5rem;display:flex;flex-direction:column;flex-grow:1;}
        .product-name{font-size:1.15rem;font-weight:700;margin-bottom:.5rem;line-height:1.35;}
        .product-desc{color:#64748B;font-size:.88rem;line-height:1.6;flex-grow:1;margin-bottom:1.2rem;}

        .price-row{display:flex;align-items:center;justify-content:space-between;padding-top:1rem;border-top:1px solid var(--border);margin-bottom:1rem;}
        .price-block{display:flex;flex-direction:column;}
        .orig-price{text-decoration:line-through;color:#94A3B8;font-size:.82rem;font-weight:500;}
        .eff-price{font-size:1.5rem;font-weight:800;background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
        .in-stock{background:rgba(16,185,129,.1);color:var(--success);padding:5px 12px;border-radius:50px;font-size:.8rem;font-weight:700;display:flex;align-items:center;gap:4px;}

        /* Buy Button */
        .btn-buy{width:100%;padding:13px;border-radius:16px;border:none;background:linear-gradient(135deg,var(--primary),#7C3AED);color:white;font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .3s;letter-spacing:.01em;box-shadow:0 8px 20px rgba(79,70,229,.25);}
        .btn-buy:hover{transform:translateY(-2px);box-shadow:0 14px 28px rgba(79,70,229,.35);}
        .btn-buy:active{transform:translateY(0);}
        .btn-buy-guest{background:linear-gradient(135deg,#64748B,#475569);}
        .btn-buy-guest:hover{box-shadow:0 14px 28px rgba(100,116,139,.25);}

        /* ── Modal Overlay ── */
        .modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,.6);backdrop-filter:blur(8px);z-index:1000;display:none;align-items:center;justify-content:center;padding:1rem;}
        .modal-overlay.open{display:flex;}
        .modal{background:white;border-radius:32px;width:100%;max-width:500px;overflow:hidden;box-shadow:0 40px 80px rgba(0,0,0,.18);animation:modalIn .35s cubic-bezier(.34,1.56,.64,1);}
        @keyframes modalIn{from{opacity:0;transform:scale(.88) translateY(20px);}to{opacity:1;transform:scale(1) translateY(0);}}

        .modal-header{padding:2rem 2rem 1.5rem;background:linear-gradient(135deg,var(--primary),#7C3AED);color:white;}
        .modal-header h3{font-size:1.4rem;font-weight:800;margin-bottom:.25rem;}
        .modal-header p{opacity:.8;font-size:.9rem;}

        .modal-product{display:flex;gap:1rem;padding:1.5rem 2rem;border-bottom:1px solid var(--border);align-items:center;}
        .modal-product img{width:80px;height:80px;border-radius:16px;object-fit:cover;border:1px solid var(--border);}
        .modal-product-info h4{font-size:1rem;font-weight:700;margin-bottom:4px;}
        .modal-product-info .shop-name{font-size:.82rem;color:#64748B;}

        .modal-body{padding:1.5rem 2rem;}
        .modal-row{display:flex;justify-content:space-between;align-items:center;padding:.7rem 0;border-bottom:1px solid var(--border);}
        .modal-row:last-child{border-bottom:none;}
        .modal-row label{font-size:.9rem;color:#64748B;font-weight:500;}
        .modal-row .val{font-weight:700;font-size:.95rem;}
        .modal-row .val.green{color:var(--success);}
        .modal-row .val.big{font-size:1.3rem;color:var(--primary);}

        .qty-control{display:flex;align-items:center;gap:10px;}
        .qty-btn{width:32px;height:32px;border-radius:50%;border:2px solid var(--border);background:white;cursor:pointer;font-size:1rem;font-weight:700;display:flex;align-items:center;justify-content:center;transition:all .2s;}
        .qty-btn:hover{border-color:var(--primary);color:var(--primary);}
        .qty-display{font-size:1.1rem;font-weight:700;min-width:24px;text-align:center;}

        .modal-footer{padding:1.5rem 2rem 2rem;display:flex;gap:.8rem;}
        .btn-cancel{flex:1;padding:13px;border-radius:14px;border:2px solid var(--border);background:white;font-weight:700;font-size:.95rem;cursor:pointer;color:var(--dark);transition:all .2s;}
        .btn-cancel:hover{border-color:#94A3B8;}
        .btn-confirm{flex:2;padding:13px;border-radius:14px;border:none;background:linear-gradient(135deg,var(--primary),#7C3AED);color:white;font-weight:700;font-size:.95rem;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .3s;box-shadow:0 8px 20px rgba(79,70,229,.3);}
        .btn-confirm:hover{box-shadow:0 14px 28px rgba(79,70,229,.4);transform:translateY(-1px);}

        /* Guest CTA */
        .guest-modal-body{padding:2rem;text-align:center;}
        .guest-icon{width:80px;height:80px;background:linear-gradient(135deg,#EEF2FF,#E0E7FF);border-radius:24px;margin:0 auto 1.5rem;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--primary);}
        .guest-modal-body h3{font-size:1.4rem;font-weight:800;margin-bottom:.5rem;}
        .guest-modal-body p{color:#64748B;margin-bottom:1.5rem;line-height:1.6;}
        .btn-login{display:block;padding:13px 24px;background:linear-gradient(135deg,var(--primary),#7C3AED);color:white;font-weight:700;font-size:1rem;border-radius:14px;text-decoration:none;margin-bottom:.8rem;box-shadow:0 8px 20px rgba(79,70,229,.3);}
        .btn-register{display:block;padding:12px 24px;background:white;color:var(--primary);font-weight:700;font-size:1rem;border-radius:14px;text-decoration:none;border:2px solid rgba(79,70,229,.2);}

        /* Empty state */
        .empty{text-align:center;padding:5rem 2rem;background:white;border-radius:32px;border:2px dashed var(--border);max-width:480px;margin:4rem auto;}
        .empty i{font-size:3.5rem;color:#94A3B8;margin-bottom:1.5rem;}
        .empty h3{font-size:1.6rem;font-weight:700;margin-bottom:.5rem;}
        .empty p{color:#64748B;}

        /* flash */
        .flash{position:fixed;bottom:2rem;right:2rem;z-index:2000;padding:1rem 1.5rem;border-radius:16px;font-weight:600;display:flex;align-items:center;gap:10px;box-shadow:0 10px 30px rgba(0,0,0,.15);animation:slideUp .4s ease;max-width:360px;}
        .flash.success{background:#ECFDF5;border:1px solid rgba(16,185,129,.3);color:#065F46;}
        .flash.error{background:#FFF1F2;border:1px solid rgba(244,63,94,.3);color:#9F1239;}
        @keyframes slideUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="brand">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </a>
        <div class="nav-actions">
            @auth
                @php $membership = auth()->user()->membership; @endphp
                @if($membership && $membership->status === 'active')
                    <div class="points-badge">
                        <i class="ph-fill ph-coin"></i>
                        {{ number_format($membership->points) }} pts
                    </div>
                @endif
            @endauth
            <a href="/#shops" class="btn-back">
                <i class="ph-bold ph-arrow-left"></i> Back to Mall
            </a>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <div class="hero-content">
            <div>
                <h1>{{ $shop->name }}</h1>
                <div class="hero-tags">
                    <div class="hero-tag"><i class="ph-bold ph-tag"></i>{{ $shop->category ?? 'General' }}</div>
                    <div class="hero-tag"><i class="ph-bold ph-map-pin"></i>{{ $shop->location ?? 'Level 1' }}</div>
                    <div class="hero-tag sale-tag"><i class="ph-bold ph-sparkle"></i>{{ $products->count() }} Items Available</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash messages -->
    @if(session('success'))
        <div class="flash success" id="flash-msg">
            <i class="ph-bold ph-check-circle" style="font-size:1.25rem;"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash error" id="flash-msg">
            <i class="ph-bold ph-warning-circle" style="font-size:1.25rem;"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Products -->
    <div class="showcase">
        <div class="sec-header">
            <h2 class="sec-title">Products <span>& Offers</span></h2>
            <span class="product-count">{{ $products->count() }} product{{ $products->count() !== 1 ? 's' : '' }}</span>
        </div>

        @if($products->count() > 0)
            <div class="product-grid">
                @foreach($products as $product)
                    @php
                        $discountPct = 0;
                        if ($product->price > 0 && $product->has_discount) {
                            $discountPct = round((($product->price - $product->sale_price) / $product->price) * 100);
                        }
                        $effPrice = $product->effectivePrice();
                    @endphp
                    <div class="product-card">
                        <div class="product-img-wrap">
                            @if($product->has_discount && $discountPct > 0)
                                <div class="discount-badge">{{ $discountPct }}% OFF</div>
                            @endif
                            <div class="points-pill">
                                <i class="ph-fill ph-coin"></i> +{{ $product->points_earned }} pts
                            </div>
                            <img class="product-img"
                                 src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=600' }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=600'"
                                 alt="{{ $product->name }}">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-desc">{{ $product->description ?? 'Special offer available at NCCC Mall.' }}</p>

                            <div class="price-row">
                                <div class="price-block">
                                    @if($product->has_discount && $discountPct > 0)
                                        <span class="orig-price">₱{{ number_format($product->price, 2) }}</span>
                                    @endif
                                    <span class="eff-price">₱{{ number_format($effPrice, 2) }}</span>
                                </div>
                                <span class="in-stock"><i class="ph-bold ph-check"></i> In Stock</span>
                            </div>

                            @auth
                                <button class="btn-buy" onclick="openBuyModal({{ $product->id }})">
                                    <i class="ph-bold ph-shopping-bag"></i> Buy Now
                                </button>
                            @else
                                <button class="btn-buy btn-buy-guest" onclick="openGuestModal()">
                                    <i class="ph-bold ph-lock-simple"></i> Login to Buy
                                </button>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <i class="ph-bold ph-tag-slash"></i>
                <h3>No Items Available</h3>
                <p>Check back soon for offers at {{ $shop->name }}!</p>
            </div>
        @endif
    </div>

    <!-- ── Buy Modal (Authenticated) ── -->
    @auth
    <div class="modal-overlay" id="buy-modal">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="ph-bold ph-shopping-bag"></i> Confirm Purchase</h3>
                <p>Review your order before completing</p>
            </div>

            <div class="modal-product">
                <img id="modal-img" src="" alt="">
                <div class="modal-product-info">
                    <h4 id="modal-name"></h4>
                    <div class="shop-name"><i class="ph-bold ph-storefront" style="margin-right:4px;"></i>{{ $shop->name }}</div>
                </div>
            </div>

            <div class="modal-body">
                <div class="modal-row">
                    <label>Quantity</label>
                    <div class="qty-control">
                        <button class="qty-btn" onclick="changeQty(-1)">−</button>
                        <span class="qty-display" id="modal-qty">1</span>
                        <button class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>
                <div class="modal-row">
                    <label>Unit Price</label>
                    <span class="val" id="modal-unit-price"></span>
                </div>
                <div class="modal-row">
                    <label>Subtotal</label>
                    <span class="val big" id="modal-total"></span>
                </div>
                <div class="modal-row">
                    <label><i class="ph-fill ph-coin" style="color:#D97706;margin-right:4px;"></i>Points Earned</label>
                    <span class="val green" id="modal-points"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeBuyModal()">Cancel</button>
                <form id="buy-form" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" id="form-qty" value="1">
                    <button type="submit" class="btn-confirm">
                        <i class="ph-bold ph-check-circle"></i> Confirm & Pay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Product data for JS -->
    <script>
    const PRODUCTS = {
        @foreach($products as $p)
        {{ $p->id }}: {
            name: @json($p->name),
            image: @json($p->image ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=600'),
            price: {{ $p->effectivePrice() }},
            points: {{ $p->points_earned }},
            buyUrl: "{{ route('purchase.buy', $p) }}"
        },
        @endforeach
    };

    let currentProduct = null;
    let qty = 1;

    function openBuyModal(productId) {
        currentProduct = PRODUCTS[productId];
        qty = 1;
        updateModal();
        document.getElementById('buy-modal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeBuyModal() {
        document.getElementById('buy-modal').classList.remove('open');
        document.body.style.overflow = '';
    }

    function changeQty(delta) {
        qty = Math.max(1, Math.min(20, qty + delta));
        updateModal();
    }

    function updateModal() {
        if (!currentProduct) return;
        document.getElementById('modal-img').src = currentProduct.image;
        document.getElementById('modal-name').textContent = currentProduct.name;
        document.getElementById('modal-qty').textContent = qty;
        document.getElementById('form-qty').value = qty;
        document.getElementById('modal-unit-price').textContent = '₱' + currentProduct.price.toLocaleString('en-PH', {minimumFractionDigits:2});
        document.getElementById('modal-total').textContent = '₱' + (currentProduct.price * qty).toLocaleString('en-PH', {minimumFractionDigits:2});
        document.getElementById('modal-points').textContent = '+' + (currentProduct.points * qty).toLocaleString() + ' pts';
        document.getElementById('buy-form').action = currentProduct.buyUrl;
    }

    // Close on overlay click
    document.getElementById('buy-modal').addEventListener('click', function(e) {
        if (e.target === this) closeBuyModal();
    });
    </script>
    @endauth

    <!-- ── Guest Modal ── -->
    <div class="modal-overlay" id="guest-modal">
        <div class="modal" style="max-width:420px;">
            <div class="guest-modal-body">
                <div class="guest-icon"><i class="ph-fill ph-user-circle"></i></div>
                <h3>Login to Shop</h3>
                <p>Create an account or log in to purchase products and earn loyalty points at NCCC Mall.</p>
                <a href="{{ route('login') }}" class="btn-login"><i class="ph-bold ph-sign-in"></i> Login to Account</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-register"><i class="ph-bold ph-user-plus"></i> Create Free Account</a>
                @endif
                <button onclick="closeGuestModal()" style="margin-top:1rem;background:none;border:none;color:#64748B;cursor:pointer;font-size:.9rem;font-weight:500;">Maybe later</button>
            </div>
        </div>
    </div>

    <script>
    function openGuestModal() {
        document.getElementById('guest-modal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeGuestModal() {
        document.getElementById('guest-modal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('guest-modal').addEventListener('click', function(e) {
        if (e.target === this) closeGuestModal();
    });

    // Auto-hide flash
    const flash = document.getElementById('flash-msg');
    if (flash) setTimeout(() => { flash.style.opacity = '0'; flash.style.transform = 'translateY(20px)'; flash.style.transition = 'all .4s'; setTimeout(() => flash.remove(), 400); }, 4000);
    </script>
</body>
</html>
