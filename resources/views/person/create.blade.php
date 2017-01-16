@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('person.index') }}">Contacts</a></li>
    <li class="breadcrumb-item active">Nouveau contact</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('person.store') }}">

        <h4 class="card-title">Nouveau contact</h4>

        @include('person._form')

    </form>
</div>

@endsection