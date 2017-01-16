@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sending.index') }}">Envois</a></li>
    <li class="breadcrumb-item active">Nouvel envoi</li>
</ol>

@endsection

@section('content')

@include('partials.alerts.errors')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('sending.store') }}">

        <h4 class="card-title">Nouvel envoi</h4>

        @include('sending._form')

    </form>
</div>

@endsection