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

namespace App\Models;

use Core\SysORM;

class Client extends SysORM
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'password',
        'company',
        'address',
        'phone',
        'email',
        'notes'
    ];

    protected $hidden = [
        'password',
    ];
}
