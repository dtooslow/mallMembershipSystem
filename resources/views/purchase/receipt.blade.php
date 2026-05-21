<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Receipt | NCCC Mall</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F0FDF4;
            --dark: #0F172A;
            --primary: #4F46E5;
            --secondary: #06B6D4;
            --success: #10B981;
            --border: rgba(0,0,0,0.07);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: var(--bg); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }

        .receipt-wrapper {
            width: 100%;
            max-width: 520px;
        }

        /* Confetti animation container */
        .confetti-wrap {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--success), #059669);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            box-shadow: 0 20px 50px rgba(16,185,129,.35);
            animation: popIn .5s cubic-bezier(.34,1.56,.64,1);
        }
        @keyframes popIn { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }

        .receipt-card {
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0,0,0,.1);
            border: 1px solid var(--border);
        }

        /* Green header */
        .receipt-header {
            background: linear-gradient(135deg, var(--success), #059669);
            padding: 2rem 2.5rem 1.5rem;
            color: white;
            text-align: center;
        }
        .receipt-header h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: .25rem; }
        .receipt-header p { opacity: .85; font-size: .95rem; }

        /* Product summary */
        .receipt-product {
            display: flex;
            gap: 1rem;
            padding: 1.5rem 2rem;
            align-items: center;
            border-bottom: 1px dashed #E2E8F0;
        }
        .receipt-product img {
            width: 70px; height: 70px;
            border-radius: 16px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }
        .receipt-product h4 { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
        .receipt-product .shop-tag { font-size: .82rem; color: #64748B; display: flex; align-items: center; gap: 4px; }

        /* Line items */
        .receipt-lines { padding: 1.2rem 2rem; border-bottom: 1px dashed #E2E8F0; }
        .line { display: flex; justify-content: space-between; padding: .55rem 0; font-size: .92rem; }
        .line .label { color: #64748B; }
        .line .value { font-weight: 600; }
        .line.total { border-top: 2px solid #E2E8F0; margin-top: .5rem; padding-top: .8rem; }
        .line.total .label { font-weight: 700; font-size: 1rem; color: var(--dark); }
        .line.total .value { font-size: 1.3rem; font-weight: 800; color: var(--primary); }

        /* Points earned spotlight */
        .points-spotlight {
            margin: 1.2rem 2rem;
            background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
            border: 1px solid rgba(16,185,129,.25);
            border-radius: 20px;
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .points-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--success), #059669);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: white;
            flex-shrink: 0;
        }
        .points-text h4 { font-size: 1.1rem; font-weight: 800; color: #065F46; }
        .points-text p { font-size: .85rem; color: #047857; margin-top: 2px; }

        /* New total after purchase */
        .new-total-badge {
            margin: 0 2rem 1.2rem;
            background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
            border: 1px solid rgba(79,70,229,.2);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .new-total-badge .nbadge-label { font-size: .88rem; color: #4338CA; font-weight: 600; }
        .new-total-badge .nbadge-val { font-size: 1.2rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 6px; }

        /* Tx ID */
        .tx-id {
            margin: 0 2rem 1.2rem;
            padding: .8rem 1.2rem;
            background: #F8FAFC;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .82rem;
            color: #94A3B8;
        }
        .tx-id span { font-weight: 700; color: #64748B; }

        /* Actions */
        .receipt-actions {
            padding: 1.5rem 2rem 2rem;
            display: flex;
            gap: .8rem;
            flex-wrap: wrap;
        }
        .btn-shop-more {
            flex: 1;
            min-width: 160px;
            padding: 13px 20px;
            border-radius: 14px;
            border: 2px solid rgba(79,70,229,.2);
            background: white;
            color: var(--primary);
            font-weight: 700;
            font-size: .95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .3s;
        }
        .btn-shop-more:hover { background: #EEF2FF; border-color: var(--primary); }
        .btn-home {
            flex: 1;
            min-width: 160px;
            padding: 13px 20px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, var(--primary), #7C3AED);
            color: white;
            font-weight: 700;
            font-size: .95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 20px rgba(79,70,229,.3);
            transition: all .3s;
        }
        .btn-home:hover { box-shadow: 0 14px 28px rgba(79,70,229,.4); transform: translateY(-1px); }

        /* Dashed separator */
        .dashes {
            height: 0;
            border-top: 2px dashed #E2E8F0;
            margin: 0 2rem;
        }
    </style>
</head>
<body>
    <div class="receipt-wrapper">
        <!-- Animated success icon -->
        <div class="confetti-wrap">
            <div class="success-icon">
                <i class="ph-bold ph-check"></i>
            </div>
            <h1 style="margin-top:1rem;font-size:1.6rem;font-weight:800;color:#065F46;">Purchase Successful!</h1>
            <p style="color:#047857;margin-top:.3rem;">Your order has been confirmed.</p>
        </div>

        <div class="receipt-card">
            <!-- Header -->
            <div class="receipt-header">
                <h2>🧾 Order Receipt</h2>
                <p>{{ now()->format('F j, Y \a\t g:i A') }}</p>
            </div>

            <!-- Product -->
            <div class="receipt-product">
                <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=200' }}"
                     onerror="this.src='https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=200'"
                     alt="{{ $product->name }}">
                <div>
                    <h4>{{ $product->name }}</h4>
                    <div class="shop-tag">
                        <i class="ph-bold ph-storefront"></i>
                        {{ $product->shop->name ?? 'NCCC Mall' }}
                    </div>
                </div>
            </div>

            <!-- Line items -->
            <div class="receipt-lines">
                <div class="line">
                    <span class="label">Unit Price</span>
                    <span class="value">₱{{ number_format($product->effectivePrice(), 2) }}</span>
                </div>
                <div class="line">
                    <span class="label">Quantity</span>
                    <span class="value">× {{ $quantity }}</span>
                </div>
                @if($product->has_discount)
                    <div class="line">
                        <span class="label">Discount Applied</span>
                        <span class="value" style="color:#10B981;">
                            −₱{{ number_format(($product->price - $product->sale_price) * $quantity, 2) }}
                        </span>
                    </div>
                @endif
                <div class="line total">
                    <span class="label">Total Paid</span>
                    <span class="value">₱{{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Points earned -->
            <div class="points-spotlight">
                <div class="points-icon"><i class="ph-fill ph-coin"></i></div>
                <div class="points-text">
                    <h4>+{{ number_format($points) }} Points Earned!</h4>
                    <p>Added to your NCCC Mall membership account</p>
                </div>
            </div>

            <!-- New total points -->
            @if($membership)
                <div class="new-total-badge">
                    <span class="nbadge-label">Your New Points Balance</span>
                    <span class="nbadge-val">
                        <i class="ph-fill ph-coin"></i>
                        {{ number_format($membership->fresh()->points) }} pts
                    </span>
                </div>
            @endif

            <!-- Transaction ID -->
            @if($transaction)
                <div class="tx-id">
                    Transaction ID <span>#TXN-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
            @endif

            <!-- Actions -->
            <div class="receipt-actions">
                <a href="{{ route('shops.public.show', $product->shop_id) }}" class="btn-shop-more">
                    <i class="ph-bold ph-arrow-left"></i> Continue Shopping
                </a>
                <a href="/" class="btn-home">
                    <i class="ph-bold ph-house"></i> Go to Mall
                </a>
            </div>
        </div>
    </div>

    <script>
        // Subtle confetti effect
        (function() {
            const colors = ['#4F46E5','#10B981','#F43F5E','#F59E0B','#06B6D4'];
            for (let i = 0; i < 60; i++) {
                const el = document.createElement('div');
                const size = Math.random() * 10 + 6;
                el.style.cssText = `
                    position: fixed;
                    width: ${size}px; height: ${size}px;
                    background: ${colors[Math.floor(Math.random() * colors.length)]};
                    border-radius: ${Math.random() > .5 ? '50%' : '3px'};
                    left: ${Math.random() * 100}vw;
                    top: -20px;
                    opacity: ${Math.random() * .8 + .2};
                    pointer-events: none;
                    z-index: 9999;
                    animation: fall ${Math.random() * 3 + 2}s linear ${Math.random() * 2}s forwards;
                `;
                document.body.appendChild(el);
            }
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fall {
                    to { top: 110vh; transform: rotate(${Math.random() > .5 ? '' : '-'}${Math.floor(Math.random()*360)}deg) translateX(${(Math.random()-.5)*200}px); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        })();
    </script>
</body>
</html>
