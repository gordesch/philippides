{{ csrf_field() }}

@include('partials.alerts.errors')

<div class="form-group">
    <label for="name">Titre</label>
    <input type="text" name="name" value="{{ old('name', $broadcast_list->name) }}" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        {!! $submitButtonIcon ?? '<i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>' !!}
        {{ $submitButtonText ?? 'Créer la liste de diffusion' }}
    </button>
</div>