<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Libs\Copier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CopierTest extends TestCase
{
    private $sample_images_dir;
    private $houses;
    private $houses_total;


    public function setUp()
    {
        parent::setUp();
        $this->sample_images_dir = storage_path('app/sample_images');
        $this->houses = Storage::files('sample_images/houses');
        $this->houses_total = count($this->houses);
    }

    public function testSampleImagesDirExist()
    {
        $houses_dir = $this->sample_images_dir . '/houses';
        $this->assertTrue( file_exists( $houses_dir ) );        
    }

    public function testSampleImagesExist()
    {
        $this->assertTrue( $this->houses_total >= 1 );
    }

    public function testCopyImage()
    {
        $file_to_copy = $this->houses[0];
        $test_file = Copier::copy( $file_to_copy, 'media/' . basename($file_to_copy) );
        $this->assertTrue( Storage::exists($test_file) );
        Storage::delete( $test_file);
    }

    public function testDuplicateName()
    {
        $test_files = [];
        $file_to_copy = $this->houses[0]; // sample_images/houses/{imagefile}.{ext}

        $dest = 'media/' . basename( $file_to_copy );
        $test_files[] = Copier::copy($file_to_copy, $dest);
        $new_file = Copier::duplicateName( 'app/' . $dest);
        $this->assertNotEquals( $dest, $new_file );
        
        $copied_file = Copier::copy($file_to_copy, $dest);
        $this->assertTrue( Storage::exists($copied_file) ) ;
        $test_files[] = $copied_file;
        
        Storage::delete($test_files);
    }

    
    
}
