<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A webpage to un D&D Encounters">
    <meta name="author" content="German Kalienc">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="/img/d_d_logo.png" style="width: 150px;"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('help') }}">Documentation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><img src="/img/github_logo.png" style="width: 24px;"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Masthead -->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">Dungeons &amp; Dragons Encounters</h1>
                <hr class="divider my-4">
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">A website to help run D&amp;D encounters.</p>
                <a class="btn btn-primary btn-xl" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary btn-xl" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
</header>

<!-- About Section -->
<section class="page-section bg-primary" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">Run D&amp;D Encounters the Easy Way!</h2>
                <hr class="divider light my-4">
                <p class="text-white-50 mb-4">
                    Encounters in Dungeons &amp; Dragons are complicated.  As a DM, you need to keep track of player's initiative, monsters initiative,
                    monsters HP, movement, minis and a whole slew of other things.  I've been a DM for 20+ years and I still sometimes get flustered writing
                    down initiatives, keeping order in my head while paying attention to everything else in the game.  For this reason, I developed a web page and
                    an Android phone app to keep track of these encounter variables.
                </p>
                <h3 class="text-white mt-0">What does this Web App do?</h3>
                <p class="text-white-50 mb-4">
                    This Web App helps you in running encounters.  It has all the SR monsters and spells already loaded, so you can create encounters ahead of time or
                    on the fly and add these monsters to create encounters.  You then start an adventure, enter the party basic stats, and the App does the rest, such
                    as roll monster initiative (either individual monster iniitiative or group), keep track of the monsters/PC turns, give you information about
                    all the monsters on the fly, and even allows you to keep trak of monster's HP!
                </p>
                <h3 class="text-white mt-0">What does this Web App <strong>NOT</strong> do?</h3>
                <p class="text-white-50 mb-4">
                    This app only runs encounters!  It will not generate encounters for you (you can use, instead, <a href="https://kobold.club/fight/">Kobold Fight Club</a>
                    for that), nor will it keep track of XP (use <a href="https://www.adventurersleaguelog.com/">Adventurer's League Logsheets</a> for that), nor will it
                    do any visual maps or tokens of any kind.  This is only meant to run encounters in a live person setting.  The App tries to stay out of the DM's
                    way as much as posible, only providing information that is relevant to the encounter.
                </p>
                <h3 class="text-white mt-0">What do I need to get started?</h3>
                <h4 class="text-white mt-0">Preparation!</h4>
                <p class="text-white-50 mb-4">
                    This App is not an automated program.  It is there to help the DM, which means some preparation is required.  You must enter and build the encounters
                    you would like to run.  It does have features to bundle encounters into modules so that you can group encounters, but all these options must
                    be planned ahead of time.
                <p class="text-white-50 mb-4">
                    Interested? Then click the button below to register!
                </p>
                <a class="btn btn-light btn-xl" href="{{ route('register') }}">Get Started!</a>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">
            This Web site is not affiliated with, endorsed, sponsored, or specifically approved by Wizards of the Coast LLC. This Web site may use the trademarks and other intellectual property of Wizards of the Coast LLC, which is permitted under Wizards' Fan Site Policy. For example, Dungeons & Dragons® is a trademark of Wizards of the Coast. For more information about Wizards of the Coast or any of Wizards' trademarks or other intellectual property, please visit their website at (www.wizards.com).
        </div>
        <div class="small text-center text-muted">Copyright &copy; 2019 - German Kalinec</div>
    </div>
</footer>


<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/creative.min.js"></script>

</body>

</html>
