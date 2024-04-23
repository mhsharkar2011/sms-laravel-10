<div class="col-{{ $col }}">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }}>
        {{ $slot }}
    </button>
</div>
