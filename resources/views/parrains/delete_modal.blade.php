<div class="modal fade" id="deleteModal-{{ $parrain->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $parrain->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $parrain->id }}">Supprimer  {{ $parrain->lastname }} {{ $parrain->firstname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes vous sur de vouloir supprimer le parrain {{ $parrain->lastname }} {{ $parrain->firstname }} ?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('parrains.destroy', $parrain->id) }}">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</div>
