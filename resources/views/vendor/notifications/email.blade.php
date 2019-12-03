@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Oups !
@else
# Bonjour !
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
Cordialement,<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
Si vous avez des difficultés à cliquer sur le bouton {{ $actionText }}, copiez-collez le lien ci-dessous\n
dans votre navigateur : [:{{ $actionUrl }}](:{{ $actionUrl }})
@endslot
@endisset
@endcomponent
