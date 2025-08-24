<?php
namespace Core;

class SysImages
{
    private $image;
    private $imageType;

    public function __construct($filePath)
    {
        $this->load($filePath);
    }

    private function load($filePath)
    {
        $imageInfo = getimagesize($filePath);
        $this->imageType = $imageInfo[2];

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
            case IMAGETYPE_BMP:
                $this->image = imagecreatefrombmp($filePath);
                break;
            case IMAGETYPE_TIFF_II:
            case IMAGETYPE_TIFF_MM:
                $this->image = imagecreatefromtiff($filePath);
                break;
            case IMAGETYPE_WEBP:
                $this->image = imagecreatefromwebp($filePath);
                break;
            default:
                throw new Exception('Unsupported image type.');
        }
    }

    public function resize($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);

        // Preserve transparency for PNG and GIF
        if ($this->imageType == IMAGETYPE_PNG || $this->imageType == IMAGETYPE_GIF) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
            imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent);
        }

        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, imagesx($this->image), imagesy($this->image));
        $this->image = $newImage;
    }

    public function setResolution($dpiX, $dpiY)
    {
        // Set image resolution in DPI (not supported by all formats)
        if ($this->imageType == IMAGETYPE_JPEG) {
            // JPEG supports DPI settings
            imagejpeg($this->image, null, 100, $dpiX, $dpiY);
        }
    }

    public function save($filename)
    {
        // Always save as JPEG
        imagejpeg($this->image, $filename, 90); // Quality is set to 90
    }

    public function __destruct()
    {
        if ($this->image) {
            imagedestroy($this->image);
        }
    }
}
