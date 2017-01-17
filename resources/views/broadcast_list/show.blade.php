@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('broadcast_list.index') }}">Listes de diffusion</a></li>
    <li class="breadcrumb-item active">{{ $broadcast_list->name }}</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('broadcast_list.update', [$broadcast_list]) }}">

        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>

        {{ method_field('PATCH') }}

        @include('broadcast_list._form', [
            'submitButtonIconClass' => '',
            'submitButtonText' => 'Modifier la liste de diffusion',
        ])
    </form>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="block-title">
            <i class="fa fa-fw fa-envelope"></i>
            Envois
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @if($broadcast_list->sendings->isEmpty())
            <li class="list-group-item">Aucun message associé à la liste</li>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($broadcast_list->sendings as $sending)
            <a
                    href="{{ route('sending.show', [$sending] ) }}"
                    class="
            list-group-item list-group-item-action justify-content-between
            @if ($sending->sent)
                            list-group-item-success
                        @else
                            list-group-item-warning
                        @endif
                            "
            >
                {{ $sending->title }}
                @if ($sending->sent)
                    <span class="pull-right badge badge-success">
                Envoyé le {{ $sending->updated_at->format(config('app.datetime.full')) }}
            </span>
                @else
                    <span class="pull-right badge badge-warning">
                Brouillon modifié le {{ $sending->updated_at->format(config('app.datetime.full')) }}
            </span>
                @endif
            </a>
        @endforeach
    </ul>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-address-book"></i>
            Abonné·e·s
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @if($broadcast_list->list_subscribers->isEmpty())
            <li class="list-group-item">Aucun contact abonné</li>
        @endif
        <li class="list-group-item">
            <form method="POST" action="{{ route('broadcast_list.subscribe', [$broadcast_list]) }}" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group">
                    @if($available_list_subscribers->isEmpty())
                        <select class="form-control" disabled>
                            <option>-- Aucun contact disponible --</option>
                        </select>
                    @else
                        <select name="person_id" class="form-control">
                            @foreach($available_list_subscribers as $available_list_subscriber)
                                <option value="{{ $available_list_subscriber->id }}">
                                    {{ $available_list_subscriber->first_name }}
                                    {{ $available_list_subscriber->last_name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="form-group">
                    <button
                            type="submit"
                            class="btn btn-secondary"
                            @if($available_list_subscribers->isEmpty())
                            disabled
                            @endif
                    >
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Abonner à la liste
                    </button>
                </div>
            </form>
        </li>
        @foreach($broadcast_list->list_subscribers as $list_subscriber)
            <li
                class="
                list-group-item
                justify-content-between
                @if ($list_subscriber->mobile_phone_status !== 'valid') list-group-item-danger @endif "
            >
                <span>
                    {{ $list_subscriber->first_name }} {{ $list_subscriber->last_name }}
                    @if ($list_subscriber->mobile_phone_status === 'valid')
                        <span class="badge badge-success">N° de mobile vérifié</span>
                    @elseif ($list_subscriber->mobile_phone_status === 'unknown')
                        <span class="badge badge-warning">N° de mobile non vérifié</span>
                    @elseif ($list_subscriber->mobile_phone_status === 'not_valid')
                        <span class="badge badge-danger">N° de mobile invalide</span>
                    @elseif ($list_subscriber->mobile_phone_status === 'checking')
                        <span class="badge badge-info">N° de mobile en cours de vérification...</span>
                    @endif
                </span>
                <div>
                    <a href="{{ route('person.show', [$list_subscriber] ) }}" class="btn btn-secondary">
                        Détails
                    </a>
                    <form method="POST" action="{{ route('broadcast_list.unsubscribe', [$list_subscriber, $broadcast_list]) }}" style="display:inline;">
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

@include('partials.modals.delete', [
    'model' => 'broadcast_list',
    'modelName' => 'liste de diffusion',
    'theModelDeleteText' => 'la',
    'thisModelDeleteText' => 'cette',
])

@endsection