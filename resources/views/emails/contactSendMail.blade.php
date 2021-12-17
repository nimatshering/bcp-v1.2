@component('mail::message')
<br>
{{ $contactus['message'] }}

<br><br>
{{ $contactus['name'] }} <br>
{{ $contactus['email'] }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent