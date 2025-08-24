<?php  

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

namespace App\Controllers;

use Core\BaseController;
use Core\SysLogger;
use Core\SysTE;


class HomeController extends BaseController
{
    protected $sysTE;
    protected $logger;

    public function __construct()
    {        
        $this->sysTE = new SysTE(VIEWS_PATH, VIEWSCACHE_PATH);
        $this->logger = new SysLogger();
    }

    public function index()
    {   
       
        // Cria uma instância do SysLogger
        $logger = new SysLogger();

        // Registrar uma mensagem de info
        $logger->info('(home.index) - Esta é uma mensagem de informação.');

        // Registrar uma mensagem de aviso
        # $logger->warning('(welcome.index) - Esta é uma mensagem de aviso.');

        // Registrar uma mensagem de erro
        # $logger->error('(welcome.index) - Esta é uma mensagem de erro.');
        
        echo $this->sysTE->render('home.index');
    }
    
  
    
    
    public function example()
    {   
       
        // Cria uma instância do SysLogger
        $logger = new SysLogger();

        // Registrar uma mensagem de info
        $logger->info('(home.example) - Esta é uma mensagem de informação.');

        // Registrar uma mensagem de aviso
        # $logger->warning('(welcome.index) - Esta é uma mensagem de aviso.');

        // Registrar uma mensagem de erro
        # $logger->error('(welcome.index) - Esta é uma mensagem de erro.');
        
        


        $data = [
            'user' => [
                'name' => 'João',
                'is_admin' => true
            ],
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        echo $this->sysTE->render('home.example', $data);
    }
    
    
    public function syste()
    {   
       
        // Cria uma instância do SysLogger
        $logger = new SysLogger();

        // Registrar uma mensagem de info
        $logger->info('(home.syste) - Esta é uma mensagem de informação.');

        // Registrar uma mensagem de aviso
        # $logger->warning('(welcome.index) - Esta é uma mensagem de aviso.');

        // Registrar uma mensagem de erro
        # $logger->error('(welcome.index) - Esta é uma mensagem de erro.');
        
        $data = [
            'user' => [
                'name' => 'João',
                'is_admin' => true
            ],
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];
        
        $data = ['name' => 'Marco Costa'];

        echo $this->sysTE->render('home.syste', $data);
    }
    
    
    
    

    
    public function systable()
    {   
       
        // Cria uma instância do SysLogger
        $logger = new SysLogger();

        // Registrar uma mensagem de info
        $logger->info('(home.systable) - Esta é uma mensagem de informação.');

        // Registrar uma mensagem de aviso
        # $logger->warning('(welcome.index) - Esta é uma mensagem de aviso.');

        // Registrar uma mensagem de erro
        # $logger->error('(welcome.index) - Esta é uma mensagem de erro.');
        
        echo $this->sysTE->render('syscss.systable');
    }
}
