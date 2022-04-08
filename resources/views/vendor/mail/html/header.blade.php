<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://uc0e1dde9b3cad04e7a957338b69.previews.dropboxusercontent.com/p/thumb/ABemdslBKPDYvcm3zmqxMf0yHQWY9DukSUNj82o354R08Y5cLRGITebFuA3F3GgAvY_7H1YaInCpuh_xFBMi2KK9u6kdMG2LM0h84U-V3d3ti488bFe1OqGDyTaAPijymYr-3Gb5CwqOUuuuZq0U-65RegQY1Mm-_AAk-y6seuaGmYY0h-JY_K2PM0rtwbU5DC0VebzAK9aMDyCqQRdpGOh-8Td3G50yvOvQsj0LSL0VLM173Th6hANkKtazGJBsA_2YEAdjZEJiGHccNkl6thjvkbd2pOGKCbKzwIYvKzMGrtzGqWhkFQC4EXJA4maIT4vxBB4wOx5zNM7huCUWuMyEAEsuLyUBAX3K89rCH0g_aJlacDGLZQ50MyVmJ8Lr-vU0MHNMvByKvJEpI4_lNvSwyZLXfjmJyLP9AY-H-eKPZg/p.jpeg"
 class="logo" alt="Laravel Logo" style="width:100px; height:auto">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
