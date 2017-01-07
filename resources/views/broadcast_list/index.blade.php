@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="active">Listes de diffusion</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <ul class="list-group">
        @if($broadcast_lists->isEmpty())
            <li class="list-group-item">Aucun liste créée pour le moment</li>
        @endif
        <a href="{{ route('broadcast_list.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouvelle liste
        </a>
        @foreach($broadcast_lists as $broadcast_list)
        <li class="list-group-item">
            {{ $broadcast_list->name }} 
            <a href="{{ route('broadcast_list.show', [$broadcast_list]) }}" class="btn btn-sm btn-default">
                Détails
            </a>
            <form method="POST" action="{{ route('broadcast_list.destroy', [$broadcast_list]) }}" style="display:inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">
                    Supprimer
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

@endsection