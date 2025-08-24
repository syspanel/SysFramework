<?php  
if (!isset($_SESSION)) { session_start(); }

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/



// Gera um novo token CSRF se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));}



// https://image.intervention.io/v2/introduction/installation
use Intervention\Image\ImageManager;
// create new image manager with gd driver
$manager = ImageManager::gd();
// same call with configuration options
$manager = ImageManager::gd(autoOrientation: false);

	
if (!isset($_SESSION['systoken'])) {
# https://github.com/gilbitron/EasyCSRF 
$sessionProvider = new EasyCSRF\NativeSessionProvider();
$easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
$systoken = $easyCSRF->generate('systoken');
$_SESSION['systoken'] = $systoken; }




use Core\Translator;
// Configurar o idioma
$translator = new Translator('pt_br');

// Traduzir uma mensagem
#echo $translator->translate('welcome');




// Define os caminhos configurados
define("BASE_PATH",$paths['base_path']);
define("APP_PATH",$paths['app_path']);
define("CORE_PATH",$paths['core_path']);
define("PUBLIC_PATH",$paths['public_path']);
define("ROUTES_PATH",$paths['routes_path']);
define("STORAGE_PATH",$paths['storage_path']);
define("CONFIG_PATH",$paths['config_path']);
define("CONTROLLERS_PATH",$paths['controllers_path']);
define("MODELS_PATH",$paths['models_path']);
define("VIEWS_PATH",$paths['views_path']);
define("HELPERS_PATH",$paths['helpers_path']);
define("EVENTS_PATH",$paths['events_path']);
define("LISTENERS_PATH",$paths['listeners_path']);
define("MIDDLEWARES_PATH",$paths['middlewares_path']);
define("SERVICES_PATH",$paths['services_path']);
define("USECASES_PATH",$paths['usecases_path']);
define("CONSOLE_PATH",$paths['console_path']);
define("CACHE_PATH",$paths['cache_path']);
define("VIEWSCACHE_PATH",$paths['viewscache_path']);
define("LOGS_PATH",$paths['logs_path']);
define("UPLOADS_PATH",$paths['uploads_path']);
define("WEBROUTES_FILE",$paths['webroutes_file']);
define("ENV_FILE",$paths['env_file']);


?>