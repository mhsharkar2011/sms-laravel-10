@props(['user'])

@if ($user)
    <img src="{{ asset('storage/avatars/'.$user) }}" {{ $attributes }} alt="{{ $user }}'s avatar">
@else
    <img src="{{ asset('storage/img/avatar4.png') }}" alt="{{ $user }}'s avatar" {{ $attributes }} >
@endif