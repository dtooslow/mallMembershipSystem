@extends('layouts.premium')

@section('title', 'Edit Member Profile')

@section('content')
<style>
    .edit-container {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 2rem;
        align-items: start;
    }

    .preview-section {
        position: sticky;
        top: 2rem;
    }

    /* Premium Glow Card */
    .mbr-card {
        width: 100%;
        aspect-ratio: 1.586 / 1; /* Standard credit card ratio */
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), inset 0 0 0 1px rgba(255, 255, 255, 0.15);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .mbr-card:hover {
        transform: translateY(-8px) rotateX(2deg) rotateY(2deg);
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.25);
    }

    /* Tier Card Designs */
    .card-bronze {
        background: radial-gradient(circle at 10% 20%, #7e5a3c 0%, #3e2614 90%);
        border-color: rgba(205, 127, 50, 0.3);
    }
    .card-silver {
        background: radial-gradient(circle at 10% 20%, #9eabb5 0%, #2f363c 90%);
        border-color: rgba(192, 192, 192, 0.3);
    }
    .card-gold {
        background: radial-gradient(circle at 10% 20%, #b89742 0%, #463410 90%);
        border-color: rgba(255, 215, 0, 0.3);
    }

    .card-glow-element {
        position: absolute;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        top: -50px;
        right: -50px;
        pointer-events: none;
    }

    .card-logo {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 1.2rem;
        letter-spacing: 1px;
    }

    .card-logo i {
        font-size: 1.5rem;
    }

    .card-number {
        font-size: 1.4rem;
        font-family: monospace;
        letter-spacing: 2px;
        margin: 1.5rem 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .card-holder {
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 1rem;
    }

    .card-meta strong {
        color: #fff;
        font-size: 0.95rem;
    }

    .btn-action-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-muted);
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 500;
        transition: color 0.3s;
    }

    .btn-action-back:hover {
        color: white;
    }

    .btn-action-back i {
        font-size: 1rem;
    }

    .grid-fields {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    /* Pending Renewal Badge */
    .renewal-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        animation: pulse-renewal 2s infinite;
        display: none;
    }

    @keyframes pulse-renewal {
        0%, 100% { opacity: 0.8; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }
</style>

<a href="{{ route('memberships.index') }}" class="btn-action-back">
    <i class="ph ph-arrow-left"></i> Back to Directory
</a>

<div class="edit-container">
    <!-- Form Section -->
    <div class="glass-card">
        <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">
            Member Information
        </h3>

        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li><i class="ph ph-warning" style="margin-right: 5px;"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('memberships.update', $membership) }}" method="POST" id="edit-member-form">
            @csrf
            @method('PUT')

            <div class="grid-fields">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $membership->user->name ?? '') }}" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $membership->user->email ?? '') }}" required autocomplete="off">
                </div>
            </div>

            <div class="grid-fields">
                <div class="form-group">
                    <label class="form-label" for="tier">Membership Tier</label>
                    <select name="tier" id="tier" class="form-control" style="background: #111827; color: white;">
                        <option value="Bronze" {{ old('tier', $membership->tier) == 'Bronze' ? 'selected' : '' }}>Bronze Tier</option>
                        <option value="Silver" {{ old('tier', $membership->tier) == 'Silver' ? 'selected' : '' }}>Silver Tier</option>
                        <option value="Gold" {{ old('tier', $membership->tier) == 'Gold' ? 'selected' : '' }}>Gold Tier</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="points">Loyalty Points</label>
                    <input type="number" name="points" id="points" class="form-control" value="{{ old('points', $membership->points) }}" required min="0">
                </div>
            </div>

            <div class="grid-fields">
                <div class="form-group">
                    <label class="form-label" for="status">Membership Status</label>
                    <select name="status" id="status" class="form-control" style="background: #111827; color: white;">
                        <option value="pending" {{ old('status', $membership->status) == 'pending' ? 'selected' : '' }}>Pending Application</option>
                        <option value="active" {{ old('status', $membership->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ old('status', $membership->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="rejected" {{ old('status', $membership->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="expires_at">Membership Expiry Date</label>
                    <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ old('expires_at', $membership->expires_at ? $membership->expires_at->format('Y-m-d') : '') }}">
                </div>
            </div>

            @if($membership->payment_method)
            <div class="form-group">
                <label class="form-label">Payment Method Details</label>
                <div class="form-control" style="background: rgba(255,255,255,0.05); color: #94A3B8;">
                    Dummy Transaction Paid via <strong>{{ strtoupper($membership->payment_method) }}</strong> (₱500.00)
                </div>
            </div>
            @endif

            <div class="glass-card" style="margin-top: 2rem; margin-bottom: 2rem; border-color: rgba(56, 189, 248, 0.2); background: rgba(56, 189, 248, 0.03);">
                <div style="display: flex; align-items: flex-start; gap: 15px;">
                    <div style="margin-top: 3px;">
                        <input type="checkbox" name="renew_auto" id="renew_auto" value="1" style="width: 22px; height: 22px; cursor: pointer; accent-color: var(--primary);">
                    </div>
                    <div>
                        <label for="renew_auto" style="font-weight: 600; cursor: pointer; color: var(--primary); display: block; margin-bottom: 4px;">
                            Quick Renew Membership
                        </label>
                        <span style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.4; display: block;">
                            Extend this user's membership by exactly <strong>1 Year</strong> from today (or from their current expiry if it is in the future). This automatically updates their renewal log.
                        </span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-glow" style="width: 100%; justify-content: center; padding: 14px;">
                <i class="ph ph-floppy-disk"></i> <span>Save Member Changes</span>
            </button>
        </form>
    </div>

    <!-- Preview Section -->
    <div class="preview-section">
        <h4 style="font-size: 1.1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">
            Membership Card Preview
        </h4>
        
        <div id="mbr-preview-card" class="mbr-card card-bronze">
            <div class="card-glow-element"></div>
            <div class="renewal-badge" id="renewal-pending-badge">RENEWAL PENDING</div>
            
            <div class="card-logo">
                <i class="ph-fill ph-shopping-cart"></i> NCCC MALL
            </div>

            <div>
                <div class="card-number" id="preview-card-number">
                    #MBR-{{ str_pad($membership->id, 5, '0', STR_PAD_LEFT) }}
                </div>
                <div class="card-holder" id="preview-card-name">
                    {{ $membership->user->name ?? 'MEMBER NAME' }}
                </div>
            </div>

            <div class="card-meta">
                <div>
                    <div>TIER</div>
                    <strong id="preview-card-tier">{{ $membership->tier }}</strong>
                </div>
                <div>
                    <div>AVAILABLE POINTS</div>
                    <strong id="preview-card-points">{{ number_format($membership->points) }} PTS</strong>
                </div>
                <div>
                    <div>EXPIRY</div>
                    <strong id="preview-card-expiry">
                        {{ $membership->expires_at ? $membership->expires_at->format('m / y') : 'N/A' }}
                    </strong>
                </div>
            </div>
        </div>

        <div class="glass-card" style="margin-top: 1.5rem; padding: 1.2rem; font-size: 0.85rem; color: var(--text-muted); border-style: dashed;">
            <h5 style="color: white; margin-bottom: 5px; display: flex; align-items: center; gap: 6px;">
                <i class="ph ph-info" style="color: var(--primary);"></i> Renewal & Expiry Rules
            </h5>
            <ul style="padding-left: 1.2rem; margin: 0; display: flex; flex-direction: column; gap: 4px;">
                <li>Expired members cannot claim rewards from the Catalog.</li>
                <li>Points are preserved upon renewal unless manually cleared.</li>
                <li>Each manual edit or renewal triggers an update to the 'Last Renewed' date.</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const tierSelect = document.getElementById('tier');
        const pointsInput = document.getElementById('points');
        const expiresInput = document.getElementById('expires_at');
        const renewCheckbox = document.getElementById('renew_auto');

        const previewCard = document.getElementById('mbr-preview-card');
        const previewName = document.getElementById('preview-card-name');
        const previewTier = document.getElementById('preview-card-tier');
        const previewPoints = document.getElementById('preview-card-points');
        const previewExpiry = document.getElementById('preview-card-expiry');
        const renewalBadge = document.getElementById('renewal-pending-badge');

        // Update Name Preview
        nameInput.addEventListener('input', function() {
            previewName.textContent = nameInput.value.trim() !== '' ? nameInput.value.toUpperCase() : 'MEMBER NAME';
        });

        // Update Tier Preview
        tierSelect.addEventListener('change', function() {
            const selectedTier = tierSelect.value;
            previewTier.textContent = selectedTier.toUpperCase();
            
            // Remove previous tier classes
            previewCard.classList.remove('card-bronze', 'card-silver', 'card-gold');
            
            // Add current tier class
            if (selectedTier === 'Bronze') {
                previewCard.classList.add('card-bronze');
            } else if (selectedTier === 'Silver') {
                previewCard.classList.add('card-silver');
            } else if (selectedTier === 'Gold') {
                previewCard.classList.add('card-gold');
            }
        });

        // Update Points Preview
        pointsInput.addEventListener('input', function() {
            const val = parseInt(pointsInput.value) || 0;
            previewPoints.textContent = val.toLocaleString() + ' PTS';
        });

        // Update Expiration Preview
        expiresInput.addEventListener('input', function() {
            if (expiresInput.value) {
                const dateParts = expiresInput.value.split('-');
                if (dateParts.length === 3) {
                    const yearShort = dateParts[0].substring(2);
                    const month = dateParts[1];
                    previewExpiry.textContent = month + ' / ' + yearShort;
                }
            } else {
                previewExpiry.textContent = 'N/A';
            }
        });

        // Update Quick Renew preview
        renewCheckbox.addEventListener('change', function() {
            if (renewCheckbox.checked) {
                renewalBadge.style.display = 'block';
                // Estimate the new date
                let baseDate = new Date();
                let existingDate = new Date(expiresInput.value);
                if (existingDate > baseDate) {
                    baseDate = existingDate;
                }
                baseDate.setFullYear(baseDate.getFullYear() + 1);
                
                const month = String(baseDate.getMonth() + 1).padStart(2, '0');
                const yearShort = String(baseDate.getFullYear()).substring(2);
                previewExpiry.textContent = month + ' / ' + yearShort + ' (NEW)';
                previewExpiry.style.color = 'var(--accent)';
            } else {
                renewalBadge.style.display = 'none';
                previewExpiry.style.color = '#fff';
                // Restore from input
                expiresInput.dispatchEvent(new Event('input'));
            }
        });
    });
</script>
@endsection
