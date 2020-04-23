@extends("shared.center")

@section("title", "Inscription")

@section("content")
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <div class="form-label-group">
                <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nom" required="required" autofocus="autofocus">
                <label for="inputName">Nom</label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" placeholder="Addresse email" required="required" autofocus="autofocus">
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
