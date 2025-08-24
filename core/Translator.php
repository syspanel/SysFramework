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

class Translator
{
    private $locale;
    private $messages = [];

    public function __construct($locale = 'pt_br')
    {
        $this->locale = $locale;
        $this->loadMessages();
    }

    private function loadMessages()
    {
        $file = __DIR__ . "/../locales/{$this->locale}/messages.php";
        if (file_exists($file)) {
            $this->messages = include $file;
        } else {
            throw new \Exception("Arquivo de idioma não encontrado: {$file}");
        }
    }

    public function translate($key, $placeholders = [])
    {
        $message = $this->messages[$key] ?? $key;

        foreach ($placeholders as $placeholder => $value) {
            $message = str_replace("{{$placeholder}}", $value, $message);
        }

        return $message;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->loadMessages();
    }
}
