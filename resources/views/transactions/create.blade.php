@extends('layouts.premium')

@section('title', 'Record Transaction')

@section('actions')
    <a href="{{ route('transactions.index') }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Transactions</span>
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

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="user_id">Customer <span style="color: var(--accent);">*</span></label>
            <select name="user_id" id="user_id" class="form-control" style="background: #111827; color: white;" required>
                <option value="" disabled selected>-- Select Customer --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="shop_id">Shop <span style="color: var(--accent);">*</span></label>
            <select name="shop_id" id="shop_id" class="form-control" style="background: #111827; color: white;" required>
                <option value="" disabled selected>-- Select Shop --</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
                        {{ $shop->name }} ({{ $shop->location ?? 'Level 1' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="amount">Amount Spent ($) <span style="color: var(--accent);">*</span></label>
            <input type="number" step="0.01" min="0.01" id="amount" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="e.g. 99.50" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="points_earned">Points Earned <span style="color: var(--accent);">*</span></label>
            <input type="number" min="0" id="points_earned" name="points_earned" class="form-control" value="{{ old('points_earned', 0) }}" placeholder="e.g. 10" required>
            <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 4px;">
                Calculated automatically as 1 point per $1 spent, but editable.
            </span>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-glow">
                <i class="ph-bold ph-check"></i>
                <span>Save Transaction</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amount');
        const pointsInput = document.getElementById('points_earned');

        amountInput.addEventListener('input', function() {
            const amount = parseFloat(amountInput.value) || 0;
            // 1 point per $1 spent (rounded down)
            const points = Math.floor(amount);
            pointsInput.value = points;
        });
    });
</script>
@endsection
