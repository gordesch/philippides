@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="active">Contacts</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <ul class="list-group">
        @if($people->isEmpty())
            <li class="list-group-item">Aucun contact créé pour le moment</li>
        @endif
        <a href="{{ route('person.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouveau contact
        </a>
        @foreach($people as $person)
        <li class="list-group-item">
            {{ $person->first_name }} {{ $person->last_name }} 
            <a href="{{ route('person.show', [$person] ) }}" class="btn btn-sm btn-default">
                Détails
            </a>
            <form method="POST" action="{{ route('person.destroy', [$person]) }}" style="display:inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">
                    Supprimer
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

@endsection