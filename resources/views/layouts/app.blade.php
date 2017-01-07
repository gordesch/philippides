<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="@yield('page_description')" >

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app" class="">
    <div class="container">
        <nav class="navbar navbar-default navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Afficher le menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    if(!empty(Request::segments())) {
                        if(Request::segments()[0] === 'person') {
                            echo '<li class="active">';
                        } else {
                            echo '<li>';
                        }
                    } else {
                        echo '<li>';
                    }
                    ?>
                    <a href="{{ route('person.index') }}">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        Contacts
                    </a>
                    </li>
                    <?php
                    if(!empty(Request::segments())) {
                        if(Request::segments()[0] === 'broadcast_list') {
                            echo '<li class="active">';
                        } else {
                            echo '<li>';
                        }
                    } else {
                        echo '<li>';
                    }
                    ?>
                    <a href="{{ route('broadcast_list.index') }}">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                        Listes
                    </a>
                    </li>
                    <?php
                    if(!empty(Request::segments())) {
                        if(Request::segments()[0] === ('broadcast_message')) {
                            echo '<li class="active">';
                        } else {
                            echo '<li>';
                        }
                    } else {
                        echo '<li>';
                    }
                    ?>
                    <a href="{{ route('broadcast_message.index') }}">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        Messages
                    </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" class="">Se connecter</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Se déconnecter
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        @if(Session::has('flash_message'))
            <div class="alert alert-{{ Session::get('flash_message_type') }} fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer" title="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if(Session::get('flash_message_type') === 'success')
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                @elseif(Session::get('flash_message_type') === 'danger')
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                @elseif(Session::get('flash_message_type') === 'warning')
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                @elseif(Session::get('flash_message_type') === 'info')
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                @endif
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @yield('content')

    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ elixir('js/all.js') }}"></script>
</body>
</html>
