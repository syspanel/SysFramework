<?php

namespace App\Controllers;

use Core\SysTE;

class AdminController  extends BaseController
{
    protected $sysTE;

    public function __construct(SysTE $sysTE)
    {
        $this->sysTE = $sysTE;
    }

    public function dashboard()
    {
        echo $this->sysTE->render('admin.dashboard');
    }

    public function users()
    {
        // Lógica para gerenciar usuários
        echo $this->sysTE->render('admin.users');
    }

    public function settings()
    {
        // Lógica para configurações
        echo $this->sysTE->render('admin.settings');
    }
}
