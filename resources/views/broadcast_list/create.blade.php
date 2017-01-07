@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('broadcast_list.index') }}">Listes de diffusion</a></li>
    <li class="active">Nouvelle liste de diffusion</li>
</ol>

@endsection

@section('content')

<h1>Nouvelle liste de diffusion</h1>

@include('partials.alerts.errors')

<form method="POST" action="{{ route('broadcast_list.store') }}">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="name">Nom de la liste</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Créer la liste de diffusion
        </button>
    </div>
</form>

@endsection