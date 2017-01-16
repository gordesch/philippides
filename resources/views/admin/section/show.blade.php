@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Administration</a></li>
    <li class="breadcrumb-item"><a href="{{ route('section.index') }}">Sections</a></li>
    <li class="breadcrumb-item active">{{ $section->name }}</li>
</ol>

@endsection

@section('content')

<div class="card">
    <form class="card-block" method="POST" action="{{ route('section.update', [$section]) }}">

        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>

        @include('partials.alerts.errors')

        {{ method_field('PATCH') }}

        @include('admin.section._form', [
            'submitButtonIconClass' => '',
            'submitButtonText' => 'Modifier la section',
        ])
    </form>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-users"></i>
            Utilisateur·rice·s
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @include('admin.user._index')
    </ul>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-phone-square"></i>
            Numéro virtuel
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        @if(!$section->virtual_number)
            <li class="list-group-item">Pas de numéro virtuel associé</li>
            <li class="list-group-item">
                <form method="POST" action="{{ route('section.add_virtual_number', [$section]) }}" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if($virtual_numbers->isEmpty())
                            <select class="form-control" disabled>
                                <option>-- Aucun numéro virtuel disponible --</option>
                            </select>
                        @else
                            <select name="virtual_number_id" class="form-control">
                                @foreach($virtual_numbers as $virtual_number)
                                    <option value="{{ $virtual_number->id }}">
                                        {{ $virtual_number->number }}
                                        ({{ $virtual_number->name }})
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <button
                                type="submit"
                                class="btn btn-secondary"
                                @if($virtual_numbers->isEmpty())
                                    disabled
                                @endif >
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            Associer le numéro virtuel
                        </button>
                    </div>
                </form>
            </li>
        @else
            <li class="list-group-item">
                {{ $section->virtual_number->number }} ({{ $section->virtual_number->name }})
                <a
                    href="{{ route('virtual_number.show', [$section->virtual_number]) }}"
                    class="btn btn-default">
                    Détails
                </a>
                <a
                    href="{{ route('section.delete_virtual_number', [$section]) }}"
                    class="btn btn-danger">
                    Retirer
                </a>
            </li>
        @endif
    </ul>
</div>

@include('partials.modals.delete', [
    'model' => 'section',
    'modelName' => 'section',
    'theModelDeleteText' => 'la',
    'thisModelDeleteText' => 'cette',
])

@endsection