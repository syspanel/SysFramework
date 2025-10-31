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
use Core\SysTE;
use Core\SysLocale;

class HomeController extends BaseController
{
    protected $sysTE;
    protected $logger;

    /**
     * Constructor initializes the template engine and logger.
     */
    public function __construct()
    {        
        $this->sysTE = new SysTE(VIEWS_PATH, VIEWSCACHE_PATH);
        $this->logger = new SysLogger();
    }

    /**
     * Display the home page.
     */
    public function index()
    {   
        $this->logger->info('(home.index) - Loading the home page.');

        // Render the 'home.index' template
        echo $this->sysTE->render('home.index');
    }

    /**
     * Display the user guide page.
     */
    public function userguide()
    {   
        $this->logger->info('(home.userguide) - Accessing the user guide.');

        // Include the user guide page directly
        include VIEWS_PATH . '/home/userguide.sys.php';
    }

    /**
     * Example page showing sample data rendering.
     */
    public function example()
    {   
        $this->logger->info('(home.example) - Rendering example page.');

        $data = [
            'user' => [
                'name' => 'João',
                'is_admin' => true
            ],
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        echo $this->sysTE->render('home.example', $data);
    }

    /**
     * Display a page with system information.
     */
    public function syste()
    {   
        $this->logger->info('(home.syste) - Rendering system info page.');

        $data = ['name' => 'Marco Costa'];

        echo $this->sysTE->render('home.syste', $data);
    }

    /**
     * Display system tables page.
     */
    public function systables()
    {   
        $this->logger->info('(home.systables) - Rendering system tables page.');

        echo $this->sysTE->render('syscss.systables');
    }


}
