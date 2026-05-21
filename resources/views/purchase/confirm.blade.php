<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase | NCCC Mall</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F8FAFC;
            --dark: #0F172A;
            --primary: #4F46E5;
            --secondary: #06B6D4;
            --border: rgba(0,0,0,0.07);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: var(--bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; }

        .card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 40px rgba(0,0,0,.08);
            border: 1px solid var(--border);
        }

        .header { text-align: center; margin-bottom: 2rem; }
        .header h2 { font-size: 1.6rem; font-weight: 800; color: var(--dark); }
        .header p { color: #64748B; font-size: .95rem; margin-top: .3rem; }

        .product-info {
            display: flex; gap: 1rem; align-items: center;
            padding: 1rem; border: 1px solid var(--border); border-radius: 16px; margin-bottom: 1.5rem;
            background: #F8FAFC;
        }
        .product-info img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; }
        .product-info h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 4px; }
        .product-info p { font-size: .85rem; color: #64748B; }

        .details { margin-bottom: 2rem; }
        .row { display: flex; justify-content: space-between; padding: .8rem 0; border-bottom: 1px dashed var(--border); }
        .row:last-child { border-bottom: none; }
        .row .label { color: #64748B; font-weight: 500; }
        .row .val { font-weight: 700; font-size: 1.05rem; }

        .actions { display: flex; gap: 1rem; }
        .btn-cancel, .btn-confirm {
            flex: 1; padding: 14px; border-radius: 14px; font-weight: 700; font-size: 1rem; text-align: center; cursor: pointer; text-decoration: none;
        }
        .btn-cancel { background: white; border: 2px solid var(--border); color: var(--dark); }
        .btn-confirm { background: linear-gradient(135deg, var(--primary), #7C3AED); color: white; border: none; box-shadow: 0 8px 20px rgba(79,70,229,.3); }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h2>Confirm Purchase</h2>
            <p>Review your item before purchasing.</p>
        </div>

        <div class="product-info">
            <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=200' }}" alt="{{ $product->name }}">
            <div>
                <h3>{{ $product->name }}</h3>
                <p><i class="ph-bold ph-storefront"></i> {{ $product->shop->name }}</p>
            </div>
        </div>

        <form action="{{ route('purchase.buy', $product) }}" method="POST">
            @csrf
            <div class="details">
                <div class="row">
                    <span class="label">Unit Price</span>
                    <span class="val">₱{{ number_format($product->effectivePrice(), 2) }}</span>
                </div>
                <div class="row" style="align-items: center;">
                    <span class="label">Quantity</span>
                    <input type="number" name="quantity" value="1" min="1" max="20" style="width: 80px; padding: 6px; border-radius: 8px; border: 1px solid var(--border); font-weight: 700; text-align: center;">
                </div>
                <div class="row">
                    <span class="label">Points to Earn</span>
                    <span class="val" style="color: #10B981;"><i class="ph-fill ph-coin"></i> +{{ $product->points_earned }} pts</span>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('shops.public.show', $product->shop_id) }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-confirm">Buy Now</button>
            </div>
        </form>
    </div>
</body>
</html>
