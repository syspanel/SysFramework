<?php

use App\Controllers;
use App\Middlewares;
use Core\SysLogger;
use Core\SysRouter;
use App\Controllers\ProdutoController;
use App\Controllers\LocaleController;
use App\Middlewares\AuthMiddleware;

/**
 * -------------------------------------------------------------
 * Define public and admin routes for the SysFramework app
 * -------------------------------------------------------------
 */

SysRouter::get('/setLocale/{lang}', 'App\Controllers\LocaleController@setLocale')->name('locale.setLocale');


// -----------------------
// Public routes
// -----------------------
SysRouter::get('/', '\App\Controllers\HomeController@index')->name('home.index');
SysRouter::get('/example', '\App\Controllers\HomeController@example')->name('home.example');
SysRouter::get('/syste', '\App\Controllers\HomeController@syste')->name('home.syste');
SysRouter::get('/systables', '\App\Controllers\HomeController@systables')->name('home.systables');
SysRouter::get('/userguide', '\App\Controllers\HomeController@userguide')->name('home.userguide');


// -----------------------
// Client routes (grouped with prefix)
// -----------------------
SysRouter::group(['prefix' => '/clients'], function () {
    SysRouter::get('/', '\App\Controllers\ClientController@index')->name('clients.index');
    SysRouter::get('/create', '\App\Controllers\ClientController@create')->name('clients.create');
    SysRouter::post('/', '\App\Controllers\ClientController@store')->name('clients.store');
    SysRouter::get('/edit/{id}', '\App\Controllers\ClientController@edit')->name('clients.edit');
    SysRouter::put('/update/{id}', '\App\Controllers\ClientController@update')->name('clients.update');
    SysRouter::get('/show/{id}', '\App\Controllers\ClientController@show')->name('clients.show');
    SysRouter::get('/delete/{id}', '\App\Controllers\ClientController@delete')->name('clients.delete');
});

// -----------------------
// Admin routes (protected by AuthMiddleware)
// -----------------------
SysRouter::group(['prefix' => '/admin', 'middleware' => [AuthMiddleware::class]], function () {
    SysRouter::get('/', '\App\Controllers\AdminController@dashboard')->name('admin.dashboard');
    SysRouter::get('/dashboard', '\App\Controllers\AdminController@dashboard')->name('admin.dashboard');
    SysRouter::get('/users', '\App\Controllers\AdminController@users')->name('admin.users');
    SysRouter::get('/settings', '\App\Controllers\AdminController@settings')->name('admin.settings');
    SysRouter::get('/buttons', '\App\Controllers\AdminController@buttons')->name('admin.buttons');
    SysRouter::get('/cards', '\App\Controllers\AdminController@cards')->name('admin.cards');
    SysRouter::get('/utilities_color', '\App\Controllers\AdminController@utilities_color')->name('admin.utilities_color');
    SysRouter::get('/utilities_border', '\App\Controllers\AdminController@utilities_border')->name('admin.utilities_border');
    SysRouter::get('/utilities_animation', '\App\Controllers\AdminController@utilities_animation')->name('admin.utilities_animation');
    SysRouter::get('/utilities_other', '\App\Controllers\AdminController@utilities_other')->name('admin.utilities_other');
    SysRouter::get('/blank', '\App\Controllers\AdminController@blank')->name('admin.blank');
    SysRouter::get('/charts', '\App\Controllers\AdminController@charts')->name('admin.charts');
    SysRouter::get('/tables', '\App\Controllers\AdminController@tables')->name('admin.tables');
});

// -----------------------
// Authentication routes
// -----------------------
SysRouter::get('/register', '\App\Controllers\AuthController@register')->name('auth.register');
SysRouter::post('/newregister', '\App\Controllers\AuthController@newregister')->name('auth.newregister');
SysRouter::get('/registred', '\App\Controllers\AuthController@registred')->name('auth.registred');
SysRouter::get('/confirm_email', '\App\Controllers\AuthController@confirm_email')->name('auth.confirm_email');
SysRouter::get('/login', '\App\Controllers\AuthController@login')->name('auth.login');
SysRouter::post('/gologin', '\App\Controllers\AuthController@gologin')->name('auth.gologin');
SysRouter::get('/confirmemail', '\App\Controllers\AuthController@confirmemail')->name('auth.confirmemail');
SysRouter::get('/goconfirmemail', '\App\Controllers\AuthController@goconfirmemail')->name('auth.goconfirmemail');
SysRouter::post('/send_resetlink', '\App\Controllers\AuthController@sendResetLink')->name('auth.send_resetlink');
SysRouter::get('/forgot_password', '\App\Controllers\AuthController@forgotPassword')->name('auth.forgot_password');
SysRouter::get('/reset_password', '\App\Controllers\AuthController@resetPassword')->name('auth.reset_password');
SysRouter::post('/goreset_password', '\App\Controllers\AuthController@goresetPassword')->name('auth.goreset_password');
SysRouter::get('/resend_confirmation', '\App\Controllers\AuthController@resendConfirmation')->name('auth.resend_confirmation');
SysRouter::post('/goresend_confirmation', '\App\Controllers\AuthController@goresendConfirmation')->name('auth.goresend_confirmation');
SysRouter::get('/logout', '\App\Controllers\AuthController@logout')->name('auth.logout');

// -----------------------
// Static files route (serves assets manually)
// -----------------------
SysRouter::get('/assets/{path}', function ($path) {
    $file = __DIR__ . '/../public/assets/' . $path;
    if (file_exists($file)) {
        header('Content-Type: ' . mime_content_type($file));
        readfile($file);
        exit;
    }
    http_response_code(404);
    echo "File not found.";
});

// -----------------------
// Error 404 handler
// -----------------------
SysRouter::error(function () {
    $logger = new SysLogger();
    $currentUrl = $_SERVER['REQUEST_URI'] ?? 'unknown';

    // Skip logging for static resources
    if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/i', $currentUrl)) {
        http_response_code(404);
        echo "File not found.";
        exit;
    }

    // Log the 404 error with the current URL
    $logger->warning("{$currentUrl} - Page not found.");

    // Render custom 404 page
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="/assets/styles.css">
<style>
body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; text-align: center; padding: 50px; }
.container { max-width: 600px; margin: 0 auto; }
h1 { font-size: 3em; margin-bottom: 20px; }
p { font-size: 1.2em; margin-bottom: 20px; }
.button { display: inline-block; padding: 10px 20px; font-size: 1em; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px; }
.button:hover { background-color: #0056b3; }
</style>
</head>
<body>
    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p>Sorry, the page you are looking for could not be found.</p>
        <a href="/" class="button">Back to Home</a>
    </div>
</body>
</html>
';
});
