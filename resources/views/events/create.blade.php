@extends('layouts.premium')

@section('title', 'Schedule Mall Event')

@section('actions')
    <a href="{{ route('events.index') }}" class="btn-glow" style="background: transparent; border: 1px solid var(--border);">
        <i class="ph-bold ph-arrow-left"></i>
        <span>Back to Events</span>
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

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="title">Event Title <span style="color: var(--accent);">*</span></label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Classic Car Show, Live Summer Jam, Art Masterpieces" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="type">Event Type <span style="color: var(--accent);">*</span></label>
            <select id="type" name="type" class="form-control" style="background-color: #0B0F19;" required>
                <option value="" disabled selected>-- Select Type --</option>
                <option value="car_show" {{ old('type') === 'car_show' ? 'selected' : '' }}>Car Show 🚗</option>
                <option value="small_concert" {{ old('type') === 'small_concert' ? 'selected' : '' }}>Small Concert 🎸</option>
                <option value="art_gallery" {{ old('type') === 'art_gallery' ? 'selected' : '' }}>Art Gallery 🎨</option>
                <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>Other Special Event 🎉</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="event_date">Event Date <span style="color: var(--accent);">*</span></label>
            <input type="date" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', date('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Event Description</label>
            <textarea id="description" name="description" class="form-control" style="min-height: 120px;" placeholder="Describe what the event is about, who is performing/exhibiting, the location in the mall, time, etc...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Event Banner Image <span style="color: var(--text-muted); font-weight: 400;">(optional — paste an image URL)</span></label>
            <input type="url" id="image" name="image" class="form-control" value="{{ old('image') }}"
                   placeholder="https://example.com/event-banner.jpg"
                   oninput="previewImage(this.value)">
            <div id="image-preview-wrap" style="margin-top: 1rem; display: {{ old('image') ? 'block' : 'none' }};">
                <img id="image-preview" src="{{ old('image') }}" alt="Preview"
                     style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 14px; border: 1px solid var(--border);">
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 6px;"><i class="ph ph-check-circle" style="color: var(--success);"></i> Image preview loaded</p>
            </div>
        </div>

        <div style="background: rgba(56, 189, 248, 0.05); border: 1px solid rgba(56, 189, 248, 0.2); padding: 1.25rem; border-radius: 12px; margin: 1.5rem 0; font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: flex-start; gap: 10px;">
            <i class="ph-fill ph-bell-ringing" style="font-size: 1.2rem; color: var(--primary); margin-top: 2px;"></i>
            <span><strong>Notification Alert:</strong> Once you create this event, a notification will be broadcast instantly to all registered customer dashboards.</span>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-glow">
                <i class="ph-bold ph-check"></i>
                <span>Publish & Notify Customers</span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(url) {
    const wrap = document.getElementById('image-preview-wrap');
    const img  = document.getElementById('image-preview');
    if (url && url.trim() !== '') {
        img.src = url.trim();
        img.onerror = () => { wrap.style.display = 'none'; };
        img.onload  = () => { wrap.style.display = 'block'; };
    } else {
        wrap.style.display = 'none';
    }
}
</script>
@endpush
@endsection
