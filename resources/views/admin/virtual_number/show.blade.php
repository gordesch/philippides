@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item"><a href="{{ route('virtual_number.index') }}">Numéro virtuels</a></li>
    <li class="breadcrumb-item active">{{ $virtual_number->name }}</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('virtual_number.update', [$virtual_number]) }}">

        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>

        {{ method_field('PATCH') }}

        @include('admin.virtual_number._form', [
            'submitButtonIconClass' => '',
            'submitButtonText' => 'Modifier le numéro virtuel',
        ])
    </form>
</div>

@include('partials.modals.delete', [
    'model' => 'virtual_number',
    'modelName' => 'numéro virtuel',
    'theModelDeleteText' => 'le',
    'thisModelDeleteText' => 'ce',
])

@endsection