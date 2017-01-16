@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Listes de diffusion</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="list-group list-group-flush">
        @if($broadcast_lists->isEmpty())
            <div class="list-group-item">Aucune liste créée pour le moment</div>
        @endif
        <a href="{{ route('broadcast_list.create') }}" class="list-group-item list-group-item-info">
            <i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
            Nouvelle liste
        </a>
        @foreach($broadcast_lists as $broadcast_list)
            <a href="{{ route('broadcast_list.show', [$broadcast_list] ) }}" class="list-group-item list-group-item-action justify-content-between">
                {{ $broadcast_list->name }}
                <span class="pull-right badge badge-default">
                    {{ $broadcast_list->list_subscribers()->count() }} abonné·e·s
                </span>
            </a>
        @endforeach
    </div>
</div>

@endsection