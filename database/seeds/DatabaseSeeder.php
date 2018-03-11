<?php

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Listing;
use App\Models\ListingImage as Image;
use App\Models\Option;

use App\Libs\Copier;
use App\Libs\PexelDownloader;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    private $totalCountries = 0;
    private $hostsCount = 1;
    private $listingsCount = 1;
    private $hostImagesCount = 5;

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
        $this->createCountries();

        $this->downloadSampleImages();

        $this->createHosts();
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
        if( Storage::exists('.sample-houses') ) {
            print "Sample houses already downloaded \n";
            return;
        }

        $images = array_map( function( $images){
            return $images['path'];
        }, $this->houseImages);
        $this->pexel->downloadImages( $images, 'houses' );
        Storage::put('.sample-houses', 'Sample Houses Downloaded!');
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
            $this->createHostImages( $user );
            $this->createListing($user);
        } );
        print "done \n";
    }

    public function createHostImages( $user ) 
    {
        $images = Storage::files('sample_images/houses');
        shuffle( $images );
        $images = array_slice( $images, 0, $this->hostImagesCount );
        foreach($images as $image){
            $copied_file_path = Copier::copy( $image, 'media/' . basename($image) );
            $user->images()->save( new UserImage( ['filename' => basename($copied_file_path)] ) );
        }
    }

    public function createListing( $user )
    {
        $listings = factory(Listing::class, $this->listingsCount)->make();

        foreach ( $listings as $listing ) {
                
            $listing['country_id'] = rand( 1, $this->totalCountries );
            $user
            ->listings()
            ->save( $listing )
            ->each( function($l) { 
                $this->assignListingImage( $l );
             } );
        }
    }

    public function assignListingImage( $listing )
    {
        
        // Get User Id from listing
        $user_id = $listing->user->id;
        // Get Images from user_images
        $images = UserImage::inRandomOrder()
        ->where('user_id', $user_id)
        ->take(5)
        ->get();
        $ctr = 0;
        
        foreach($images as $image) {
            $listingImage['title'] = pathinfo($image['filename'], PATHINFO_FILENAME);
            $listingImage['description'] = $this->faker->words(rand(1,3), true);
            $listingImage['sort_order'] = $ctr;
            $listingImage['user_image_id'] = $image['id'];
            
            $listing->images()->save( new Image($listingImage) );
            $ctr++;
        }
        
        

    }

        
}
