@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="active">Envois</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="list-group">
        @if($sendings->isEmpty())
            <div class="list-group-item">Aucun message pour le moment</div>
        @endif
        <a href="{{ route('sending.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouvel envoi
        </a>
        @foreach($sendings as $sending)
        <a
            href="{{ route('sending.show', [$sending] ) }}"
            class="
                list-group-item
                @if ($sending->sent)
                    list-group-item-success
                @else
                    list-group-item-warning
                @endif
            "
        >
            {{ $sending->title }}
            @if ($sending->sent)
                <span class="pull-right label label-success">
                    Envoyé le {{ $sending->updated_at->format(config('app.datetime.full')) }}
                </span>
            @else
                <span class="pull-right label label-warning">
                    Brouillon modifié le {{ $sending->updated_at->format(config('app.datetime.full')) }}
                </span>
            @endif
        </a>
        @endforeach
    </div>
</div>

@endsection