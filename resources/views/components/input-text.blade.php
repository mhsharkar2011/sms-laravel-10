<div class="form-group col-{{ $col }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder ?? $slot }}" value="{{ $value }}" {{ $attributes->merge(['class'=>'form-control']) }}>
</div>
