<button id="delete-label" class="btn btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#delete">
    Suppression
</button>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-label">Suppression de {{ $theModelDeleteText }} {{ $modelName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr·e de vouloir supprimer {{ $thisModelDeleteText }} {{ $modelName }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Non
                </button>
                <form method="POST" action="{{ route("$model.destroy", [$$model]) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">
                        Supprimer {{ $theModelDeleteText }} {{ $modelName }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>