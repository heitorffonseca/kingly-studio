<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prova Prática Kingly Studio</title>

    <link rel="shortcut icon" href="{{ url('assets/images/layout/favicon.png?v=2') }}">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />

    <!-- FONTS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/mask.js') }}"></script>
    <script defer src="{{ asset('assets/js/main.js') }}"></script>

</head>

<body class="pages register-page">
<header>
    <div class="container">
        <a href="#" class="logo">
            Logo
        </a>
        <h1>Cadastro</h1>
    </div>
</header>

<main>
    @yield('content')
</main>
<footer>
    <nav>
        <div class="container">
            <ul>
                <li><a href="#">Regulamento</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Fale Conosco</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sair</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </nav>
    <section id="copyright">
        <div class="container">
            <h2>Assinatura genérica</h2>
        </div>
    </section>
</footer>
</body>
</html>
