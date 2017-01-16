@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Envois</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="list-group list-group-flush">
        @if($sendings->isEmpty())
            <div class="list-group-item">Aucun message pour le moment</div>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
            Nouvel envoi
        </a>
        @foreach($sendings as $sending)
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
                <span class="badge badge-success">
                    Envoyé le {{ $sending->updated_at->format(config('app.datetime.full')) }}
                </span>
            @else
                <span class="badge badge-warning">
                    Brouillon modifié le {{ $sending->updated_at->format(config('app.datetime.full')) }}
                </span>
            @endif
        </a>
        @endforeach
    </div>
</div>

@endsection