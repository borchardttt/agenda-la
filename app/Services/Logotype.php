<?php

namespace App\Services;

use Core\Constants\Constants;

class Logotype
{
    /** @var array<string, mixed> $image */
    private array $image;

    public function __construct(array $image)
    {
        $this->image = $image;
    }

    public function path(): string
    {
        $logoPath = $this->baseDir() . "logotype.png";
        $fullPath = Constants::rootPath()->join("public" . $logoPath);

        if (file_exists($fullPath)) {
            return $logoPath;
        }

        return "/assets/images/defaults/logotype.png";
    }

    public function update(): void
    {
        if (!empty($this->getTmpFilePath())) {
            $this->removeOldImage();
            move_uploaded_file($this->getTmpFilePath(), $this->getAbsoluteFilePath());
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Logo atualizada com sucesso!'];
        }
    }

    public function getTmpFilePath(): string
    {
        return $this->image['tmp_name'];
    }

    public function removeOldImage(): void
    {
        $oldFilePath = $this->getAbsoluteFilePath();
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
    }

    private function getFileName(): string
    {
        return "logotype.png";
    }

    private function getAbsoluteFilePath(): string
    {
        return $this->storeDir() . $this->getFileName();
    }

    private function baseDir(): string
    {
        return "/assets/uploads/logos/";
    }

    private function storeDir(): string
    {
        $path = Constants::rootPath()->join("public" . $this->baseDir());
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
}
