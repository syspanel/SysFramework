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

class ComponentManager
{
    // Renderiza o componente especificado
    public function render($name, $attributes = [])
    {
        $componentClass = "\\App\\Components\\" . ucfirst($name);

        // Verifica se a classe do componente existe
        if (!class_exists($componentClass)) {
            throw new \Exception("Componente {$name} não encontrado.");
        }

        // Cria uma instância do componente
        $component = new $componentClass($attributes);

        // Renderiza o componente
        return $component->render();
    }
}
