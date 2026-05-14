@extends('layouts.premium')

@section('title', 'Member Directory')

@section('content')
<div class="glass-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Tier</th>
                    <th>Available Points</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($memberships as $membership)
                <tr>
                    <td style="color: var(--text-muted);">#MBR-{{ str_pad($membership->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="font-weight: 500;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--bg-card); display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                                <i class="ph-fill ph-user" style="color: var(--primary);"></i>
                            </div>
                            {{ $membership->user->name ?? 'N/A' }}
                        </div>
                    </td>
                    <td style="color: var(--text-muted);">{{ $membership->user->email ?? 'N/A' }}</td>
                    <td>
                        @if(strtolower($membership->tier) == 'gold')
                            <span class="badge badge-gold">Gold Member</span>
                        @elseif(strtolower($membership->tier) == 'silver')
                            <span class="badge badge-silver">Silver Member</span>
                        @else
                            <span class="badge badge-bronze">Bronze Member</span>
                        @endif
                    </td>
                    <td style="font-weight: 700; color: var(--primary); font-size: 1.1rem;">
                        {{ number_format($membership->points) }}
                    </td>
                    <td>
                        <div class="action-btns">
                            <form action="{{ route('memberships.destroy', $membership) }}" method="POST" onsubmit="return confirm('Delete this membership?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Revoke Membership">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="ph ph-users-three" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>No memberships found. Memberships are created automatically upon first transaction.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
