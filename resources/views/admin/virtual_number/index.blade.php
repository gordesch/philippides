@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item active">Numéros virtuels</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="list-group list-group-flush">
        @include('admin.virtual_number._index')
    </div>
</div>

@endsection