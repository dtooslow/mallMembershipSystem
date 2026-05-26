@extends('layouts.premium')

@section('title', 'Manage Mall Events')

@section('actions')
    <a href="{{ route('events.create') }}" class="btn-glow">
        <i class="ph-bold ph-plus"></i>
        <span>Create Event</span>
    </a>
@endsection

@section('content')
<style>
    .event-type-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .badge-car-show {
        background: rgba(56, 189, 248, 0.15);
        color: var(--primary);
        border: 1px solid rgba(56, 189, 248, 0.3);
    }
    .badge-concert {
        background: rgba(129, 140, 248, 0.15);
        color: var(--secondary);
        border: 1px solid rgba(129, 140, 248, 0.3);
    }
    .badge-art-gallery {
        background: rgba(244, 114, 182, 0.15);
        color: var(--accent);
        border: 1px solid rgba(244, 114, 182, 0.3);
    }
    .badge-other {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
</style>

<div class="glass-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Banner</th>
                    <th>Event Details</th>
                    <th>Type</th>
                    <th>Scheduled Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td style="color: var(--text-muted);">#{{ str_pad($event->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        @if($event->image)
                            <img src="{{ $event->image }}" alt="{{ $event->title }}"
                                 style="width: 72px; height: 52px; object-fit: cover; border-radius: 10px; border: 1px solid var(--border);"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="display: none; width: 72px; height: 52px; border-radius: 10px; background: rgba(255,255,255,0.05); align-items: center; justify-content: center; color: var(--text-muted);">
                                <i class="ph ph-image-broken" style="font-size: 1.4rem;"></i>
                            </div>
                        @else
                            <div style="width: 72px; height: 52px; border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <i class="ph ph-image" style="font-size: 1.4rem;"></i>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight: 600;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center;
                                @if($event->type === 'car_show') background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(129, 140, 248, 0.2)); color: var(--primary);
                                @elseif($event->type === 'small_concert') background: linear-gradient(135deg, rgba(129, 140, 248, 0.2), rgba(244, 114, 182, 0.2)); color: var(--secondary);
                                @elseif($event->type === 'art_gallery') background: linear-gradient(135deg, rgba(244, 114, 182, 0.2), rgba(56, 189, 248, 0.2)); color: var(--accent);
                                @else background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(56, 189, 248, 0.2)); color: var(--success); @endif">
                                @if($event->type === 'car_show') <i class="ph-fill ph-car" style="font-size: 1.4rem;"></i>
                                @elseif($event->type === 'small_concert') <i class="ph-fill ph-guitar" style="font-size: 1.4rem;"></i>
                                @elseif($event->type === 'art_gallery') <i class="ph-fill ph-palette" style="font-size: 1.4rem;"></i>
                                @else <i class="ph-fill ph-calendar-star" style="font-size: 1.4rem;"></i> @endif
                            </div>
                            {{ $event->title }}
                        </div>
                    </td>
                    <td>
                        @if($event->type === 'car_show')
                            <span class="event-type-badge badge-car-show"><i class="ph-bold ph-car"></i> Car Show</span>
                        @elseif($event->type === 'small_concert')
                            <span class="event-type-badge badge-concert"><i class="ph-bold ph-music-notes"></i> Concert</span>
                        @elseif($event->type === 'art_gallery')
                            <span class="event-type-badge badge-art-gallery"><i class="ph-bold ph-palette"></i> Art Gallery</span>
                        @else
                            <span class="event-type-badge badge-other"><i class="ph-bold ph-star"></i> Other Event</span>
                        @endif
                    </td>
                    <td style="font-weight: 500;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <i class="ph ph-clock" style="color: var(--primary);"></i>
                            {{ $event->event_date->format('M d, Y') }}
                        </div>
                    </td>
                    <td style="max-width: 300px; color: var(--text-muted); text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                        {{ $event->description ?? 'No description.' }}
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('events.edit', $event) }}" class="btn-icon" title="Edit">
                                <i class="ph ph-pencil-simple"></i>
                            </a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
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
                    <td colspan="7" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                        <i class="ph ph-calendar-blank" style="font-size: 4.5rem; margin-bottom: 1.5rem; opacity: 0.3; display: block; margin-left: auto; margin-right: auto; color: var(--primary);"></i>
                        <h3 style="color: white; margin-bottom: 0.5rem; font-size: 1.3rem;">No Scheduled Events</h3>
                        <p>Schedule your first mall event (car show, concert, art gallery) and instantly notify all members.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
