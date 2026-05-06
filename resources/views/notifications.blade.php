<x-layouts::app :title="__('Notifications')">
<style>
    .cp-shell { background: #f0f0f5; border-radius: 20px; padding: 16px; font-family: var(--font-sans, ui-sans-serif, system-ui, sans-serif); max-width: 1000px; margin: 0 auto; }
    .cp-hero { margin-bottom: 24px; padding: 0 4px; }
    .cp-hello { font-size: 28px; font-weight: 500; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.15; }
    .cp-hello-sub { font-size: 13px; color: #888; margin-top: 4px; }
    .cp-card { background: #fff; border-radius: 12px; padding: 16px; margin-bottom: 12px; border: 1px solid #e0e0ee; }
    .cp-item-title { font-size: 14px; color: #1a1a2e; }
    .cp-item-meta { font-size: 12px; color: #888; margin-top: 4px; }
    .cp-empty { text-align: center; padding: 40px 20px; background: #fff; border-radius: 16px; border: 1px dashed #c8c8de; font-size: 13px; color: #888; }
</style>

<div class="cp-shell">
    @include('partials.topbar')
    <div class="cp-hero">
        <h1 class="cp-hello">Author Notifications</h1>
        <p class="cp-hello-sub">Recent updates on your submissions and actions.</p>
    </div>

    @if (count($notifications) === 0)
        <div class="cp-empty">
            No notifications yet.
        </div>
    @else
        <div>
            @foreach ($notifications as $notification)
                <div class="cp-card">
                    <p class="cp-item-title">{{ $notification['message'] }}</p>
                    <p class="cp-item-meta">{{ $notification['at'] }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
</x-layouts::app>
