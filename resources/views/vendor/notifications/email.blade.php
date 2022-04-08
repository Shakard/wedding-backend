@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
<!-- # @lang('Hello!') -->
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<!-- @lang('Saludos'),<br> -->
<!-- {{ config('app.name') }} -->
<!-- <img src="{{asset('logos/only-logo.png')}}" alt="{{config('app.name')}}"> -->
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
<!-- @lang(
    "Si está teniendo problemas al dar click en el boton \":actionText\", copie y pegue el siguiente vínculo\n".
    'en su navegador:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span> -->
@endslot
@endisset
@endcomponent
