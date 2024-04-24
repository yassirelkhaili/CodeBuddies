@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src={{ asset('assets/svgs/codebuddieslogo.svg') }} class="logo" alt="CodeBuddies Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
