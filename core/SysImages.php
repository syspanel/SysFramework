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
 * SysImages
 * ------------------------------------------------------------------------
 * Image manipulation utility for SysFramework.
 *
 * This class provides a simple and secure interface for basic image
 * operations such as loading, resizing, and saving images using
 * PHP’s GD library.
 *
 * Supports JPEG, PNG, and GIF formats with automatic detection and
 * safe file handling to prevent directory traversal vulnerabilities.
 */
class SysImages
{
    /** @var \GdImage|resource|null The GD image resource or GdImage instance. */
    protected $image;

    /** @var int Image type constant (e.g., IMAGETYPE_JPEG, IMAGETYPE_PNG). */
    protected int $imageType;

    /** @var int Image width in pixels. */
    protected int $width;

    /** @var int Image height in pixels. */
    protected int $height;

    /**
     * Constructor — loads and initializes an image from disk.
     *
     * Automatically detects format and loads via GD functions.
     *
     * @param string $filePath Full path to the image file.
     *
     * @throws \InvalidArgumentException If the file is not found or unsupported.
     *
     * @example
     * $img = new SysImages('photo.jpg');
     */
    public function __construct(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: {$filePath}");
        }

        $imageInfo = getimagesize($filePath);
        if ($imageInfo === false) {
            throw new \InvalidArgumentException("Unsupported image or corrupt file");
        }

        $this->imageType = $imageInfo[2];

        // Load image based on type (JPEG, PNG, GIF)
        switch ($this->imageType) {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($filePath);
                break;
            default:
                throw new \InvalidArgumentException("Unsupported image type");
        }

        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    /**
     * Resize image proportionally based on new width.
     *
     * @param int $newWidth Target width in pixels.
     */
    public function resizeToWidth(int $newWidth): void
    {
        $ratio = $newWidth / $this->width;
        $newHeight = (int) round($this->height * $ratio);
        $this->resize($newWidth, $newHeight);
    }

    /**
     * Resize image proportionally based on new height.
     *
     * @param int $newHeight Target height in pixels.
     */
    public function resizeToHeight(int $newHeight): void
    {
        $ratio = $newHeight / $this->height;
        $newWidth = (int) round($this->width * $ratio);
        $this->resize($newWidth, $newHeight);
    }

    /**
     * Resize image to exact dimensions.
     *
     * Preserves PNG transparency by maintaining the alpha channel.
     *
     * @param int $newWidth Target width in pixels.
     * @param int $newHeight Target height in pixels.
     */
    public function resize(int $newWidth, int $newHeight): void
    {
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG files
        if ($this->imageType === IMAGETYPE_PNG) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }

        // Resample image to new dimensions
        imagecopyresampled(
            $newImage,
            $this->image,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $this->width, $this->height
        );

        // Replace current image resource
        $this->image = $newImage;
        $this->width = $newWidth;
        $this->height = $newHeight;
    }

    /**
     * Save the image safely to disk.
     *
     * Automatically determines the correct output format based on file extension.
     * Prevents path traversal by enforcing local filenames (basename only).
     *
     * @param string $filename Target file name (with or without extension).
     * @param int|null $quality JPEG quality (1–100) or compression level for PNG.
     *
     * @throws \RuntimeException If a temporary file cannot be created.
     * @throws \InvalidArgumentException For unsupported formats.
     */
    public function save(string $filename, ?int $quality = 90): void
    {
        // Prevent directory traversal attacks
        $filename = basename($filename);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // Determine extension from original type if missing
        if (empty($ext)) {
            switch ($this->imageType) {
                case IMAGETYPE_JPEG: $ext = 'jpg'; break;
                case IMAGETYPE_PNG: $ext = 'png'; break;
                case IMAGETYPE_GIF: $ext = 'gif'; break;
                default: $ext = 'jpg'; break;
            }
            $filename .= '.' . $ext;
        }

        // Create temporary file
        $tmp = tempnam(sys_get_temp_dir(), 'img_');
        if ($tmp === false) {
            throw new \RuntimeException("Unable to create temporary file");
        }

        // Save image depending on format
        switch (strtolower($ext)) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($this->image, $tmp, $quality);
                break;
            case 'png':
                $level = (int) round((9 * (100 - $quality)) / 100); // Convert JPEG quality to PNG level
                imagepng($this->image, $tmp, $level);
                break;
            case 'gif':
                imagegif($this->image, $tmp);
                break;
            default:
                unlink($tmp);
                throw new \InvalidArgumentException("Unsupported target image format");
        }

        // Move the temporary file to the final location
        if (!rename($tmp, $filename)) {
            copy($tmp, $filename);
            unlink($tmp);
        }
    }

    /**
     * Destructor — releases the GD image resource from memory.
     */
    public function __destruct()
    {
        if (is_resource($this->image) || $this->image instanceof \GdImage) {
            imagedestroy($this->image);
        }
    }
}
