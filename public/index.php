<?php
if (!isset($_SESSION)) {
    session_start();
}

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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname(__DIR__) . '/config/bootstrap.php';
