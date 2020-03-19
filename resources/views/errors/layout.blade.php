@extends('shared.center')

@section('content')
    <div class="text-center">
        <h1 class="display-1">@yield('code')</h1>
        <p class="lead">
            @yield('title') !<br/>
            @yield('message').<br/>
        </p>
        <a href="{{ route('home') }}">Revenir à l'accueil</a>
    </div>
@endsection
