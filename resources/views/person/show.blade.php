@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('person.index') }}">Contacts</a></li>
    <li class="active">{{ $person->first_name }} {{ $person->last_name }}</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Informations</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('person.update', [$person]) }}">
            @include('partials.alerts.errors')
            
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="form-group">
                <label for="section_id">Section</label>
                <select name="section_id" class="form-control">
                    @if(session('user')->role->scope === 'section')
                        <option value="{{ $person->section->id }}" selected>{{ $person->section->name }}</option>
                    @else
                        @foreach(\App\Section::all() as $section)
                            <option
                                value="{{ $section->id }}"
                                @if(old('section_id', $person->section_id) === $section->id)
                                    selected
                                @endif
                            >{{ $section->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" value="{{ old('first_name', $person->first_name) }}" placeholder="Inès" class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" value="{{ old('last_name', $person->last_name) }}" placeholder="Reza" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" name="address" value="{{ old('address', $person->address) }}" placeholder="12, cité des trois bornes" class="form-control">
            </div>
            <div class="form-group">
                <label for="zipcode">Code Postal</label>
                <input type="text" name="zipcode" value="{{ old('zipcode', $person->zipcode) }}" placeholder="75011" class="form-control">
            </div>
            <div class="form-group">
                <label for="city">Ville</label>
                <input type="text" name="city" value="{{ old('city', $person->city) }}" placeholder="Paris" class="form-control">
            </div>
            <div class="form-group">
                <label for="landline">Téléphone fixe</label>
                <input type="number" name="landline" value="{{ old('landline', $person->landline) }}" placeholder="0148732396" class="form-control">
            </div>
            <div class="form-group">
                <label for="mobile_phone">
                    Téléphone portable
                    @if ($person->mobile_phone_status === 'valid')
                    <span class="label label-success">Vérifié</span>
                    @elseif ($person->mobile_phone_status === 'unknown')
                    <span class="label label-warning">Non vérifié</span>
                    @elseif ($person->mobile_phone_status === 'not_valid')
                    <span class="label label-danger">Invalide</span>
                    @elseif ($person->mobile_phone_status === 'checking')
                    <span class="label label-info">Vérification en cours...</span>
                    @endif
                </label>
                <input type="number" name="mobile_phone" value="{{ old('mobile_phone', $person->mobile_phone) }}" placeholder="0645645084" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $person->email) }}" placeholder="ines.reza@gmail.com" class="form-control">
            </div>
            <div class="form-group">
                <label for="university">Établissement</label>
                <input type="text" name="university" value="{{ old('university', $person->university) }}" placeholder="Paris 1" class="form-control">
            </div>
            <div class="form-group">
                <label for="major">Filière</label>
                <input type="text" name="major" value="{{ old('major', $person->major) }}" placeholder="Économie" class="form-control">
            </div>
            <div class="form-group">
                <label for="year">Année</label>
                <input type="text" name="year" value="{{ old('year', $person->year) }}" placeholder="3" class="form-control">
            </div>
            <div class="checkbox">
                <label>
                    <input
                        type="checkbox"
                        name="unef_member"
                        value="1"
                        @if (!empty($person->unef_member))
                        checked
                        @endif
                    >
                    Adhérent
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input
                        type="checkbox"
                        name="messageable"
                        value="1"
                        @if (isset($person->messageable))
                            @if ($person->messageable)
                                checked
                            @endif
                        @else
                            checked
                        @endif
                    >
                    Accepte les messages
                </label>
            </div>
            <div class="form-group">
                <label for="comments">Commentaires</label>
                <textarea name="comments" rows="3" class="form-control">{{ old('comments', $person->comments) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Modifier le contact
                </button>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Inscriptions à des listes de diffusion</div>
    <ul class="list-group">
        @if($person->broadcast_lists->isEmpty())
            <li class="list-group-item">Contact abonné à aucune liste</li>
        @endif
        <li class="list-group-item">
            <form method="POST" action="{{ route('person.subscribe', [$person]) }}" class="form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="creation_origin" value="person">
                <input type="hidden" name="person_id" value="{{ $person->id }}">
                <div class="form-group">
                    @if($available_broadcast_lists->isEmpty())
                        <select class="form-control" disabled>
                            <option>-- Aucune liste disponible --</option>
                        </select>
                    @else
                        <select name="broadcast_list_id" class="form-control">
                            @foreach($available_broadcast_lists as $available_broadcast_list)
                                <option value="{{ $available_broadcast_list->id }}">{{ $available_broadcast_list->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-default"
                        @if($available_broadcast_lists->isEmpty())
                        disabled
                        @endif
                    >
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Abonner à la liste
                    </button>
                </div>
            </form>
        </li>
        @foreach($person->broadcast_lists as $broadcast_list)
        <li class="list-group-item">
            {{ $broadcast_list->name }}
            <a href="{{ route('broadcast_list.show', [$broadcast_list]) }}" class="btn btn-sm btn-default">
                Détails de la liste
            </a>
            <form method="POST" action="{{ route('person.unsubscribe', [$person, $broadcast_list]) }}" style="display:inline;">
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

<div class="panel panel-default">
    <div class="panel-heading">Messages</div>
    <ul class="list-group">
        @if($person->messages->isEmpty())
            <li class="list-group-item">Aucun message échangé</li>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($person->messages as $message)
            <li class="list-group-item">
                @if ($message->type === 'incoming')
                    <i class="fa fa-reply" aria-hidden="true"></i>
                @endif
                {{ $message->sending->body }}
            </li>
        @endforeach
    </ul>
</div>

@endsection