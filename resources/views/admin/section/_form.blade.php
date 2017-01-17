{{ csrf_field() }}

@include('partials.alerts.errors')

<div class="form-group">
    <label for="name">Nom de la section</label>
    <input type="text" name="name" value="{{ old('name', $section->name) }}" class="form-control">
</div>

<div class="form-check">
    <label class="form-check-label">
        <input
                class="form-check-input"
                type="checkbox"
                name="global"
                value="1"
                @if (old('global', $section->global))
                checked
                @endif
        >
        {{ config('app.global_section_name') }}
    </label>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        {!! $submitButtonIcon ?? '<i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>' !!}
        {{ $submitButtonText ?? 'Créer la section' }}
    </button>
</div>