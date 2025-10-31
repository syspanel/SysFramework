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
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace App\Controllers;

use Core\BaseController;
use Core\SysLogger;
use Core\SysLocale;
use Core\SysRouter;
use Core\SysTE;



class LocaleController extends BaseController
{
    protected $logger;
    protected $sysTE;


    /**
     * Constructor initializes logger and template engine.
     */
    public function __construct()
    {
        $this->logger = new SysLogger();
        $this->sysTE = new SysTE(VIEWS_PATH, VIEWSCACHE_PATH);
    }

    /**
     * Set the application's locale dynamically and redirect to home.index.
     *
     * @param string $lang
     */
    public function setLocale(string $lang)
    {
        // Define o locale sem restrições
        SysLocale::setLocale($lang);

        // Persistência em sessão
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['locale'] = $lang;

        $this->logger->info("(locale.setLocale) - Locale set to {$lang}");

        echo $this->sysTE->render('home.index');
    }
}
