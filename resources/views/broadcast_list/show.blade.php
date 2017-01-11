@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('broadcast_list.index') }}">Listes de diffusion</a></li>
    <li class="active">{{ $broadcast_list->name }}</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Informations</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('broadcast_list.update', [$broadcast_list]) }}">
            @include('partials.alerts.errors')

            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" name="name" value="{{ old('name', $broadcast_list->name) }}" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Modifier la liste de diffusion
                </button>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Envois</div>
    <ul class="list-group">
        @if($broadcast_list->sendings->isEmpty())
            <li class="list-group-item">Aucun message associé à la liste</li>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($broadcast_list->sendings as $sending)
        <li class="list-group-item">
            {{ $sending->title }}
            <a href="{{ route('sending.show', [$sending] ) }}" class="btn btn-sm btn-default">
                Détails du message
            </a>
            <form method="POST" action="{{ route('sending.destroy', [$sending]) }}" style="display:inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" name="deletion_origin" value="broadcast_list">              
                <button type="submit" class="btn btn-sm btn-danger">
                    Archiver l'envoi
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Abonnés</div>
    <ul class="list-group">
        @if($broadcast_list->list_subscribers->isEmpty())
            <li class="list-group-item">Aucun contact abonné</li>
        @endif
        <a href="{{ route('broadcast_list.subscribe', [$broadcast_list]) }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Ajouter un abonné
        </a>
        @foreach($broadcast_list->list_subscribers as $list_subscriber)
        <li class="list-group-item">
            {{ $list_subscriber->first_name }} {{ $list_subscriber->last_name }}
            <a href="{{ route('person.show', $list_subscriber->id ) }}" class="btn btn-sm btn-default">
                Détails du contact
            </a>
            <form method="POST" action="{{ route('broadcast_list.unsubscribe', [$broadcast_list, $list_subscriber]) }}" style="display:inline;">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">
                    Désinscrire
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
    
@endsection