@extends('layouts.premium')

@section('title', 'Manage Rewards Catalog')

@section('actions')
    <a href="{{ route('rewards.create') }}" class="btn-glow">
        <i class="ph-bold ph-plus"></i>
        <span>Add New Reward</span>
    </a>
@endsection

@section('content')
<div class="glass-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reward Details</th>
                    <th>Points Required</th>
                    <th>Available Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rewards as $reward)
                <tr>
                    <td style="color: var(--text-muted);">#RW-{{ str_pad($reward->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td style="font-weight: 500; max-width: 300px;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, rgba(244, 63, 94, 0.2), rgba(129, 140, 248, 0.2)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                                <i class="ph-fill ph-gift" style="color: var(--accent); font-size: 1.2rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #fff;">{{ $reward->name }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px; line-height: 1.4;">
                                    {{ Str::limit($reward->description ?? 'No description provided.', 80) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight: 700; color: #F59E0B; font-size: 1.1rem;">
                        <i class="ph-fill ph-coin"></i> {{ number_format($reward->points_required) }}
                    </td>
                    <td>
                        @if($reward->stock <= 0)
                            <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                                Out of Stock
                            </span>
                        @elseif($reward->stock < 10)
                            <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.3);">
                                Low Stock ({{ $reward->stock }})
                            </span>
                        @else
                            <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                {{ $reward->stock }} Available
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('rewards.edit', $reward) }}" class="btn-icon" title="Edit">
                                <i class="ph ph-pencil-simple"></i>
                            </a>
                            <form action="{{ route('rewards.destroy', $reward) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reward?');" style="display:inline;">
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
                        <i class="ph ph-gift" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>No rewards found in catalog. Create your first reward.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
