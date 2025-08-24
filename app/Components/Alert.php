<?php

namespace App\Components;

use \App\BladeOne;

class Alert
{
    protected $attributes;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function render()
    {
        ob_start();
        include __DIR__ . '/../../resources/views/components/Alert.blade.php';
        return ob_get_clean();
    }
}
