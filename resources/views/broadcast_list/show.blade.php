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
    <div class="panel-heading">Messages</div>
    <ul class="list-group">
        @if($broadcast_list->broadcast_messages->isEmpty())
            <li class="list-group-item">Aucun message associé à la liste</li>
        @endif
        <a href="{{ route('broadcast_message.create', [$broadcast_list]) }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($broadcast_list->broadcast_messages as $broadcast_message)
        <li class="list-group-item">
            {{ $message->title }}
            <a href="{{ route('broadcast_message.show', [$broadcast_message] ) }}" class="btn btn-sm btn-default">
                Détails du message
            </a>
            <form method="POST" action="{{ route('broadcast_message.destroy', [$broadcast_message]) }}" style="display:inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" name="deletion_origin" value="broadcast_list">              
                <button type="submit" class="btn btn-sm btn-danger">
                    Archiver le message
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
        <a href="{{ route('broadcast_list.list_subscriber.create', [$broadcast_list]) }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Ajouter un abonné
        </a>
        @foreach($broadcast_list->list_subscribers as $list_subscriber)
        <li class="list-group-item">
            {{ $list_subscriber->person->first_name }} {{ $list_subscriber->person->last_name }}
            <a href="{{ route('person.show', $list_subscriber->person->id ) }}" class="btn btn-sm btn-default">
                Détails du contact
            </a>
            <form method="POST" action="{{ route('broadcast_list.list_subscriber.destroy', [$broadcast_list, $list_subscriber]) }}" style="display:inline;">
                {{ method_field('DELETE') }}
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