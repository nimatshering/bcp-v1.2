<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Bhutan Climate Portal')
<img src="{{ asset('assets/img/logo-dark.png')}}" class="BCP" alt="Bhutan Climate Portal">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
