<div class="modal fade" id="deleteModal-{{ $manager->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $manager->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $manager->id }}">Supprimer {{ $manager->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes vous sur de vouloir supprimer le manager {{ $manager->name }} ?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('managers.destroy', $manager->id) }}">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</div>
