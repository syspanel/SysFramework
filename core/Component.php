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
 * Component - Abstract base class for SysFramework UI components.
 *
 * This class defines the basic structure and behavior of all components.
 * Each component can receive dynamic attributes and must implement
 * the render() method to generate its output.
 *
 * @package SysFramework\Core
 * @author Marco Costa
 * @copyright (c) 2025 SysFramework
 * @license MIT License
 * @link https://sysframework.syspanel.com.br
 */
abstract class Component
{
    /** 
     * @var array Dynamic attributes passed to the component
     */
    protected $attributes = [];

    /**
     * Constructor - Initializes the component with attributes.
     *
     * @param array $attributes Key-value pairs of component properties
     */
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Render method - must be implemented by child classes.
     *
     * @return string Rendered output of the component
     */
    abstract public function render();

    /**
     * Magic getter - allows dynamic access to component attributes.
     *
     * @param string $name Attribute name
     * @return mixed|null Attribute value or null if not defined
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}
