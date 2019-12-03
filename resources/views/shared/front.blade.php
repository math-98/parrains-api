@extends("shared.base")

@section("body")
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="{{ route('home') }}">
            <i class="fas fa-hands-helping"></i>
            Parrainage
        </a>

        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Déconnexion</a>
                    </div>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt fa-fw"></i>
                        Connexion
                    </a>
                </li>
            @endguest
        </ul>
    </nav>

    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container">
                @unless(Route::current()->getName() == 'home')
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Accueil</a>
                        </li>
                        @foreach($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                        @endforeach
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                @endunless

                @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            - {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                @if (Session::exists('alerts'))
                    @foreach(session('alerts') as $alert)
                        <div class="alert alert-{{ $alert['type'] }}" role="alert">
                            {!! $alert['text'] !!}
                        </div>
                    @endforeach
                @endif

                @yield("content")
            </div>

            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © <a href="https://math98.fr" target="_blank">math-98</a> - {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @auth
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Prêt à partir ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous être prêt à terminer votre session actuelle.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Déconnexion"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
