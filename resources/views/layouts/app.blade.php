<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="@yield('page_description')" >

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        body {
            padding-top: 4.5rem;
            padding-bottom: 6.5rem;
            background: #f5f5f5;
        }
        .nav > li {
            text-align: center;
        }
        .card, .card-like{
            margin-bottom: 1rem;
        }
        .breadcrumb {
            margin-bottom: 0;
        }
        .in {
            opacity: 1;
        }
        #category-nav .pagination {

        }
    </style>
</head>
<body>
    @if(Auth::check())
        <div class="container-fluid fixed-top" style="background: #444">
            <div class="row align-items-center justify-content-between p-2" style="background: #444">
                <a href="{{ route('welcome') }}" class="navbar-brand" style="color: #f5f5f5; padding: 0; margin: 0;">
                    <h6 class="p-2 m-0">
                        <i class="fa fa-fw fa-bullhorn"></i>
                        Philippidès
                    </h6>
                </a>
                <div class="dropdown text-right">
                    <button class="btn btn-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="margin-top: .5rem;">
                        <span class="dropdown-header">
                            {{ session('user')->name }}<br/>
                            (<em>{{ session('user')->section->name }}</em>)
                        </span>
                        <a class="dropdown-item" href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Se déconnecter
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <div class="dropdown-divider"></div>
                        @if(session('user')->role->type === 'admin')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                Panneau d'administration
                            </a>
                        @endif
                        @if(session('user')->role->scope !== 'section')
                            <a class="dropdown-item" href="#">
                                Changer de section
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <?php $is_admin = (!empty(Request::route()->getPrefix()) ? true : false) ?>

        @if(!$is_admin)
            <nav id="category-nav" class="fixed-bottom" style="background: white;">
                <?php $is_category = (!empty(Request::segments()) ? true : false) ?>
                <hr style="margin:0;">
                <ul class="pagination m-2">
                    <li class="w-100 page-item @if($is_category && Request::segments()[0] === 'person') active @endif ">
                        <a class="page-link text-center" href="{{ route('person.index') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i><br/>
                            Contacts
                        </a>
                    </li>
                    <li class="w-100 page-item @if($is_category && Request::segments()[0] === 'broadcast_list') active @endif "">
                        <a class="page-link text-center" href="{{ route('broadcast_list.index') }}">
                            <i class="fa fa-list-ul" aria-hidden="true"></i><br/>
                            Listes
                        </a>
                    </li>
                    <li class="w-100 page-item @if($is_category && Request::segments()[0] === 'sending') active @endif "">
                        <a class="page-link text-center" href="{{ route('sending.index') }}">
                            <i class="fa fa-envelope" aria-hidden="true"></i><br/>
                            Envois
                        </a>
                    </li>

                </ul>
            </nav>
        @else
            <nav id="category-nav" class="fixed-bottom" style="background: white;">
                <?php $is_category = (!empty(Request::segments()[1]) ? true : false) ?>
                <hr style="margin:0;">
                <ul class="pagination m-2">
                    <li class="w-100 page-item @if($is_category && Request::segments()[1] === 'user') active @endif ">
                        <a class="page-link text-center" href="{{ route('user.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i><br/>
                            Utilisateur·rice·s
                        </a>
                    </li>
                    <li class="w-100 page-item @if($is_category && Request::segments()[1] === 'section') active @endif "">
                        <a class="page-link text-center" href="{{ route('section.index') }}">
                            <i class="fa fa-sitemap" aria-hidden="true"></i><br/>
                            Sections
                        </a>
                    </li>
                    <li class="w-100 page-item @if($is_category && Request::segments()[1] === 'virtual_number') active @endif "">
                        <a class="page-link text-center" href="{{ route('virtual_number.index') }}">
                            <i class="fa fa-phone-square" aria-hidden="true"></i><br/>
                            Numéros<span class="hidden-sm-down"> virtuels</span>
                        </a>
                    </li>

                </ul>
            </nav>
        @endif

    @endif

    <div class="container" id="app">

        @if(Auth::check())

            <div class="card">
                @yield('breadcrumb')
            </div>
        @endif

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

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>
