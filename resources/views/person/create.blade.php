@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('person.index') }}">Contacts</a></li>
    <li class="active">Nouveau contact</li>
</ol>

@endsection

@section('content')

<h1>Nouveau contact</h1>

@include('partials.alerts.errors')

<form method="POST" action="{{ route('person.store') }}">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Inès" class="form-control">
    </div>
    <div class="form-group">
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Reza" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">Adresse</label>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="12, cité des trois bornes" class="form-control">
    </div>
    <div class="form-group">
        <label for="zipcode">Code Postal</label>
        <input type="number" name="zipcode" value="{{ old('zipcode') }}" placeholder="75011" class="form-control">
    </div>
    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" name="city" value="{{ old('city') }}" placeholder="Paris" class="form-control">
    </div>
    <div class="form-group">
        <label for="landline">Téléphone fixe</label>
        <input type="number" name="landline" value="{{ old('landline') }}" placeholder="0148732396" class="form-control">
    </div>
    <div class="form-group">
        <label for="mobile_phone">Téléphone portable</label>
        <input type="number" name="mobile_phone" value="{{ old('mobile_phone') }}" placeholder="0645645084" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="ines.reza@gmail.com" class="form-control">
    </div>
    <div class="form-group">
        <label for="university">Établissement</label>
        <input type="text" name="university" value="{{ old('university') }}" placeholder="Paris 1" class="form-control">
    </div>
    <div class="form-group">
        <label for="major">Filière</label>
        <input type="text" name="major" value="{{ old('major') }}" placeholder="Économie" class="form-control">
    </div>
    <div class="form-group">
        <label for="year">Année</label>
        <input type="text" name="year" value="{{ old('year') }}" placeholder="3" class="form-control">
    </div>
    <div class="checkbox">
        <label>
            <input
                type="checkbox"
                name="unef_member"
                value="1"
                @if (old('unef_member'))
                    checked
                @endif
            >
            Adhérent Unef
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input
                type="checkbox"
                name="messageable"
                value="0"
            >
            Refuse les messages
        </label>
    </div>
    <div class="form-group">
        <label for="comments">Commentaires</label>
        <textarea name="comments" rows="3" class="form-control">{{ old('comments') }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Créer le contact
        </button>
    </div>
</form>

@endsection