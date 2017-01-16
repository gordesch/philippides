@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Contacts</li>
</ol>

@endsection

@section('content')

<div class="card">
    <ul class="list-group list-group-flush">
        @if($people->isEmpty())
            <li class="list-group-item">Aucun contact créé pour le moment</li>
        @endif
        <a href="{{ route('person.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
            Nouveau contact
        </a>
        @foreach($people as $person)
            <a
                href="{{ route('person.show', [$person] ) }}"
                class="
                    list-group-item
                    list-group-item-action
                    justify-content-between
                    @if ($person->mobile_phone_status === 'unknown')
                        list-group-item-warning
                    @elseif ($person->mobile_phone_status === 'not_valid')
                        list-group-item-danger
                    @elseif ($person->mobile_phone_status === 'checking')
                        list-group-item-info
                    @endif
                    "
            >
                {{ $person->first_name }} {{ $person->last_name }}
                @if ($person->mobile_phone_status === 'valid')
                    <span class="badge badge-success">N° de mobile vérifié</span>
                @elseif ($person->mobile_phone_status === 'unknown')
                    <span class="badge badge-warning">N° de mobile non vérifié</span>
                @elseif ($person->mobile_phone_status === 'not_valid')
                    <span class="badge badge-danger">N° de mobile invalide</span>
                @elseif ($person->mobile_phone_status === 'checking')
                    <span class="badge badge-info">N° de mobile en cours de vérification...</span>
                @endif
            </a>
        @endforeach
    </ul>
</div>

@endsection