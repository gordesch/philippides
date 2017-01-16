@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item"><a href="{{ route('virtual_number.index') }}">Numéros virtuels</a></li>
    <li class="breadcrumb-item active">Nouveau numéro virtuel</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('virtual_number.store') }}">
        <h4 class="card-title">Nouveau numéro virtuel</h4>

        @include('admin.virtual_number._form')
    </form>
</div>

@endsection