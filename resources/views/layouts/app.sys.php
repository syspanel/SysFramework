<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ APP_NAME }}</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQy3y4MgzA2bK5AqzDiQUf0CkZK4z5rL1tvb5q7F5ixt3CF9aR4kKxJwBvP" crossorigin="anonymous">
    <link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/bootstrap5/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        body {
            padding-top: 56px; /* To prevent content from hiding behind fixed navbar */
        }
        .navbar {
            margin-bottom: 20px;
        }
        footer{
width: 100%;
margin: auto;
bottom: 0;
position: fixed;
}

    </style>
    @stack('styles') <!-- Allows you to push additional CSS styles from child views -->
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">SysFramework</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Logout</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            +Opções
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/example">SysTE Template Engine</a></li>
            <li><a class="dropdown-item" href="/syste">SysTE Testes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/clients">CRUD</a></li>
          </ul>
        </li>
                </ul>
            </div>
        </div>
    </nav>
    

<br>
    

    <!-- Main content -->
    <main role="main" class="container">
        @yield('content')
    </main>

    <br><br><br><br><br>

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3 navbar-fixed-bottom">
        <div class="container mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} SysFramework VS. 1.0 - All rights reserved under the MIT License.</p>
        </div>
    </footer>
    


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76Aq5p9XypTQ6S3yKpQw2FFtnx8t3ev9KeLROtrrKhxtkk54NeDQ9KDvQG8Pntx" crossorigin="anonymous"></script>
    @stack('scripts') <!-- Allows you to push additional JavaScript from child views -->
</body>
</html>


