@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('broadcast_list.index') }}">Listes de diffusion</a></li>
    <li class="breadcrumb-item active">Nouvelle liste de diffusion</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('broadcast_list.store') }}">
        <h4 class="card-title">Nouvelle liste de diffusion</h4>

        @include('broadcast_list._form')
    </form>
</div>

@endsection