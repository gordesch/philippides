@extends('layouts.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
        <li class="breadcrumb-item active">Sections</li>
    </ol>

@endsection

@section('content')

    <div class="card">
        <div class="list-group list-group-flush">
            @include('admin.section._index')
        </div>
    </div>

@endsection