@component('mail::message')
Hello {{ $user->name }}

<p>We Understand it happens</p>
@component('mail::button',['url' => url('reset/'. $user->remeber_token)])
    Reset Yout Password
@endcomponent
    <p>In case you have any issues recovering your password, please contact us.</p>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent