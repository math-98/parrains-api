@extends('shared.front')

@section('title', "Créer un manager")

@section('content')
    <form method="post" action="{{ route('managers.create') }}">
        @csrf
        <div class="form-group">
            <label for="inputName">Nom</label>
            <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Mot de passe</label>
            <input type="password" class="form-control" id="inputPassword" name="password" required>
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="inputConfirmPassword" name="password_confirmation" required>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
    </form>
@endsection
