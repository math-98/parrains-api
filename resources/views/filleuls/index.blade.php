@extends("shared.front")

@section('title', "Filleuls")

@section("content")
    @auth
        <div class="row">
            <div class="col-6">
                <a href="{{ route('filleuls.create') }}" class="btn btn-primary btn-block mb-3">
                    <i class="fas fa-user-plus"></i>
                    Ajouter un filleul
                </a>
            </div>
            <div class="col-6">
                <a href="#" class="btn btn-secondary btn-block mb-3">
                    <i class="fas fa-upload"></i>
                    Importer une liste
                </a>
            </div>
        </div>
    @endauth

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            @auth
                <th scope="col">Créé le</th>
                <th scope="col">Actions</th>
            @endauth
        </tr>
        </thead>
        <tbody>
            @foreach($filleuls as $filleul)
                <tr>
                    <td>
                        {{ $filleul->lastname }} {{ $filleul->firstname }}
                        @if ($filleul->absent)
                            <span class="text-muted">(Absent)</span>
                        @endif
                    </td>
                    @auth
                        <td>{{ $filleul->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="row" role="group">
                                <div class="col-6">
                                    <a href="{{ route('filleuls.edit', $filleul->id) }}" class="btn btn-block btn-success">
                                        <i class="fas fa-pen"></i>
                                        Editer
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $filleul->id }}">
                                        <i class="fas fa-trash"></i>
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </td>
                    @endauth
                </tr>
                @auth
                    @include("filleuls.delete_modal", ['filleul' => $filleul])
                @endauth
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
