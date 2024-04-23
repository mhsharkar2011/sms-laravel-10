
<div class=" col-{{ $col }}">
<a href=" {{ $route }} " {{ $attributes->merge(['type' => 'reset', 'class' => 'btn']) }}>
    <i class="{{ $icon ?? $slot }}"></i>
    {{ $slot }}
</a>
</div>
