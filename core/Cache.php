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
 * Cache - Simple file-based cache system with optional HMAC verification.
 *
 * This class provides a lightweight and secure caching layer that stores 
 * serialized data as JSON files on disk. Each cache entry includes an 
 * expiration timestamp and can be optionally protected with an HMAC-SHA256 
 * signature to ensure integrity and prevent tampering.
 *
 * Features:
 * - File-based caching using JSON.
 * - Optional HMAC signing for data integrity.
 * - Automatic directory creation.
 * - Safe atomic writes using temp files.
 * - Auto-expiration and deletion of expired entries.
 *
 * Typical usage:
 * 
 * ```php
 * $cache = new \Core\Cache(__DIR__ . '/cache', 'my_secret_key');
 * $cache->set('user_123', ['name' => 'John'], 3600);
 * $data = $cache->get('user_123');
 * ```
 */
class Cache
{
    /** @var string Directory path where cache files are stored. */
    protected string $path;

    /** @var string|null Optional HMAC key for verifying data integrity. */
    protected ?string $hmacKey;

    /**
     * Constructor.
     *
     * Initializes the cache directory and optional HMAC key.
     *
     * @param string $path Directory path where cache files are stored.
     * @param string|null $hmacKey Optional key for HMAC integrity check.
     */
    public function __construct(string $path, ?string $hmacKey = null)
    {
        $this->path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        if (!is_dir($this->path)) {
            @mkdir($this->path, 0755, true);
        }
        $this->hmacKey = $hmacKey;
    }

    /**
     * Returns the full cache file path for a given key.
     *
     * @param string $key Cache key.
     * @return string Path to the corresponding cache file.
     */
    protected function fileForKey(string $key): string
    {
        return $this->path . md5($key) . '.cache';
    }

    /**
     * Stores a value in the cache.
     *
     * Data is stored in JSON format with an expiration timestamp.
     * If HMAC is enabled, data integrity is ensured by signing the content.
     *
     * @param string $key Cache key.
     * @param mixed $value Data to be stored.
     * @param int $ttl Time-to-live (in seconds). Default: 3600.
     * @return bool True if the cache entry was written successfully.
     */
    public function set(string $key, $value, int $ttl = 3600): bool
    {
        $payload = [
            'expires' => time() + $ttl,
            'value' => $value,
        ];
        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            return false;
        }

        // Add HMAC signature for integrity, if enabled
        if ($this->hmacKey) {
            $mac = hash_hmac('sha256', $json, $this->hmacKey);
            $json = $mac . '::' . $json;
        }

        // Write atomically to avoid data corruption
        $file = $this->fileForKey($key);
        $tmp = tempnam(sys_get_temp_dir(), 'cache_');
        if ($tmp === false) {
            return false;
        }
        file_put_contents($tmp, $json);
        rename($tmp, $file);
        return true;
    }

    /**
     * Retrieves a cached value by its key.
     *
     * If the cache is expired, invalid, or tampered with, null is returned.
     *
     * @param string $key Cache key.
     * @return mixed|null The cached data, or null if not found or expired.
     */
    public function get(string $key)
    {
        $file = $this->fileForKey($key);
        if (!file_exists($file)) {
            return null;
        }

        $content = file_get_contents($file);
        if ($content === false) return null;

        // Verify HMAC integrity if enabled
        if ($this->hmacKey) {
            $parts = explode('::', $content, 2);
            if (count($parts) !== 2) return null;
            [$mac, $json] = $parts;
            $calc = hash_hmac('sha256', $json, $this->hmacKey);
            if (!hash_equals($calc, $mac)) {
                // Possible tampering detected
                return null;
            }
            $payload = json_decode($json, true);
        } else {
            $payload = json_decode($content, true);
        }

        if (!is_array($payload) || !isset($payload['expires'])) {
            return null;
        }

        // Check for expiration
        if ($payload['expires'] < time()) {
            @unlink($file);
            return null;
        }

        return $payload['value'];
    }

    /**
     * Deletes a cache entry by key.
     *
     * @param string $key Cache key.
     * @return bool True if deleted successfully or not found.
     */
    public function delete(string $key): bool
    {
        $file = $this->fileForKey($key);
        if (file_exists($file)) {
            return @unlink($file);
        }
        return true;
    }
}
