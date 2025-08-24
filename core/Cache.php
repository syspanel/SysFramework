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

class Cache
{
    private $cacheDir;

    public function __construct($cacheDir = 'cache')
    {
        $this->cacheDir = $cacheDir;

        // Cria o diretório de cache se não existir
        if (!file_exists($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    /**
     * Armazena um item em cache.
     *
     * @param string $key A chave do cache.
     * @param mixed $data Os dados a serem armazenados.
     * @param int $ttl Tempo de vida do cache em segundos.
     */
    public function put($key, $data, $ttl = 3600)
    {
        $file = $this->getFilePath($key);
        $cacheData = [
            'expire' => time() + $ttl,
            'data'   => $data
        ];
        file_put_contents($file, serialize($cacheData));
    }

    /**
     * Recupera um item do cache.
     *
     * @param string $key A chave do cache.
     * @return mixed|false Os dados do cache ou false se expirado ou não encontrado.
     */
    public function get($key)
    {
        $file = $this->getFilePath($key);

        if (!file_exists($file)) {
            return false;
        }

        $cacheData = unserialize(file_get_contents($file));

        if ($cacheData['expire'] < time()) {
            unlink($file);
            return false;
        }

        return $cacheData['data'];
    }

    /**
     * Remove um item do cache.
     *
     * @param string $key A chave do cache.
     */
    public function forget($key)
    {
        $file = $this->getFilePath($key);

        if (file_exists($file)) {
            unlink($file);
        }
    }

    /**
     * Obtém o caminho do arquivo de cache.
     *
     * @param string $key A chave do cache.
     * @return string O caminho do arquivo de cache.
     */
    private function getFilePath($key)
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }
}
