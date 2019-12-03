@extends("shared.center")

@section("title", "Réinitialiser le mot de passe")

@section("content")
    @if (Session::exists('status'))
        <div class="alert alert-success" role="alert">
            {!! session('status') !!}
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email', $email) }}" placeholder="Addresse email" required="required" autofocus="autofocus">
                <label for="inputEmail">Adresse email</label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Mot de passe" required="required">
                <label for="inputPassword">Mot de passe</label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="inputPasswordConfirm" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe" required="required">
                <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer"/>
    </form>
@endsection
