@component('mail::message')
Hello {{$user->name}},

<p>we understand it happens. </p>
<p>Click the link below to reset your password.</p>


@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issue recovering your password, Please contact IT Cell.</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
