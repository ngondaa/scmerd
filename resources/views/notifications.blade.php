<x-layouts::app :title="__('Notifications')">

@include('partials.portal.open')

<div class="cp-hero">
    <p class="cp-kicker">Updates</p>
    <h1 class="cp-hello">Notifications</h1>
    <p class="cp-hello-sub">Recent updates on your submissions and actions.</p>
</div>

@if (count($notifications) === 0)
    <div class="cp-empty">
        <p class="cp-empty-text">No notifications yet.</p>
    </div>
@else
    @foreach ($notifications as $notification)
        <div class="cp-card cp-card--inset">
            <p class="cp-item-title">{{ $notification['message'] }}</p>
            <p class="cp-item-meta">{{ $notification['at'] }}</p>
        </div>
    @endforeach
@endif

@include('partials.portal.close')

</x-layouts::app>
