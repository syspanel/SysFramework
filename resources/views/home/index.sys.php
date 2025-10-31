<?php
use Core\SysLocale;
?>

<!doctype html>
<html lang="<?= substr(SysLocale::getLocale(), 0, 2) ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="SysFramework - MVC PHP Framework modular e escalável">
  <meta name="author" content="SysFramework">
  <title>SysFramework</title>

  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link href="/assets/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  <script src="/assets/bootstrap5/js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      scroll-behavior: smooth;
    }
    .hero {
      background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
      color: white;
      padding: 100px 0;
      text-align: center;
    }
    .feature-card {
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .icon {
      font-size: 2.5rem;
      color: #4e73df;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="{{ asset('/assets/bootstrap5/img/s.png') }}" width="40" height="32" class="me-2">
      <span>SysFramework</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="/"><?= SysLocale::t('home'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="/userguide"><?= SysLocale::t('userguide'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="/register"><?= SysLocale::t('register'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="/login"><?= SysLocale::t('login'); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/dashboard"><?= SysLocale::t('dashboard'); ?></a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown">
            <?= SysLocale::t('more'); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="moreDropdown">
            <li><a class="dropdown-item" href="/example"><?= SysLocale::t('sysTE_example'); ?></a></li>
            <li><a class="dropdown-item" href="/syste"><?= SysLocale::t('sysTE_tests'); ?></a></li>
            <li><a class="dropdown-item" href="/systables"><?= SysLocale::t('sysTables'); ?></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/clients"><?= SysLocale::t('crud_example'); ?></a></li>
          </ul>
        </li>

        <li>
          <div class="language-switcher">
              <a href="/setLocale/pt_BR">🇧🇷</a>
              <a href="/setLocale/en_US">🇺🇸</a>
              <a href="/setLocale/es_ES">🇪🇸</a>
              <a href="/setLocale/fr_FR">🇫🇷</a>
              <a href="/setLocale/de_DE">🇩🇪</a>
          </div>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1 class="display-4 fw-bold"><?= SysLocale::t('hero_title'); ?></h1>
    <p class="lead mb-4"><?= SysLocale::t('hero_description'); ?></p>
    <a href="/clients" class="btn btn-lg btn-light shadow me-2"><?= SysLocale::t('hero_btn_crud'); ?></a>
    <a href="https://github.com/syspanel/SysFramework" target="_blank" class="btn btn-lg btn-outline-light">
      <i class="bi bi-github me-1"></i> <?= SysLocale::t('hero_btn_github'); ?>
    </a>
  </div>
</section>

<!-- Features -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="card feature-card p-4 h-100">
          <div class="mb-3"><i class="bi bi-shield-lock icon"></i></div>
          <h5><?= SysLocale::t('feature_security'); ?></h5>
          <p><?= SysLocale::t('feature_security_desc'); ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card feature-card p-4 h-100">
          <div class="mb-3"><i class="bi bi-diagram-3 icon"></i></div>
          <h5><?= SysLocale::t('feature_mvc'); ?></h5>
          <p><?= SysLocale::t('feature_mvc_desc'); ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card feature-card p-4 h-100">
          <div class="mb-3"><i class="bi bi-terminal icon"></i></div>
          <h5><?= SysLocale::t('feature_syscli'); ?></h5>
          <p><?= SysLocale::t('feature_syscli_desc'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About & Contact -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <h2><?= SysLocale::t('about_title'); ?></h2>
        <ul>
          <li><?= SysLocale::t('about_list_1'); ?></li>
          <li><?= SysLocale::t('about_list_2'); ?></li>
          <li><?= SysLocale::t('about_list_3'); ?></li>
          <li><?= SysLocale::t('about_list_4'); ?></li>
          <li><?= SysLocale::t('about_list_5'); ?></li>
        </ul>
      </div>
      <div class="col-md-6">
        <h2><?= SysLocale::t('contact_title'); ?></h2>
        <p><?= SysLocale::t('contact_text'); ?></p>
        <p><a href="mailto:<?= SysLocale::t('contact_email'); ?>"><?= SysLocale::t('contact_email'); ?></a></p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-dark text-white text-center">
  &copy; <?= date('Y'); ?> <?= SysLocale::t('footer_license'); ?> |
  <a href="https://opensource.org/licenses/MIT" target="_blank" class="text-white"><?= SysLocale::t('footer_license'); ?></a>
  <br><br>
  <a href="https://github.com/syspanel/SysFramework" target="_blank" class="text-white me-3">
    <i class="bi bi-github"></i> <?= SysLocale::t('footer_github'); ?>
  </a>
  <a href="https://www.paypal.com/donate/?business=marcocosta@gmx.com&currency_code=USD" target="_blank">
    <img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="<?= SysLocale::t('footer_donate'); ?>">
  </a>
</footer>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>


