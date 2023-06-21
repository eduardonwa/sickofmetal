@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'SickOfMetal')
<img src="https://i.imgur.com/mc3Y49E.png" class="logo" alt="SickOfMetal Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>