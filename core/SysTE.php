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
 * SysTE - Simple template engine
 *
 * Technical comments:
 * - Supports Blade-like syntax (.blade.php) and custom .sys.php templates
 * - Supports template inheritance (@extends, @section, @yield)
 * - Supports conditional statements (@if, @elseif, @else, @endif)
 * - Supports loops (@foreach, @for)
 * - Supports template includes (@include, @includeIf, @includeWhen, @includeUnless)
 * - Supports content pushing and stacking (@push, @stack)
 * - Escapes output with htmlspecialchars for XSS protection
 * - Supports CSRF token and method spoofing for forms
 */
class SysTE
{
    protected $viewsPath;      // Path to templates
    protected $cachePath;      // Path to compiled templates
    protected $sections = [];  // Array to store sections content
    protected $extends = null; // Stores parent template if used
    protected $pushStack = []; // Stores content pushed to stacks
    protected $currentSection = null;
    protected $currentPush = null;

    /**
     * Constructor
     *
     * @param string $viewsPath Path to templates
     * @param string $cachePath Path to compiled template cache
     */
    public function __construct($viewsPath, $cachePath)
    {
        $this->viewsPath = $viewsPath;
        $this->cachePath = $cachePath;
    }

    /**
     * Render a template with optional data
     *
     * @param string $template Template name (dot notation)
     * @param array $data Associative array of data to extract into template
     * @return string Rendered HTML content
     */
    public function render($template, $data = [])
    {
        // Resolve template paths
        $templatePath = $this->viewsPath . '/' . str_replace('.', '/', $template);
        $templatePathBlade = $templatePath . '.blade.php';
        $templatePathSys = $templatePath . '.sys.php';
        $cachePath = $this->cachePath . '/' . md5($template) . '.php';

        if (!file_exists($templatePathBlade) && !file_exists($templatePathSys)) {
            throw new \Exception("Template not found: " . $templatePathBlade . " or " . $templatePathSys);
        }

        // Compile template if not cached or if modified
        if (!file_exists($cachePath) ||
            (file_exists($templatePathBlade) && filemtime($templatePathBlade) > filemtime($cachePath)) ||
            (file_exists($templatePathSys) && filemtime($templatePathSys) > filemtime($cachePath))
        ) {
            $this->compile(file_exists($templatePathBlade) ? $templatePathBlade : $templatePathSys, $cachePath);
        }

        ob_start();
        extract($data); // Make data variables available in template
        include $cachePath;

        // If template extends a parent layout, render it once
        if ($this->extends) {
            $layout = $this->extends;
            $this->extends = null; // Prevent recursion
            return $this->render($layout, $data);
        }

        return ob_get_clean();
    }

    /**
     * Compile template to PHP code
     *
     * @param string $templatePath Source template path
     * @param string $cachePath Destination compiled PHP path
     */
    protected function compile($templatePath, $cachePath)
    {
        $content = file_get_contents($templatePath);

        // Compile different template directives
        $content = $this->compileIfStatements($content);
        $content = $this->compileForeachStatements($content);
        $content = $this->compileForStatements($content);
        $content = $this->compilePhpStatements($content);
        $content = $this->compileAdditionalDirectives($content);

        file_put_contents($cachePath, $content);
    }

    /**
     * Compile @if, @elseif, @else, @endif directives
     */
    protected function compileIfStatements($content)
    {
        $patterns = [
            '/{{--(.*?)--}}/s' => '', // Remove comments
            '/@if\s*\((.*?)\)/s' => '<?php if ($1): ?>',
            '/@else\s*/s' => '<?php else: ?>',
            '/@elseif\s*\((.*?)\)/s' => '<?php elseif ($1): ?>',
            '/@endif\s*/s' => '<?php endif; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    /**
     * Compile @foreach and @endforeach directives
     */
    protected function compileForeachStatements($content)
    {
        $patterns = [
            '/@foreach\s*\((.*?)\)/s' => '<?php foreach ($1): ?>',
            '/@endforeach\s*/s' => '<?php endforeach; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    /**
     * Compile @for and @endfor directives
     */
    protected function compileForStatements($content)
    {
        $patterns = [
            '/@for\s*\((.*?)\)/s' => '<?php for ($1): ?>',
            '/@endfor\s*/s' => '<?php endfor; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    /**
     * Compile @php, {{ }}, @{{ }} directives
     * Escapes output using htmlspecialchars for security
     */
    protected function compilePhpStatements($content)
    {
        $patterns = [
            '/@php\s*(.*?)\s*@endphp/s' => '<?php $1 ?>',
            '/{{\s*(.*?)\s*}}/s' => '<?php echo htmlspecialchars($1, ENT_QUOTES, "UTF-8"); ?>',
            '/@{{\s*(.*?)\s*}}/s' => '{{ $1 }}', // Escaped output bypass
            '/{{--(.*?)--}}/s' => '', // Remove comments
        ];

        $content = preg_replace('/{{--(.*?)--}}/s', '', $content);

        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    /**
     * Compile additional directives like @extends, @section, @include, @push, @csrf
     */
    protected function compileAdditionalDirectives($content)
    {
        $patterns = [
            '/@extends\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->extend(\'$1\'); ?>',
            '/@section\s*\(\s*[\'"]([^\'"]+)[\'"]\s*,?\s*[\'"]?(.*?)?[\'"]?\s*\)/s' => '<?php $this->startSection(\'$1\', \'$2\'); ?>',
            '/@endsection\s*/s' => '<?php $this->stopSection(); ?>',
            '/@yield\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->yieldSection(\'$1\'); ?>',
            '/@include\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->include(\'$1\'); ?>',
            '/@includeIf\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->includeIf(\'$1\'); ?>',
            '/@includeWhen\s*\(\s*(.*?)\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->includeWhen($1, \'$2\'); ?>',
            '/@includeUnless\s*\(\s*(.*?)\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $1 ? "" : $this->include(\'$2\'); ?>',
            '/@push\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php $this->startPush(\'$1\'); ?>',
            '/@endpush\s*/s' => '<?php $this->stopPush(); ?>',
            '/@stack\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo $this->stack(\'$1\'); ?>',
            '/@csrf\s*/s' => '<?php echo \'<input type="hidden" name="_token" value="\' . htmlspecialchars($this->csrfToken(), ENT_QUOTES, "UTF-8") . \'">\'; ?>',
            '/@method\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/s' => '<?php echo \'<input type="hidden" name="_method" value="\' . htmlspecialchars(\'$1\', ENT_QUOTES, "UTF-8") . \'">\'; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    /**
     * Set parent layout template
     */
    public function extend($template)
    {
        $this->extends = $template;
        return '';
    }

    /**
     * Start capturing a section
     */
    public function startSection($name, $content = '')
    {
        $this->currentSection = $name;
        ob_start();
        if ($content) {
            echo $content;
        }
    }

    /**
     * Stop capturing a section and save content
     */
    public function stopSection()
    {
        if ($this->currentSection) {
            $this->sections[$this->currentSection] = ob_get_clean();
            $this->currentSection = null;
        }
    }

    /**
     * Yield a section content
     */
    public function yieldSection($name)
    {
        return $this->sections[$name] ?? '';
    }

    /**
     * Include another template
     */
    public function include($template)
    {
        return $this->render($template);
    }

    /**
     * Include template only if it exists
     */
    public function includeIf($template)
    {
        $templatePathBlade = $this->viewsPath . '/' . str_replace('.', '/', $template) . '.blade.php';
        $templatePathSys = $this->viewsPath . '/' . str_replace('.', '/', $template) . '.sys.php';
        if (file_exists($templatePathBlade) || file_exists($templatePathSys)) {
            return $this->render($template);
        }
        return '';
    }

    /**
     * Include template only if condition is true
     */
    public function includeWhen($condition, $template)
    {
        return $condition ? $this->include($template) : '';
    }

    /**
     * Include template only if condition is false
     */
    public function includeUnless($condition, $template)
    {
        return !$condition ? $this->include($template) : '';
    }

    /**
     * Start push content to a stack
     */
    public function startPush($name)
    {
        ob_start();
        $this->currentPush = $name;
        if (!isset($this->pushStack[$name])) {
            $this->pushStack[$name] = [];
        }
    }

    /**
     * Stop push and save content to stack
     */
    public function stopPush()
    {
        if ($this->currentPush) {
            $this->pushStack[$this->currentPush][] = ob_get_clean();
            $this->currentPush = null;
        }
    }

    /**
     * Get content of a stack
     */
    public function stack($name)
    {
        if (!isset($this->pushStack[$name])) {
            return '';
        }
        return implode('', array_merge(...$this->pushStack[$name]));
    }

    /**
     * Get CSRF token from session
     */
    protected function csrfToken()
    {
        return $_SESSION['csrf_token'] ?? ''; 
    }
}
