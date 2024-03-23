@props(['avatar'])

@if ($avatar)
    <img src="{{ asset('public/storage/avatars/'.$avatar) }}" {{ $attributes }} alt="{{ $avatar }}">
@else
    <img src="{{ asset('public/storage/img/avatar4.png') }}" alt="{{ $avatar }}'s avatar" {{ $attributes }} >
@endif