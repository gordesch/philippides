@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('person.index') }}">Contacts</a></li>
    <li class="breadcrumb-item active">{{ $person->first_name }} {{ $person->last_name }}</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>
        <form method="POST" action="{{ route('person.update', [$person]) }}">
            {{ method_field('PATCH') }}

            @include('person._form', [
                'submitButtonIconClass' => '',
                'submitButtonText' => 'Modifier le contact',
            ])
        </form>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-list-ul"></i>
            Inscriptions à des listes de diffusion
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @if($person->broadcast_lists->isEmpty())
            <li class="list-group-item">Contact abonné à aucune liste</li>
        @endif
        <li class="list-group-item">
            <form method="POST" action="{{ route('person.subscribe', [$person]) }}" class="form-inline">
                {{ csrf_field() }}
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
                        class="btn btn-secondary"
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
        <li class="list-group-item justify-content-between">
            {{ $broadcast_list->name }}
            <div>
                <a href="{{ route('broadcast_list.show', [$broadcast_list]) }}" class="btn btn-secondary">
                    Détails de la liste
                </a>
                <form method="POST" action="{{ route('person.unsubscribe', [$person, $broadcast_list]) }}" style="display:inline;">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">
                        Désinscrire
                    </button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-envelope"></i>
            Messages
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @if($person->messages->isEmpty())
            <li class="list-group-item">Aucun message échangé</li>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($person->messages as $message)
            <li class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">
                        De <code>
                        @if($message->type === 'incoming')
                            <i class="fa fa-fw fa-address-card" aria-hidden="true"></i>
                            {{ $message->senderable->first_name }}
                            {{ $message->senderable->last_name }}
                        @elseif($message->type === 'outgoing')
                            <i class="fa fa-fw fa-bullhorn" aria-hidden="true"></i>
                            {{ $message->senderable->name }}
                        @endif
                        </code>
                    </h6>
                    <small class="text-muted">{{ $message->updated_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">
                    {{ $message->sending->body }}
                </p>
            </li>
        @endforeach
    </ul>
</div>

@include('partials.modals.delete', [
    'model' => 'person',
    'modelName' => 'contact',
    'theModelDeleteText' => 'le',
    'thisModelDeleteText' => 'ce',
])

@endsection