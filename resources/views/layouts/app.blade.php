<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/dnd-tools.js') }}" ></script>
@yield('js_sources')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
@yield('css_sources')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135391270-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-135391270-1');
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">
                                    <span class="fa fa-home"></span>
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('players*')) active @endif" href="{{ route('players.index') }}">Players</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('pcs*')) active @endif" href="{{ route('pcs.index') }}">PC's</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('parties*')) active @endif"
                                   href="{{ route('parties.index') }}">Parties</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('monsters*')) active @endif" href="{{ route('monsters.index') }}">Monsters</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('encounters*')) active @endif" href="{{ route('encounters.index') }}">Encounters</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('monster_tokens*')) active @endif" href="{{ route('monster_tokens.index') }}">Monster Tokens</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link @if(app('request')->is('modules*')) active @endif" href="{{ route('modules.index') }}">Modules</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->avatar_url != "")
                                        <img src="{!! Auth::user()->avatar_url !!}" class="img-thumbnail" style="width: 32px;">
                                    @else
                                    <img src="/img/players_icon.png" class="img-thumbnail" style="width: 32px;">
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                                    @can('admin')
                                    <a class="dropdown-item" href="{{ route('admin') }}">Admin</a>
                                    @endcan
                                    <a class="dropdown-item" href="#" onclick="showDiceRoller()">Dice Roller</a>
                                    <a class="dropdown-item" href="#" onclick="showSpellSearch()">Spell Search</a>
                                    <a class="dropdown-item" href="{{ route('help') }}">Help</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">@include('common.error')</div>
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">
                This Web site is not affiliated with, endorsed, sponsored, or specifically approved by Wizards of the Coast LLC. This Web site may use the trademarks and other intellectual property of Wizards of the Coast LLC, which is permitted under Wizards' Fan Site Policy. For example, Dungeons & Dragons® is a trademark of Wizards of the Coast. For more information about Wizards of the Coast or any of Wizards' trademarks or other intellectual property, please visit their website at (www.wizards.com).
            </div>
            <div class="small text-center text-muted">Copyright &copy; 2019 - German Kalinec</div>
        </div>
    </footer>
    <!-- Modal -->
    <div class="modal fade" id="global_modal_dialog" tabindex="-1" role="dialog" aria-labelledby="modal_dialog_title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_dialog_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_dialog_body"></div>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
