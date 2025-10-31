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

namespace App\Services;

class SysCacheService
{
    private $cacheDir;
    private $logFile;

    public function __construct($cacheDir = __DIR__ . '/../cache', $logFile = __DIR__ . '/../cache/cache.log')
    {
        $this->cacheDir = $cacheDir;
        $this->logFile = $logFile;

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    /**
     * Sets a cache entry.
     *
     * @param string $key
     * @param mixed $data Array, object, string, etc.
     * @param int $ttl Time to live in seconds
     * @param array $tags Optional tags for grouping
     */
    public function set($key, $data, $ttl = 3600, array $tags = [])
    {
        $file = $this->getCacheFile($key);
        $cacheData = [
            'expires' => time() + $ttl,
            'data' => $data,
            'tags' => $tags
        ];

        file_put_contents($file, serialize($cacheData));
        $this->log("SET cache: $key");
    }

    /**
     * Gets a cache entry.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        $file = $this->getCacheFile($key);

        if (!file_exists($file)) {
            $this->log("GET cache MISS: $key");
            return null;
        }

        $cacheData = unserialize(file_get_contents($file));

        if ($cacheData['expires'] < time()) {
            unlink($file);
            $this->log("GET cache EXPIRED: $key");
            return null;
        }

        $this->log("GET cache HIT: $key");
        return $cacheData['data'];
    }

    /**
     * Clears a specific cache entry.
     */
    public function clear($key)
    {
        $file = $this->getCacheFile($key);
        if (file_exists($file)) {
            unlink($file);
            $this->log("CLEAR cache: $key");
        }
    }

    /**
     * Clears all cache entries.
     */
    public function clearAll()
    {
        foreach (glob($this->cacheDir . '/*') as $file) {
            unlink($file);
        }
        $this->log("CLEAR ALL cache");
    }

    /**
     * Clears cache entries by tag.
     */
    public function clearByTag($tag)
    {
        foreach (glob($this->cacheDir . '/*.cache') as $file) {
            $cacheData = unserialize(file_get_contents($file));
            if (isset($cacheData['tags']) && in_array($tag, $cacheData['tags'])) {
                unlink($file);
                $this->log("CLEAR cache by tag [$tag]: " . basename($file));
            }
        }
    }

    private function getCacheFile($key)
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }

    private function log($message)
    {
        $date = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$date] $message\n", FILE_APPEND);
    }
}
