@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('sending.index') }}">Envois</a></li>
    <li class="active">{{ $sending->title }}</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Informations</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('sending.update', [$sending]) }}">
            @include('partials.alerts.errors')
            
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="{{ old('title', $sending->title) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Corps du message</label>
                <textarea 
                    pattern="@£$¥èéùìòÇ\fØø\nÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\x22#¤%&'()*+,-./[0-9]:;<=>\?¡[A-Z]ÄÖÑÜ§¿[a-z]äöñüà\^\{\}\[~\]\|€"
                    name="body"
                    class="form-control"
                >{{ old('body', $sending->body) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    Modifier le message
                </button>
            </div>
        </form>
    </div>
</div>
<form method="POST" action="{{ route('sending.send', [$sending]) }}" style="display:inline;">
    <div class="panel panel-default">
        <div class="panel-heading">Envoi et destinataires</div>
        @if($sending->sent)
            <ul class="list-group">
                @foreach ($messages as $message)
                    <li class="list-group-item">
                        {{ $message->recipientable->first_name }}
                        {{ $message->recipientable->last_name }}
                        @if ($message->status === 'pending')
                            <span class="label label-info">En cours d'envoi...</span>
                        @elseif ($message->status === 'sent')
                            <span class="label label-success">Envoyé</span>
                        @elseif ($message->status === 'error')
                            <span class="label label-danger">Envoi en erreur</span>
                        @endif
                        {{ $message->updated_at }}
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="list-group">
                {{ method_field('POST') }}
                {{ csrf_field() }}

                @foreach ($broadcast_lists as $broadcast_list)
                    <li class="list-group-item">
                        <div class="checkbox">
                            <label>
                                <input
                                        type="checkbox"
                                        name="broadcast_lists_ids[]"
                                        value="{{ $broadcast_list->id }}"
                                >
                                <i class="fa fa-list-ul"></i>
                                {{ $broadcast_list->name }}
                            </label>
                        </div>
                    </li>
                @endforeach
                @foreach ($people as $person)
                    <li class="list-group-item">
                        <div class="checkbox">
                            <label>
                                <input
                                        type="checkbox"
                                        name="people_ids[]"
                                        value="{{ $person->id }}"
                                >
                                <i class="fa fa-user"></i>
                                {{ $person->last_name }} {{ $person->first_name }}
                            </label>
                        </div>

                    </li>
                @endforeach
                <li class="list-group-item">
                    <button type="submit" class="btn btn-primary">
                        Envoyer
                    </button>
                </li>
            </ul>
        @endif
    </div>
</form>

<form method="POST" action="{{ route('sending.destroy', [$sending]) }}" style="display:inline;">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-block btn-danger">
        Supprimer le message
    </button>
</form>

    
@endsection