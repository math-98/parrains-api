@extends("shared.front")

@section("title", "Assigner un parrain à ".$filleul->lastname." ".$filleul->firstname)

@section("content")
    <form method="post" action="{{ route('parrainages.assign') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="parrainSelect">Sélectionnez un parrain</label>
            <select id="parrainSelect" class="custom-select" name="parrain">
                @foreach($parrains as $parrain)
                    <option value="{{ $parrain->id }}"
                            @if ($parrain->id == old('parrain', $filleul->parrain_id)) selected @endif
                    >{{ $parrain->lastname }} {{ $parrain->firstname }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#parrainSelect').select2();
        });
    </script>
@endsection
