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
            <a href="{{ route('person.show', [$person] ) }}" class="list-group-item">
                {{ $person->first_name }} {{ $person->last_name }}
                @if ($person->mobile_phone_status === 'valid')
                    <span class="pull-right label label-success">N° de mobile vérifié</span>
                @elseif ($person->mobile_phone_status === 'unknown')
                    <span class="pull-right label label-warning">N° de mobile non vérifié</span>
                @elseif ($person->mobile_phone_status === 'not_valid')
                    <span class="pull-right label label-danger">N° de mobile invalide</span>
                @elseif ($person->mobile_phone_status === 'checking')
                    <span class="pull-right label label-info">N° de mobile en cours de vérification...</span>
                @endif
            </a>
        @endforeach
    </ul>
</div>

@endsection