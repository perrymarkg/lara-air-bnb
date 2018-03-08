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
        parent::setUp();
        $this->downloader = new PexelDownloader();
    }

    public function testGetFileNameFromUrl()
    {
        $downloader = new PexelDownloader();
        $image_url = 'https://static.pexels.com/photos/269077/pexels-photo-269077.jpeg';

        $res = $downloader->getFileName( $image_url );
        $this->assertEquals( $res, 'pexels-photo-269077.jpeg');
    }
    
    public function testCanDownloadImage()
    {
        $file = $this->downloader->downloadImage( $this->image_url );
        $this->assertTrue( file_exists($file) );
    }

    public function testCanDownoadImageToFolder()
    {
        $file = $this->downloader->downloadImage( $this->image_url, 'houses');
        $this->assertTrue( file_exists($file) );
    }

    public function testCanDownloadMultipleImages()
    {
        $images = [
            'https://static.pexels.com/photos/279719/pexels-photo-279719.jpeg',
            'https://static.pexels.com/photos/323775/pexels-photo-323775.jpeg'
        ];

        $results = $this->downloader->downloadImages( $images, 'houses' );
        foreach($results as $file)
            $this->assertTrue( file_exists($file) );
    }

    
}
