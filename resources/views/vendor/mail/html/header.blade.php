<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('frontend/assets/images/logo-dark.png') }}" width="150px" class="logo" style="margin-bottom: 1em" alt=" Logo">
<img src="{{ asset('backend/assets/img/coverclear.jpg') }}" class="logo" alt=" Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
