@extends('layouts.premium')

@section('title', 'Add New Membership')

@section('content')
<style>
    .create-form-wrapper {
        max-width: 800px;
        margin: 0 auto;
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
</style>

<div class="create-form-wrapper">
    <a href="{{ route('memberships.index') }}" class="btn-action-back">
        <i class="ph ph-arrow-left"></i> Back to Directory
    </a>

    <div class="glass-card">
        <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">
            Create Membership Record
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

        <form action="{{ route('memberships.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="user_id">Select User</label>
                @if($users->isEmpty())
                    <div style="padding: 12px 16px; background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 12px; color: #EF4444; font-size: 0.95rem;">
                        <i class="ph ph-warning-circle"></i> All registered users already have memberships.
                    </div>
                @else
                    <select name="user_id" id="user_id" class="form-control" style="background: #111827; color: white;" required>
                        <option value="" disabled selected>-- Select a registered user --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="grid-fields">
                <div class="form-group">
                    <label class="form-label" for="tier">Membership Tier</label>
                    <select name="tier" id="tier" class="form-control" style="background: #111827; color: white;" required>
                        <option value="Bronze" {{ old('tier') == 'Bronze' ? 'selected' : '' }}>Bronze Tier</option>
                        <option value="Silver" {{ old('tier') == 'Silver' ? 'selected' : '' }}>Silver Tier</option>
                        <option value="Gold" {{ old('tier') == 'Gold' ? 'selected' : '' }}>Gold Tier</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="points">Initial points</label>
                    <input type="number" name="points" id="points" class="form-control" value="{{ old('points', 0) }}" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="expires_at">Membership Expiry Date</label>
                <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ old('expires_at', now()->addYear()->format('Y-m-d')) }}" required>
                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 4px;">
                    Defaults to 1 year from today if left unchanged.
                </span>
            </div>

            <button type="submit" class="btn-glow" style="width: 100%; justify-content: center; padding: 14px; margin-top: 1rem;" {{ $users->isEmpty() ? 'disabled' : '' }}>
                <i class="ph ph-plus-circle"></i> <span>Create Membership</span>
            </button>
        </form>
    </div>
</div>
@endsection
