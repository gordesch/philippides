@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('broadcast_list.index', [$broadcast_list]) }}">Liste de diffusion</a></li>
    <li><a href="{{ route('broadcast_list.show', [$broadcast_list]) }}">{{ $broadcast_list->name }}</a></li>
    <li class="active">Ajout d'abonné(s)</li>
</ol>

@endsection

@section('content')

<h1>Ajout d'abonné(s)</h1>

@include('partials.alerts.errors')

<form method="POST" action="{{ route('broadcast_list.list_subscriber.store', [$broadcast_list]) }}">
    {{ csrf_field() }}
    <input type="hidden" name="broadcast_list_id" value="{{ $broadcast_list->id }}">
    <div class="panel panel-default">
        <ul class="list-group">
            @if ($people->isEmpty())
                <li class="list-group-item">
                    Tous les contacts sont déjà abonnés à la liste
                </li>
            @endif
            @foreach ($people as $person)
                <li class="list-group-item">
                    <div class="checkbox">
                        <label>
                            <input
                                type="checkbox"
                                name="people_ids[]"
                                value="{{ $person->id }}"
                            >
                            {{ $person->last_name }} {{ $person->first_name }}
                        </label>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Ajouter un ou des abonnés
        </button>
    </div>
</form>

@endsection