@extends("shared.center")

@section("title", "Réinitialiser le mot de passe")

@section("content")
    @if (Session::exists('status'))
        <div class="alert alert-success" role="alert">
            {!! session('status') !!}
        </div>
    @endif

    <form method="post" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email', $email) }}" placeholder="Addresse email" required="required" autofocus="autofocus">
                <label for="inputEmail">Adresse email</label>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer"/>
    </form>
@endsection
