<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/


use Core\SysSanitize;
use Core\SysLogger;
use Core\SysRouter;
use Core\SysTE;
use Core\SysLocale;
use Core\Library\Session;
use App\Middlewares\SysLocaleMiddleware;
use App\Services\SomeService;
use App\Services\AnotherService;

/**
 * -------------------------------------------------------------------------
 * Locale Middleware
 * -------------------------------------------------------------------------
 * Execute the SysLocaleMiddleware at the very beginning to ensure that the
 * application always has the correct locale set before any controller,
 * view, or translation function is called. This is crucial for multilingual
 * support and for functions like SysLocale::t().
 */
SysLocaleMiddleware::handle();

/**
 * -------------------------------------------------------------------------
 * Current Locale
 * -------------------------------------------------------------------------
 * Retrieve the current locale after middleware execution. Any controller,
 * view, or service that needs to access the current language should
 * reference SysLocale::getLocale().
 */
$lang = SysLocale::getLocale();

/**
 * -------------------------------------------------------------------------
 * Load helpers and configuration files
 * -------------------------------------------------------------------------
 * helpers.php       -> custom global helper functions (e.g., asset(), route())
 * paths.php         -> returns array with system paths for assets, views, etc.
 * loadenv.php       -> loads environment variables from .env file
 * settings.php      -> application-wide configuration and constants
 */
require_once dirname(__DIR__) . '/config/helpers.php';
$paths = require dirname(__DIR__) . '/config/paths.php';
require_once dirname(__DIR__) . '/config/loadenv.php';
require_once dirname(__DIR__) . '/config/settings.php';

/**
 * -------------------------------------------------------------------------
 * Input Sanitization
 * -------------------------------------------------------------------------
 * Run middleware to sanitize all incoming HTTP request data to prevent
 * XSS, SQL injection, and other malicious input attacks. This ensures
 * a safer application environment.
 */
sanitizeMiddleware();

/**
 * -------------------------------------------------------------------------
 * Routing Setup
 * -------------------------------------------------------------------------
 * Load all web routes from routes/web.php.
 * SysRouter will map URIs to controller methods.
 */
require dirname(__DIR__) . '/routes/web.php';

/**
 * -------------------------------------------------------------------------
 * Request Information
 * -------------------------------------------------------------------------
 * Capture the current HTTP request method (GET, POST, PUT, DELETE, etc.)
 * and the requested URI. This will be used by the router to resolve
 * which controller and method to execute.
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

/**
 * -------------------------------------------------------------------------
 * Request & Response Objects
 * -------------------------------------------------------------------------
 * Create instances of the Core\Request and Core\Response classes.
 * These objects represent the current HTTP request and the response
 * that will be sent to the client. They are injected into controllers
 * to facilitate request handling and response rendering.
 */
$request = new \Core\Request();
$response = new \Core\Response();

/**
 * -------------------------------------------------------------------------
 * Controller Dependencies
 * -------------------------------------------------------------------------
 * Prepare a list of dependencies to inject into controllers.
 * - SysTE        -> Template engine for rendering views
 * - SysLogger    -> Logging system for debugging and audit
 * - SomeService  -> Example custom service
 * - AnotherService -> Another example service
 * - Request      -> Current HTTP request
 * - Response     -> Response object for sending output
 */
$dependencies = [
    new SysTE(VIEWS_PATH, VIEWSCACHE_PATH),
    new SysLogger(),
    new SomeService(),
    new AnotherService(),
    $request,
    $response
];



/**
 * -------------------------------------------------------------------------
 * Route Resolution
 * -------------------------------------------------------------------------
 * SysRouter resolves the current route by matching the request method
 * and URI. It instantiates the corresponding controller and injects
 * all required dependencies. Controller methods are executed and
 * the response is returned to the client.
 */
SysRouter::resolve($requestMethod, $requestUri, $dependencies);

/**
 * -------------------------------------------------------------------------
 * Session Flash Cleanup
 * -------------------------------------------------------------------------
 * Optional: remove any flash messages stored in the session to
 * prevent them from persisting across multiple requests.
 */
# Session::remove_flash();
