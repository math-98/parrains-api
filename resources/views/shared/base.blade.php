<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="@yield("description", "Système d'affectation automatisée d'un étudiant parrain à un étudiant filleul")">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="author" content="Léo COLOMINA & Mathieu SERVIERE"/>
        <link rel="shortcut icon" type="image/png" href="{{ asset("img/favicon.png") }}"/>
        <meta name='robots' content='noindex'/>

        <title>@yield('title') - Parrains</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        @yield("css")
    </head>
    <body id="page-top" class="@yield("body_class")">
        @yield("body")

        <script src="{{ asset('js/app.js') }}"></script>
        @yield("js")
    </body>
</html>
