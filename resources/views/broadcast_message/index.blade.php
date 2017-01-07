@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="active">Messages</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <ul class="list-group">
        @if($broadcast_messages->isEmpty())
            <li class="list-group-item">Aucun message pour le moment</li>
        @endif
        <a href="{{ route('broadcast_message.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouveau message
        </a>
        @foreach($broadcast_messages as $broadcast_message)
        <li class="list-group-item">
            {{ $broadcast_message->title }}
            @if ($broadcast_message->sent)
                <span class="label label-success">Envoyé</span>
            @endif
            <a href="{{ route('broadcast_message.show', [$broadcast_message] ) }}" class="btn btn-sm btn-default">
                Détails
            </a>
            <form method="POST" action="{{ route('broadcast_message.destroy', [$broadcast_message]) }}" style="display:inline;">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">
                    Archiver
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

@endsection