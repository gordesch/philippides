@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="align-self-center">
            <div class="text-center">
                <i class="fa fa-5x fa-bullhorn" aria-hidden="true"></i><br>
                <h1>Philippidès</h1>
            </div>
            <div class="card">
                <div class="card-block">
                    <div class="card-text">
                        <form role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Adresse e-mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <small class="form-text text-muted">
                                        {{ $errors->first('email') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Mot de passe</label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <small class="form-text text-muted">
                                        {{ $errors->first('password') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remember">
                                    Me connecter automatiquement
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary card-like">
                                    Connexion
                                </button>

                                <a class="btn btn-outline-secondary card-like" href="{{ url('/password/reset') }}">
                                    Mot de passe oublié ?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
