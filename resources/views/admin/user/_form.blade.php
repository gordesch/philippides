{{ csrf_field() }}

@include('partials.alerts.errors')

<div class="form-group">
    <label for="name">Nom</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
</div>

<div class="form-group">
    <label for="name">Telegram User ID </label>
    <input type="number" name="telegram_user_id" value="{{ old('telegram_user_id', $user->telegram_user_id) }}" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        {!! $submitButtonIcon ?? '<i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>' !!}
        {{ $submitButtonText ?? 'Créer l\'utilisateur·rice' }}
    </button>
</div>