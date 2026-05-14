@extends('layouts.premium')

@section('title', 'Manage Shops')

@section('actions')
    <a href="{{ route('shops.create') }}" class="btn-glow">
        <i class="ph-bold ph-plus"></i>
        <span>Add New Shop</span>
    </a>
@endsection

@section('content')
<div class="glass-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Shop Name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shops as $shop)
                <tr>
                    <td style="color: var(--text-muted);">#{{ str_pad($shop->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td style="font-weight: 500;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(129, 140, 248, 0.2)); display: flex; align-items: center; justify-content: center;">
                                <i class="ph-fill ph-storefront" style="color: var(--primary); font-size: 1.2rem;"></i>
                            </div>
                            {{ $shop->name }}
                        </div>
                    </td>
                    <td><span class="badge" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">{{ $shop->category ?? 'General' }}</span></td>
                    <td>{{ $shop->location ?? 'N/A' }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('shops.edit', $shop) }}" class="btn-icon" title="Edit">
                                <i class="ph ph-pencil-simple"></i>
                            </a>
                            <form action="{{ route('shops.destroy', $shop) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this shop?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Delete">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="ph ph-storefront" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>No shops found. Add your first shop to get started.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
