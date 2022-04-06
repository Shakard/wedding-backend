<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<!-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> -->
<img src="https://png.pngtree.com/png-clipart/20190705/original/pngtree-wedding-logo-in-vintage-style-png-image_4359658.jpg" class="logo" alt="Laravel Logo">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
