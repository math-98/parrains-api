@extends('shared.front')

@section('title', "Editer le parrain ".$parrain->lastname." ".$parrain->firstname)

@section('content')
    <form method="post" action="{{ route('parrains.store', $parrain->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputLastname">Nom</label>
            <input type="text" class="form-control" id="inputLastname" name="lastname" value="{{ old('lastname', $parrain->lastname) }}" required>
        </div>
        <div class="form-group">
            <label for="inputFirstname">Prénom</label>
            <input type="text" class="form-control" id="inputFirstname" name="firstname" value="{{ old('firstname', $parrain->firstname) }}" required>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
    </form>
@endsection
