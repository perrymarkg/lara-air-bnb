<?php

use Illuminate\Database\Seeder;
use App\Libs\PexelDownloader;

class ImagesDownloader extends Seeder
{
    private $path;

    private $house_images;

    private $pexel;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->path = storage_path('app\user_files');
        
        $this->house_images = \Helper::readJSON( base_path() . '/house-images.json' );

        $this->pexel = new PexelDownloader();

        $this->downloadSampleImages();
    }

    public function downloadSampleImages()
    {
        $this->command->info('Download Sample Images ...');
        if( Storage::exists('.sample-houses') ) {
            $this->command->info('Images downloaded already ...');
            return;
        }

        $images = array_map( function( $images){
            return $images['path'];
        }, $this->houseImages);
        $this->pexel->downloadImages( $images, 'houses' );
        Storage::put('.sample-houses', 'Sample Houses Downloaded!');
        $this->command->info('Images downloaded already ...');
    }

}
