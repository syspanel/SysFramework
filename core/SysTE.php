<?php

namespace Core;

class SysTE
{
    protected $viewsPath;
    protected $cachePath;
    protected $sections = [];
    protected $extends = null;
    protected $pushStack = [];
    protected $currentSection = null;
    protected $currentPush = null;

    public function __construct($viewsPath, $cachePath)
    {
        $this->viewsPath = $viewsPath;
        $this->cachePath = $cachePath;
    }

    public function render($template, $data = [])
    {
        // Suporte para .blade.php e .sys.php
        $templatePath = $this->viewsPath . '/' . str_replace('.', '/', $template);
        $templatePathBlade = $templatePath . '.blade.php';
        $templatePathSys = $templatePath . '.sys.php';
        $cachePath = $this->cachePath . '/' . md5($template) . '.php';

        if (!file_exists($templatePathBlade) && !file_exists($templatePathSys)) {
            throw new \Exception("Template não encontrado: " . $templatePathBlade . " ou " . $templatePathSys);
        }

        // Verifica se o template foi modificado e recompila, se necessário
        if (!file_exists($cachePath) || (file_exists($templatePathBlade) && filemtime($templatePathBlade) > filemtime($cachePath)) || 
            (file_exists($templatePathSys) && filemtime($templatePathSys) > filemtime($cachePath))) {
            $this->compile(file_exists($templatePathBlade) ? $templatePathBlade : $templatePathSys, $cachePath);
        }

        ob_start();
        extract($data);
        include $cachePath;

        // Se houver um layout estendido, renderize-o apenas uma vez
        if ($this->extends) {
            $layout = $this->extends;
            $this->extends = null; // Evita renderização recursiva
            return $this->render($layout, $data);
        }

        return ob_get_clean();
    }

    protected function compile($templatePath, $cachePath)
    {
        $content = file_get_contents($templatePath);

        $content = $this->compileIfStatements($content);
        $content = $this->compileForeachStatements($content);
        $content = $this->compileForStatements($content);
        $content = $this->compilePhpStatements($content);
        $content = $this->compileAdditionalDirectives($content);

        file_put_contents($cachePath, $content);
    }

    protected function compileIfStatements($content)
    {
        $patterns = [
            '/{{--(.*?)--}}/s' => '',
            '/@if\s*\((.*?)\)/s' => '<?php if ($1): ?>',
            '/@else\s*/s' => '<?php else: ?>',
            '/@elseif\s*\((.*?)\)/s' => '<?php elseif ($1): ?>',
            '/@endif\s*/s' => '<?php endif; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    protected function compileForeachStatements($content)
    {
        $patterns = [
            '/@foreach\s*\((.*?)\)/s' => '<?php foreach ($1): ?>',
            '/@endforeach\s*/s' => '<?php endforeach; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    protected function compileForStatements($content)
    {
        $patterns = [
            '/@for\s*\((.*?)\)/s' => '<?php for ($1): ?>',
            '/@endfor\s*/s' => '<?php endfor; ?>',
        ];
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

    protected function compilePhpStatements($content)
    {
        $patterns = [
            '/@php\s*(.*?)\s*@endphp/s' => '<?php $1 ?>',
            '/{{\s*(.*?)\s*}}/s' => '<?php echo htmlspecialchars($1, ENT_QUOTES, "UTF-8"); ?>',
            '/@{{\s*(.*?)\s*}}/s' => '{{ $1 }}',
            '/{{--(.*?)--}}/s' => '', 
        ];

        // Remover comentários antes de aplicar outros padrões
        $content = preg_replace('/{{--(.*?)--}}/s', '', $content);

        // Aplicar os padrões de substituição
        return preg_replace(array_keys($patterns), array_values($patterns), $content);
    }

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

    public function extend($template)
    {
        $this->extends = $template;
        return ''; // Ensures that `@extends` does not output anything
    }

    public function startSection($name, $content = '')
    {
        $this->currentSection = $name;
        ob_start(); // Inicia o buffer de saída
        if ($content) {
            echo $content; // Exibe o conteúdo inicial, se houver
        }
    }

    public function stopSection()
    {
        if ($this->currentSection) {
            $this->sections[$this->currentSection] = ob_get_clean();
            $this->currentSection = null;
        }
    }

    public function yieldSection($name)
    {
        return isset($this->sections[$name]) ? $this->sections[$name] : '';
    }

    public function include($template)
    {
        return $this->render($template);
    }

    public function includeIf($template)
    {
        $templatePathBlade = $this->viewsPath . '/' . str_replace('.', '/', $template) . '.blade.php';
        $templatePathSys = $this->viewsPath . '/' . str_replace('.', '/', $template) . '.sys.php';
        if (file_exists($templatePathBlade)) {
            return $this->render($template);
        } elseif (file_exists($templatePathSys)) {
            return $this->render($template);
        }
        return '';
    }

    public function includeWhen($condition, $template)
    {
        return $condition ? $this->include($template) : '';
    }

    public function includeUnless($condition, $template)
    {
        return !$condition ? $this->include($template) : '';
    }

    public function startPush($name)
    {
        ob_start();
        $this->currentPush = $name;
        if (!isset($this->pushStack[$name])) {
            $this->pushStack[$name] = [];
        }
    }

    public function stopPush()
    {
        if ($this->currentPush) {
            $this->pushStack[$this->currentPush][] = ob_get_clean();
            $this->currentPush = null;
        }
    }

    public function stack($name)
    {
        if (!isset($this->pushStack[$name])) {
            return '';
        }
        return implode('', array_merge(...$this->pushStack[$name]));
    }

    protected function csrfToken()
    {
        return $_SESSION['csrf_token'] ?? ''; // Modifique conforme necessário para gerar ou obter o token CSRF
    }
}
