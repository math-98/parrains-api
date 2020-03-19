@extends("shared.base")
@section("body_class", "bg-dark")

@section("body")
    <div class="container vertical-align">
        <div class="card card-login mx-auto">
            <div class="card-header">@yield('title')</div>
            <div class="card-body">
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

                @yield('content')
            </div>
        </div>
    </div>
@endsection
