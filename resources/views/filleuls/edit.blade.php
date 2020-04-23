@extends('shared.front')

@section('title', "Editer le filleul ".$filleul->lastname." ".$filleul->firstname)

@section('content')
    <form method="post" action="{{ route('filleuls.store', $filleul->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputLastname">Nom</label>
            <input type="text" class="form-control" id="inputLastname" name="lastname" value="{{ old('lastname', $filleul->lastname) }}" required>
        </div>
        <div class="form-group">
            <label for="inputFirstname">Prénom</label>
            <input type="text" class="form-control" id="inputFirstname" name="firstname" value="{{ old('firstname', $filleul->firstname) }}" required>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
    </form>
@endsection
