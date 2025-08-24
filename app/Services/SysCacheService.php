<?php



namespace App\Services;

class SysCacheService
{
    private $cacheDir;

    public function __construct($cacheDir = __DIR__ . '/../cache')
    {
        $this->cacheDir = $cacheDir;
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function set($key, $data, $ttl = 3600)
    {
        $file = $this->getCacheFile($key);
        $cacheData = [
            'expires' => time() + $ttl,
            'data' => $data
        ];
        file_put_contents($file, serialize($cacheData));
    }

    public function get($key)
    {
        $file = $this->getCacheFile($key);
        if (!file_exists($file)) {
            return null;
        }

        $cacheData = unserialize(file_get_contents($file));
        if ($cacheData['expires'] < time()) {
            unlink($file);
            return null;
        }

        return $cacheData['data'];
    }

    public function clear($key)
    {
        $file = $this->getCacheFile($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function clearAll()
    {
        foreach (glob($this->cacheDir . '/*') as $file) {
            unlink($file);
        }
    }

    private function getCacheFile($key)
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }
}
