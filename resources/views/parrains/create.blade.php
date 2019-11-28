@extends('shared.front')

@section('title', "Créer un parrain")

@section('content')
    <form method="post" action="{{ route('parrains.create') }}">
        @csrf
        <div class="form-group">
            <label for="inputLastname">Nom</label>
            <input type="text" class="form-control" id="inputLastname" name="lastname" value="{{ old('lastname') }}" required>
        </div>
        <div class="form-group">
            <label for="inputFirstname">Prénom</label>
            <input type="text" class="form-control" id="inputFirstname" name="firstname" value="{{ old('firstname') }}" required>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
    </form>
@endsection
