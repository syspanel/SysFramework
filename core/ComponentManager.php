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
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace Core;

/**
 * ComponentManager - Handles registration and rendering of SysFramework components.
 *
 * This class dynamically loads and renders UI components from the App\Components namespace.
 * It verifies that the component class exists, instantiates it with optional attributes,
 * and returns the rendered output.
 *
 * @package SysFramework\Core
 * @author Marco Costa
 * @copyright (c) 2025 SysFramework
 * @license MIT License
 * @link https://sysframework.syspanel.com.br
 */
class ComponentManager
{
    /**
     * Render a component by its name.
     *
     * Dynamically loads the corresponding component class located in
     * the App\Components namespace and calls its render() method.
     *
     * @param string $name The name of the component (e.g. "Alert")
     * @param array $attributes Optional key-value pairs passed to the component
     * @return string The rendered component HTML
     *
     * @throws \Exception If the component class does not exist
     */
    public function render($name, $attributes = [])
    {
        $componentClass = "\\App\\Components\\" . ucfirst($name);

        // Check if the component class exists
        if (!class_exists($componentClass)) {
            throw new \Exception("Component {$name} not found.");
        }

        // Create an instance of the component
        $component = new $componentClass($attributes);

        // Render the component
        return $component->render();
    }
}
