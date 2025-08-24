<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MVC PHP Framework desenvolvido com uma estrutura robusta e modular para fornecer uma base sólida para a criação de aplicações web escaláveis e produtivas.">
    <meta name="author" content="SysFramework">
    <title>SysFramework</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">

    

    <!-- Bootstrap core CSS -->
<link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/bootstrap5/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
    </style>

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="{{ asset('/assets/bootstrap5/img/s.png') }}" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>SysFramework</title>
        <span class="fs-4">SysFramework</span>
      </a>
    </header>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    
    
    
    
    

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">SysFramework</h1>
        <p class="col-md-8 fs-4"><p>Este projeto é um framework PHP personalizado, desenvolvido com uma estrutura robusta e modular.
            <br> O objetivo principal desta aplicação é fornecer uma base sólida
            para a criação de aplicações web escaláveis e produtivas.</p> 
<p></p>
<p></p> 
 <a href="/clients"><button class="btn btn-primary btn-lg" type="button">Exemplo de CRUD</button></a>        
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
          <h2>Características:</h2>
            <p>Middlewares, proteção CSRF, XSS e outras.</p>
            <p>Estrutura MVC de alto nivel.</p>
            <p>SysCli - Ferramenta de linha de comando para interagir com o framework.</p>      
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Contato:</h2>
          <p></p>
          <p><a href="mailto:marcocosta@gmx.com">marcocosta@gmx.com</a></p>
          
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2025 SysFramework Versão 1.0 Todos os direitos reservados
    </footer>
  </div>
</main>


    
  </body>
</html>
