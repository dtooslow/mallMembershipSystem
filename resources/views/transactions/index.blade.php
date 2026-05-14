@extends('layouts.premium')

@section('title', 'Recent Transactions')

@section('actions')
    <a href="{{ route('transactions.create') }}" class="btn-glow">
        <i class="ph-bold ph-plus"></i>
        <span>Record Transaction</span>
    </a>
@endsection

@section('content')
<div class="glass-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Customer</th>
                    <th>Shop</th>
                    <th>Amount Spent</th>
                    <th>Points Earned</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td style="color: var(--text-muted);">#TX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="font-weight: 500;">{{ $trx->user->name ?? 'Unknown User' }}</td>
                    <td>{{ $trx->shop->name ?? 'Unknown Shop' }}</td>
                    <td style="font-family: monospace; font-size: 1.1rem; color: var(--text-main);">
                        ${{ number_format($trx->amount, 2) }}
                    </td>
                    <td>
                        <span style="color: #34D399; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                            <i class="ph-fill ph-arrow-up-right"></i>
                            +{{ $trx->points_earned }} pts
                        </span>
                    </td>
                    <td style="color: var(--text-muted); font-size: 0.9rem;">
                        {{ $trx->created_at->format('M d, Y h:i A') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="ph ph-receipt" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>No transactions recorded yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
