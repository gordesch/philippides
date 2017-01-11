@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('sending.index') }}">Envois</a></li>
    <li class="active">Nouvel envoi</li>
</ol>

@endsection

@section('content')

<h1>Nouvel envoi</h1>

@include('partials.alerts.errors')

<form method="POST" action="{{ route('sending.store') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="body">Corps du message</label>
        <textarea 
            pattern="@£$¥èéùìòÇ\fØø\nÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\x22#¤%&'()*+,-./[0-9]:;<=>\?¡[A-Z]ÄÖÑÜ§¿[a-z]äöñüà\^\{\}\[~\]\|€"
            name="body"
            class="form-control"
        >{{ old('body') }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Créer l'envoi
        </button>
    </div>
</form>

@endsection