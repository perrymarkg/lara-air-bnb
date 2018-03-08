<?php

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\User;
use App\Models\Listing;
use App\Models\ListingImage as Image;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    private $totalCountries = 0;
    private $usersCount = 1;
    private $listingsCount = 1;
    private $imagesCount = 1;
    private $faker;

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
        $this->createUserFilesDir();

        // Create
        $this->createCountries();

        $this->createUsers();
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

    public function createUsers()
    {
        print "Creating Users, listings, images ...";
        factory(User::class, $this->usersCount)
        ->create()
        ->each( function( $user ) {
            $this->createUserStorage( $user->id );
            $this->createListing($user);
        } );
        print "done \n";
    }

    function createUserFilesDir()
    {
        if( !file_exists($this->path) )
            mkdir($this->path);
        
        $this->path = $this->path . '\\';
    }

    public function createUserStorage( $user_id ) 
    {
        $user_path = $this->path . md5($user_id);

        if( !file_exists($user_path) )
            mkdir($user_path);

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
                $this->createListingImages( $listing );
             } );
        }
    }

    public function createListingImages( $listing )
    {
        // @Todo: Improve
        // Not using factory here since we can't pass 
        // the user id to the $faker->image() method 
        // to save downloaded images from faker

        $imagePath = $this->path . md5($listing->user->id);
        for( $x = 0; $x < $this->imagesCount; $x++ ) {
            $image = [];
            $image['image'] = $this->faker->image( $imagePath , '600', '480', 'city') . rand(1,10);
            $image['description'] = $this->faker->paragraph();
            $image['order'] = $x+1;
            $listing->images->save( $image );
        }

    }

    public function downloadSampleImages()
    {

    }

    
}
