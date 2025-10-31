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
use Core\SysTE;

/**
 * Class AdminController
 *
 * Handles the administration panel pages and renders respective templates.
 * Provides pages for dashboard, users, settings, utilities, UI components, charts, and tables.
 */
class AdminController extends BaseController
{
    protected SysTE $sysTE;

    /**
     * Constructor.
     *
     * @param SysTE $sysTE Template engine instance.
     */
    public function __construct(SysTE $sysTE)
    {
        $this->sysTE = $sysTE;
    }

    /**
     * Display the main admin dashboard.
     */
    public function dashboard(): void
    {
        echo $this->sysTE->render('admin.dashboard');
    }

    /**
     * Display the user management page.
     */
    public function users(): void
    {
        echo $this->sysTE->render('admin.users');
    }

    /**
     * Display the application settings page.
     */
    public function settings(): void
    {
        echo $this->sysTE->render('admin.settings');
    }

    /**
     * Display buttons examples page.
     */
    public function buttons(): void
    {
        echo $this->sysTE->render('admin.buttons');
    }

    /**
     * Display cards examples page.
     */
    public function cards(): void
    {
        echo $this->sysTE->render('admin.cards');
    }

    /**
     * Display color utilities examples.
     */
    public function utilities_color(): void
    {
        echo $this->sysTE->render('admin.utilities_color');
    }

    /**
     * Display border utilities examples.
     */
    public function utilities_border(): void
    {
        echo $this->sysTE->render('admin.utilities_border');
    }

    /**
     * Display animation utilities examples.
     */
    public function utilities_animation(): void
    {
        echo $this->sysTE->render('admin.utilities_animation');
    }

    /**
     * Display other utilities examples.
     */
    public function utilities_other(): void
    {
        echo $this->sysTE->render('admin.utilities_other');
    }

    /**
     * Display a blank page template.
     */
    public function blank(): void
    {
        echo $this->sysTE->render('admin.blank');
    }

    /**
     * Display charts and data visualization examples.
     */
    public function charts(): void
    {
        echo $this->sysTE->render('admin.charts');
    }

    /**
     * Display tables and data listing examples.
     */
    public function tables(): void
    {
        echo $this->sysTE->render('admin.tables');
    }
}
