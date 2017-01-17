{{ csrf_field() }}

@include('partials.alerts.errors')

<div class="form-group">
    <label for="name">Nom</label>
    <input type="text" name="name" value="{{ old('name', $virtual_number->name) }}" class="form-control">
</div>

<div class="form-group">
    <label for="name">Numéro</label>
    <input type="number" name="number" value="{{ old('number', $virtual_number->number) }}" class="form-control">
</div>

<div class="form-group">
    <label for="type">Type</label>
    <select class="form-control" id="type" name="type">
        <option value="long">Long</option>
        <option value="short">Court</option>
    </select>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="global">
        Global
    </label>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        {!! $submitButtonIcon ?? '<i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>' !!}
        {{ $submitButtonText ?? 'Créer le numéro virtuel' }}
    </button>
</div>