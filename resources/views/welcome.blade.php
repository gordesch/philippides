@extends('layouts.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Accueil</li>
    </ol>

@endsection

@section('content')

<div class="card">
    <div class="card-block">
        <h1 class="card-title">Bienvenue</h1>
        <p class="card-text">
            <strong><i class="fa fa-fw fa-bullhorn"></i> Philippidès</strong> est l'application d'envoi de messages de l'Unef
        </p>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <h6 class="card-title">Fonctionnalités</h6>
        <ul>
            <li>importer des contacts,</li>
            <li>les ajouter à des listes de diffusion,</li>
            <li>envoyer des SMS à des contacts et/ou des listes de diffusion,</li>
            <li>recevoir les réponses des contacts et leur répondre.</li>
        </ul>
    </div>
</div>
@endsection
