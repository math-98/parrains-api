@extends("shared.front")

@section('title', "Parrainages")

@auth
    @php $class = "col-6" @endphp
@endauth
@guest
    @php $class = "col-12" @endphp
@endguest

@section("content")
    <div class="row">
        @auth
            <div class="{{ $class }}">
                <a href="{{ route('parrainages.attribution') }}" class="btn btn-success btn-block mb-3">
                    <i class="fas fa-play"></i>
                    Démarrer le parrainage
                </a>
            </div>
        @endauth
        <div class="{{ $class }}">
            <a href="#" class="btn btn-secondary btn-block mb-3">
                <i class="fas fa-print"></i>
                Imprimer la liste
            </a>
        </div>
    </div>

    <h3>Parrainages</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Filleul</th>
                <th scope="col">Parrain</th>
                @auth
                    <th scope="col">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($parrainages as $parrainage)
                <tr>
                    <td>{{ $parrainage->lastname }} {{ $parrainage->firstname }}</td>
                    <td>{{ $parrainage->parrain->lastname }} {{ $parrainage->parrain->firstname }}</td>
                    @auth
                        <td>
                            <a href="#" class="btn btn-block btn-success">
                                <i class="fas fa-pen"></i>
                                Editer
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr/>

    <h3>Absents</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                @auth
                    <th scope="col">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($absents as $absent)
                <tr>
                    <td>{{ $absent->lastname }} {{ $absent->firstname }}</td>
                    @auth
                        <td>
                            <a href="#" class="btn btn-block btn-secondary">
                                <i class="fas fa-plus"></i>
                                Assigner
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "language": {
                    "url": "{{ asset('js/datatables-french.json') }}"
                }
            });
        });
    </script>
@endsection
