@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li><a href="{{ route('broadcast_message.index') }}">Messages</a></li>
    <li class="active">{{ $broadcast_message->title }}</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Informations</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('broadcast_message.update', [$broadcast_message]) }}">
            @include('partials.alerts.errors')
            
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="{{ old('title', $broadcast_message->title) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Corps du message</label>
                <textarea 
                    pattern="@£$¥èéùìòÇ\fØø\nÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\x22#¤%&'()*+,-./[0-9]:;<=>\?¡[A-Z]ÄÖÑÜ§¿[a-z]äöñüà\^\{\}\[~\]\|€"
                    name="body"
                    class="form-control"
                >{{ old('body', $broadcast_message->body) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    Modifier le message
                </button>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Envoi et destinataires</div>
    @if($broadcast_message->sent)
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
    <form method="POST" action="{{ route('broadcast_message.send', [$broadcast_message]) }}" style="display:inline;">
        {{ method_field('POST') }}
        {{ csrf_field() }}
        <ul class="list-group">
            @foreach ($broadcast_lists as $broadcast_list)
                <li class="list-group-item">
                    <div class="checkbox">
                        <label>
                            <input
                                    type="checkbox"
                                    name="broadcast_lists_ids[]"
                                    value="{{ $broadcast_list->id }}"
                            >
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
                                {{ $person->last_name }} {{ $person->first_name }}
                            </label>
                        </div>

                    </li>
                @endforeach
        </ul>
        <div class="panel-body">
            <button type="submit" class="btn btn-primary">
                Envoyer
            </button>
        </div>
    </form>
    @endif
</div>


    
@endsection