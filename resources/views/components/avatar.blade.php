@props(['user'])

@if ($user)
    <img src="{{ asset('public/storage/avatars/'.$user) }}" {{ $attributes }} alt="{{ $user }}">
@else
    <img src="{{ asset('public/storage/img/avatar4.png') }}" alt="{{ $user }}'s avatar" {{ $attributes }} >
@endif