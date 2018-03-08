<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Libs\PexelDownloader;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PexelDownloaderTest extends TestCase
{

    private $image_url = 'https://static.pexels.com/photos/269077/pexels-photo-269077.jpeg';
    private $downloader;

    public function setUp()
    {
        $this->downloader = new PexelDownloader();
    }

    public function testGetFilePath()
    {
        $downloader = new PexelDownloader();
        $image_url = 'https://static.pexels.com/photos/269077/pexels-photo-269077.jpeg';

        $res = $downloader->getFilePath( $image_url );
        $this->assertEquals( $res, 'pexels-photo-269077.jpeg');
    }

    public function testCanDownloadImage()
    {
        $file = $this->downloader->downloadImage( $image_url );
        $this->assertTrue( file_exists($file) );
    }

    
}
