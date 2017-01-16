@extends('layouts.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
        <li class="breadcrumb-item"><a href="{{ route('section.index') }}">Sections</a></li>
        <li class="breadcrumb-item active">Nouvelle section</li>
    </ol>

@endsection

@section('content')

    <div class="card">
        <form class="card-block" method="POST" action="{{ route('section.store') }}">
            {{ csrf_field() }}

            <h4 class="card-title">Nouvelle section</h4>

            @include('admin.section._form', [
                'submitButtonIconClass' => '',
                'submitButtonText' => 'Modifier la section',
            ])
        </form>
    </div>

@endsection