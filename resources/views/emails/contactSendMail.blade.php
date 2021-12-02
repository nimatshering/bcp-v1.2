@component('mail::message')
<br>
{{ $contactus['message'] }}

<br><br>
{{ $contactus['name'] }} <br>
{{ $contactus['email'] }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent


{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}