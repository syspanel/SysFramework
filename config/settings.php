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

// Generate a new CSRF token if it does not exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


// https://image.intervention.io/v2/introduction/installation
use Intervention\Image\ImageManager;

// Create a new image manager using the GD driver
$manager = ImageManager::gd();

// Same call with configuration options
$manager = ImageManager::gd(autoOrientation: false);


// Initialize EasyCSRF token if not set
if (!isset($_SESSION['systoken'])) {
    // https://github.com/gilbitron/EasyCSRF 
    $sessionProvider = new EasyCSRF\NativeSessionProvider();
    $easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);

    // Generate the system token
    $systoken = $easyCSRF->generate('systoken');
    $_SESSION['systoken'] = $systoken;
}



// Define configured paths
define("BASE_PATH", $paths['base_path']);
define("APP_PATH", $paths['app_path']);
define("CORE_PATH", $paths['core_path']);
define("PUBLIC_PATH", $paths['public_path']);
define("ROUTES_PATH", $paths['routes_path']);
define("STORAGE_PATH", $paths['storage_path']);
define("CONFIG_PATH", $paths['config_path']);
define("CONTROLLERS_PATH", $paths['controllers_path']);
define("MODELS_PATH", $paths['models_path']);
define("VIEWS_PATH", $paths['views_path']);
define("HELPERS_PATH", $paths['helpers_path']);
define("MIDDLEWARES_PATH", $paths['middlewares_path']);
define("SERVICES_PATH", $paths['services_path']);
define("CONSOLE_PATH", $paths['console_path']);
define("CACHE_PATH", $paths['cache_path']);
define("VIEWSCACHE_PATH", $paths['viewscache_path']);
define("LOGS_PATH", $paths['logs_path']);
define("UPLOADS_PATH", $paths['uploads_path']);
define("WEBROUTES_FILE", $paths['webroutes_file']);
define("ENV_FILE", $paths['env_file']);
