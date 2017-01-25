@extends('layouts.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Erreur 403</a></li>
    </ol>

@endsection

@section('content')

    <div class="card">
        <div class="card-block">

            <h4 class="card-title">Erreur 403 - Accès interdit</h4>

            <p class="card-text">Vous ne disposez pas du niveau d'autorisation nécessaire.</p>

        </div>
    </div>

@endsection