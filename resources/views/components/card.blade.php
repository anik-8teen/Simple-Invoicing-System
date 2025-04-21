{{-- Bootstrap Card Component --}}
<div {{ $attributes->merge(['class' => 'card shadow-sm mb-4']) }}> {{-- Use Bootstrap 'card', add shadow and margin --}}
    @isset($title)
        <div class="card-header"> {{-- Bootstrap 'card-header' --}}
            {{ $title }}
        </div>
    @endisset

    <div class="card-body"> {{-- Bootstrap 'card-body' --}}
        {{ $slot }} {{-- Main content goes here --}}
    </div>

    @isset($footer)
        <div class="card-footer text-muted"> {{-- Bootstrap 'card-footer' --}}
            {{ $footer }}
        </div>
    @endisset
</div>