<?php

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\User;
use App\Models\Listing;
use App\Models\ListingImage as Image;
use App\Models\Option;
use App\Libs\PexelDownloader;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    private $totalCountries = 0;
    private $hostsCount = 1;
    private $listingsCount = 1;
    private $imagesCount = 1;

    private $houseImages;
    private $faker;

    private $pexel;

    private $path;

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Setup
        $this->faker = Faker::create();
        
        $this->path = storage_path('app\user_files');
        
        $this->houseImages = $this->readJsonFile( base_path() . '/house-images.json' );

        $this->pexel = new PexelDownloader();

        // Create
        //$this->createCountries();

        $this->downloadSampleImages();

        //$this->createHosts();
    }

    public function readJsonFile( $file )
    {
        return json_decode( file_get_contents( $file ), true );
    }

    public function createCountries()
    {
        print "Adding Countries ... ";
        $countries = $this->readJsonFile( base_path() . '/countries.json' );
        foreach( $countries as $country ){
            $c = new Country( $country );
            $c->save();
        }
        $this->totalCountries = count( $countries );
        print " done \n";
    }

    public function downloadSampleImages()
    {
        print "Download Sample Images ... \n";
        if( file_exists(storage_path('app\\.sample-houses')) ){
            print "Sample houses already downloaded \n";
            return;
        }

        $images = array_map( function( $images){
            return $images['path'];
        }, $this->houseImages);
        $this->pexel->downloadImages( $images, 'houses' );
        Storage::disk('local')->put('.sample-houses', 'Sample Houses Downloaded!');
        print "Done \n";
    }

    public function createHosts()
    {
        print "Creating Hosts, listings, images ...";
        factory(User::class, $this->hostsCount)
        ->create()
        ->each( function( $user ) {
            $user->user_type = 'host';
            $user->save();
            $this->createHostStorage( $user->id );
            $this->createListing($user);
        } );
        print "done \n";
    }

    public function createHostStorage( $host_id ) 
    {
        $host_path = $this->path . '/' . md5($host_id);

        if( !file_exists($host_path) )
            mkdir($host_path, 0755, true);

    }

    public function createListing( $user )
    {
        $listings = factory(Listing::class, $this->listingsCount)->make();

        foreach ( $listings as $listing ) {
                
            $listing['country_id'] = rand( 1, $this->totalCountries );
            $user
            ->listings()
            ->save( $listing )
            ->each( function($listing) { 
                //$this->createListingImages( $listing );
             } );
        }
    }

    public function createListingImages( $listing )
    {
        // @Todo: Improve
        // Not using factory here since we can't pass 
        // the user id to the $faker->image() method 
        // to save downloaded images from faker

        for( $x = 0; $x < $this->imagesCount; $x++ ) {
            $image = [];
            $imagePath = $this->pexel->downloadImage( $this->houseImages[0]['path'], md5($listing->user->id) );
            $image['image'] = basename($imagePath);
            $image['description'] = $this->faker->words(3, true);
            $image['sort_order'] = $x+1;
            $listing->images()->save( new Image($image) );
        }

    }

        
}
