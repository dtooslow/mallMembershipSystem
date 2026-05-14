@extends('layouts.premium')

@section('title', 'Dashboard Overview')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .stat-icon {
        position: absolute;
        right: -10px;
        bottom: -20px;
        font-size: 6rem;
        opacity: 0.05;
        color: var(--primary);
        transform: rotate(-15deg);
        transition: transform 0.5s ease;
    }

    .stat-card:hover .stat-icon {
        transform: rotate(0) scale(1.1);
        opacity: 0.1;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.95rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #fff, var(--text-muted));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .dashboard-hero {
        padding: 3rem;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(129, 140, 248, 0.05));
        border: 1px solid rgba(56, 189, 248, 0.2);
        margin-bottom: 2rem;
        position: relative;
    }

    .hero-title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .hero-subtitle {
        color: var(--text-muted);
        font-size: 1.1rem;
        max-width: 600px;
        line-height: 1.6;
    }
</style>

<div class="dashboard-hero">
    <h2 class="hero-title">Welcome back, {{ auth()->user()->name ?? 'Admin' }}!</h2>
    <p class="hero-subtitle">Here's what's happening with your NCCC Mall ecosystem today. Monitor your member growth, incoming transactions, and active shops.</p>
</div>

<div class="stats-grid">
    <div class="glass-card stat-card">
        <i class="ph-fill ph-storefront stat-icon"></i>
        <div class="stat-label">Total Shops</div>
        <div class="stat-value">{{ \App\Models\Shop::count() ?? 0 }}</div>
    </div>
    
    <div class="glass-card stat-card">
        <i class="ph-fill ph-users-three stat-icon" style="color: var(--secondary);"></i>
        <div class="stat-label">Active Members</div>
        <div class="stat-value">{{ \App\Models\Membership::count() ?? 0 }}</div>
    </div>

    <div class="glass-card stat-card">
        <i class="ph-fill ph-receipt stat-icon" style="color: var(--accent);"></i>
        <div class="stat-label">Transactions</div>
        <div class="stat-value">{{ \App\Models\Transaction::count() ?? 0 }}</div>
    </div>

    <div class="glass-card stat-card">
        <i class="ph-fill ph-star stat-icon" style="color: #FCD34D;"></i>
        <div class="stat-label">Total Points Issued</div>
        <div class="stat-value">{{ number_format(\App\Models\Transaction::sum('points_earned') ?? 0) }}</div>
    </div>
</div>

@endsection
