{{ csrf_field() }}

@include('partials.alerts.errors')

<div class="form-group">
    <label for="title">Titre</label>
    <input type="text" name="title" value="{{ old('title', $sending->title) }}" class="form-control">
</div>

<div class="form-group">
    <label for="body">Corps du message</label>
    <textarea
            pattern="@£$¥èéùìòÇ\fØø\nÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\x22#¤%&'()*+,-./[0-9]:;<=>\?¡[A-Z]ÄÖÑÜ§¿[a-z]äöñüà\^\{\}\[~\]\|€"
            name="body"
            class="form-control">{{ old('body', $sending->body) }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        @if($submitButtonIconClass)
            <i class="fa fa-fw fa-{{ $submitButtonIconClass ?? 'plus-circle' }}" aria-hidden="true"></i>
        @endif
        {{ $submitButtonText ?? 'Créer l\'envoi' }}
    </button>
</div>