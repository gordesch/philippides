@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item active">Utilisateur·rice·s</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="list-group list-group-flush">
        @include('admin.user._index')
    </div>
</div>

@endsection