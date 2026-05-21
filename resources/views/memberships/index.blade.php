@extends('layouts.premium')

@section('title', 'Member Directory')

@section('actions')
<a href="{{ route('memberships.create') }}" class="btn-glow">
    <i class="ph ph-plus"></i> <span>Add Membership</span>
</a>
@endsection

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
                    <th>Expiry Date</th>
                    <th>Status</th>
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
                        @if($membership->expires_at)
                            <div style="font-weight: 500;">{{ $membership->expires_at->format('M d, Y') }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                @if($membership->isExpired())
                                    Expired {{ $membership->expires_at->diffForHumans() }}
                                @else
                                    Expires {{ $membership->expires_at->diffForHumans() }}
                                @endif
                            </div>
                        @else
                            <span style="color: var(--text-muted);">Never Expires</span>
                        @endif
                    </td>
                    <td>
                        @if($membership->status === 'pending')
                            <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.3);">Pending Application ({{ strtoupper($membership->payment_method) }})</span>
                        @elseif($membership->status === 'rejected')
                            <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.3);">Rejected</span>
                        @elseif($membership->isExpired())
                            <span class="badge" style="background: rgba(244, 63, 94, 0.1); color: #F43F5E; border: 1px solid rgba(244, 63, 94, 0.3);">Expired</span>
                        @else
                            <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3);">Active</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            @if($membership->status === 'pending')
                                <form action="{{ route('memberships.approve', $membership) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-icon" style="color: #10B981; background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3);" title="Approve & Activate">
                                        <i class="ph ph-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('memberships.reject', $membership) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-icon delete" title="Reject Application">
                                        <i class="ph ph-x"></i>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('memberships.edit', $membership) }}" class="btn-icon" title="Edit / Renew">
                                <i class="ph ph-pencil-simple"></i>
                            </a>
                            <form action="{{ route('memberships.destroy', $membership) }}" method="POST" onsubmit="return confirm('Delete this membership?');" style="display:inline;">
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
                    <td colspan="8" style="text-align: center; padding: 3rem; color: var(--text-muted);">
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
