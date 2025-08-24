<!DOCTYPE html>
<html>
<head>
    <title>Blade Layout</title>
</head>
<body>
    <header>
        <h1>Meu Site</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Rodapé do Site</p>
    </footer>
</body>
</html>
