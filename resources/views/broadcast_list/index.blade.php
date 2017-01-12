@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="active">Listes de diffusion</li>
</ol>

@endsection

@section('content')

<div class="panel panel-default">
    <div class="list-group">
        @if($broadcast_lists->isEmpty())
            <div class="list-group-item">Aucune liste créée pour le moment</div>
        @endif
        <a href="{{ route('broadcast_list.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Nouvelle liste
        </a>
        @foreach($broadcast_lists as $broadcast_list)
            <a href="{{ route('broadcast_list.show', [$broadcast_list] ) }}" class="list-group-item">
                {{ $broadcast_list->name }}
                <span class="pull-right label label-default">
                    {{ $broadcast_list->list_subscribers()->count() }} abonnés
                </span>
            </a>
        @endforeach
    </div>
</div>

@endsection