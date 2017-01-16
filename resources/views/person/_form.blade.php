{{ csrf_field() }}

@include('partials.alerts.errors')

@include('partials.forms.section-select')

<div class="form-group">
    <label for="first_name">Prénom</label>
    <input type="text" name="first_name" value="{{ old('first_name', $person->first_name) }}" placeholder="Inès" class="form-control">
</div>

<div class="form-group">
    <label for="last_name">Nom</label>
    <input type="text" name="last_name" value="{{ old('last_name', $person->last_name) }}" placeholder="Reza" class="form-control">
</div>

<div class="form-group">
    <label for="address">Adresse</label>
    <input type="text" name="address" value="{{ old('address', $person->address) }}" placeholder="12, cité des trois bornes" class="form-control">
</div>

<div class="form-group">
    <label for="zipcode">Code Postal</label>
    <input type="number" name="zipcode" value="{{ old('zipcode', $person->zipcode) }}" placeholder="75011" class="form-control">
</div>

<div class="form-group">
    <label for="city">Ville</label>
    <input type="text" name="city" value="{{ old('city', $person->city) }}" placeholder="Paris" class="form-control">
</div>

<div class="form-group">
    <label for="landline">Téléphone fixe</label>
    <input type="number" name="landline" value="{{ old('landline', $person->landline) }}" placeholder="0148732396" class="form-control">
</div>

<div class="form-group">
    <label for="mobile_phone">
        Téléphone portable
        @if ($person->mobile_phone_status === 'valid')
            <span class="badge badge-success">Vérifié</span>
        @elseif ($person->mobile_phone_status === 'unknown')
            <span class="badge badge-warning">Non vérifié</span>
        @elseif ($person->mobile_phone_status === 'not_valid')
            <span class="badge badge-danger">Invalide</span>
        @elseif ($person->mobile_phone_status === 'checking')
            <span class="badge bage-info">En cours de vérification...</span>
        @endif
    </label>
    <input type="number" name="mobile_phone" value="{{ old('mobile_phone', $person->mobile_phone) }}" placeholder="0645645084" class="form-control">
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" name="email" value="{{ old('email', $person->email) }}" placeholder="ines.reza@gmail.com" class="form-control">
</div>

<div class="form-group">
    <label for="university">Établissement</label>
    <input type="text" name="university" value="{{ old('university', $person->university) }}" placeholder="Paris 1" class="form-control">
</div>

<div class="form-group">
    <label for="major">Filière</label>
    <input type="text" name="major" value="{{ old('major', $person->major) }}" placeholder="Économie" class="form-control">
</div>

<div class="form-group">
    <label for="year">Année</label>
    <input type="text" name="year" value="{{ old('year', $person->year) }}" placeholder="3" class="form-control">
</div>

<div class="form-check">
    <label class="form-check-label">
        <input
                class="form-check-input"
                type="checkbox"
                name="unef_member"
                value="1"
                @if (old('unef_member', $person->unef_member))
                checked
                @endif
        >
        Adhérent Unef
    </label>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input
                type="checkbox"
                name="messageable"
                value="1"
                @if (isset($person->messageable))
                    @if ($person->messageable)
                        checked
                    @endif
                @else
                    checked
                @endif
                class="form-check-input">
        Accepte les messages
    </label>
</div>

<div class="form-group">
    <label for="comments">Commentaires</label>
    <textarea name="comments" rows="3" class="form-control">{{ old('comments', $person->comments) }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-block btn-primary">
        @if($submitButtonIconClass)
            <i class="fa fa-fw fa-{{ $submitButtonIconClass ?? 'plus-circle' }}" aria-hidden="true"></i>
        @endif
        {{ $submitButtonText ?? 'Créer le contact' }}
    </button>
</div>