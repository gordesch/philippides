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
    
    @include('person.create-form')
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Créer le contact
        </button>
    </div>
</form>

@endsection