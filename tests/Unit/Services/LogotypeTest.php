<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\Logotype;

class LogotypeTest extends TestCase
{
    public function testPathReturnsDefaultWhenFileDoesNotExist(): void
    {
        $logotype = new Logotype(['tmp_name' => '']);

        $this->assertEquals('/assets/images/defaults/logotype.png', $logotype->path());
    }

    public function testGetTmpFilePathReturnsCorrectValue(): void
    {
        $imageMock = ['tmp_name' => '/tmp/test_image.png'];
        $logotype = new Logotype($imageMock);

        $this->assertEquals('/tmp/test_image.png', $logotype->getTmpFilePath());
    }
}
