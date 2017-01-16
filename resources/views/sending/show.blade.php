@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sending.index') }}">Envois</a></li>
    <li class="breadcrumb-item active">{{ $sending->title }}</li>
</ol>

@endsection

@section('content')

<div class="card">
    <div class="card-block">
        <h4 class="card-title">
            <i class="fa fa-fw fa-info-circle"></i>
            Informations
        </h4>
        <form method="POST" action="{{ route('sending.update', [$sending]) }}">
            {{ method_field('PATCH') }}

            @include('sending._form', [
                'submitButtonIconClass' => '',
                'submitButtonText' => 'Modifier l\'envoi',
            ])

        </form>
    </div>
</div>

<form method="POST" action="{{ route('sending.send', [$sending]) }}" style="display:inline;">
    {{ method_field('POST') }}
    {{ csrf_field() }}

    <div class="card">
        <div class="card-block">
            <h4 class="card-title">
                <i class="fa fa-fw fa-address-book"></i>
                Destinataires
            </h4>
        </div>

        @if($sending->sent)
            <ul class="list-group list-group-flush">
                @foreach ($messages as $message)
                    <li class="list-group-item">
                        {{ $message->recipientable->first_name }}
                        {{ $message->recipientable->last_name }}
                        @if ($message->status === 'pending')
                            <span class="label label-info">En cours d'envoi...</span>
                        @elseif ($message->status === 'sent')
                            <span class="label label-success">Envoyé</span>
                        @elseif ($message->status === 'error')
                            <span class="label label-danger">Envoi en erreur</span>
                        @endif
                        {{ $message->updated_at }}
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="list-group list-group-flush">
                @foreach ($broadcast_lists as $broadcast_list)
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="broadcast_list_ids[]"
                                        value="{{ $broadcast_list->id }}"
                                >
                                <i class="fa fa-list-ul"></i>
                                {{ $broadcast_list->name }}
                            </label>
                        </div>
                    </li>
                @endforeach
                @foreach ($people as $person)
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="person_ids[]"
                                        value="{{ $person->id }}"
                                >
                                <i class="fa fa-address-card"></i>
                                {{ $person->last_name }} {{ $person->first_name }}
                            </label>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <button type="submit" class="btn btn-lg btn-block btn-primary card-like">
        Envoyer <em>via</em> <i class="fa fa-w fa-bullhorn"></i> Philippidès
    </button>
    <!--
    <a class="btn btn-lg btn-block btn-primary card-like" href="sms://open?addresses={+33645645084},{+33645645084}&body=iOS Message">
        Envoyer <em>via</em> <i class="fa fa-fw fa-apple"></i> SMS
    </a>

    <a class="btn btn-lg btn-block btn-primary card-like" href="sms://+33645645084,+33684949338?body=Android Message">
        Envoyer <em>via</em> <i class="fa fa-fw fa-android"></i> SMS
    </a>
    !-->
</form>

@include('partials.modals.delete', [
    'model' => 'sending',
    'modelName' => 'envoi',
    'theModelDeleteText' => 'l\'',
    'thisModelDeleteText' => 'cet',
])

@endsection