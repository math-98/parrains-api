@extends("shared.front")

@section('title', "Managers")

@section("content")
    <a href="{{ route('managers.create') }}" class="btn btn-primary btn-block mb-3">
        <i class="fas fa-user-plus"></i>
        Ajouter un manager
    </a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Créé le</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="row" role="group">
                            <div class="col-6">
                                <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-block btn-success">
                                    <i class="fas fa-pen"></i>
                                    Editer
                                </a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $manager->id }}">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @include("managers.delete_modal", ['manager' => $manager])
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
