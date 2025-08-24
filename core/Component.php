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

namespace Core;

abstract class Component
{
    // Atributos dinâmicos passados ao componente
    protected $attributes = [];

    // Construtor que recebe os atributos do componente
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    // Método para renderizar o componente
    abstract public function render();

    // Método para acessar atributos dinâmicos do componente
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}
