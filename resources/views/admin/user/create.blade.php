@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Utilisateur·rice·s</a></li>
    <li class="breadcrumb-item active">Nouvel·le utilisateur·rice</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('user.store') }}">
        {{ csrf_field() }}

        <h4 class="card-title">Nouvel·le utilisateur·rice</h4>

        @include('admin.user._form')
    </form>
</div>

@endsection