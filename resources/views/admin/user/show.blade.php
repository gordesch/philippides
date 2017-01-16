@extends('layouts.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Utilisateur·rice·s</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('user.update', [$user]) }}">

        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>

        {{ method_field('PATCH') }}

        @include('admin.user._form', [
            'submitButtonIconClass' => '',
            'submitButtonText' => 'Modifier l\'utilisateur·rice',
        ])
    </form>
</div>

@include('partials.modals.delete', [
    'model' => 'user',
    'modelName' => 'utilisateur·ice',
    'theModelDeleteText' => 'le·la',
    'thisModelDeleteText' => 'cet·te',
])

@endsection