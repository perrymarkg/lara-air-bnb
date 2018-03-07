<?php

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\User;
use App\Models\Listing;
use App\Models\ListingImage as Image;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    private $total_countries = 0;
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
        $this->create_user_files_dir();

        // Create
        $this->create_countries();

        $this->create_users();
    }

    public function create_countries()
    {
        print "Adding Countries ... ";
        $countries = json_decode( file_get_contents( base_path() . '/countries.json' ), true );
        foreach( $countries as $country ){
            $c = new Country( $country );
            $c->save();
        }
        $this->total_countries = count( $countries );
        print " done \n";
    }

    public function create_users()
    {
        print "Creating Users, listings, images ...";
        factory(User::class, $this->usersCount)
        ->create()
        ->each( function( $user ) {
            $this->create_user_storage( $user->id );
            $this->create_listing($user);
        } );
        print "done \n";
    }

    function create_user_files_dir()
    {
        if( !file_exists($this->path) )
            mkdir($this->path);
        
        $this->path = $this->path . '\\';
    }

    public function create_user_storage( $user_id ) 
    {
        $user_path = $this->path . md5($user_id);

        if( !file_exists($user_path) )
            mkdir($user_path);

    }

    public function create_listing( $user )
    {
        $listings = factory(Listing::class, $this->listingsCount)->make();

        foreach ( $listings as $listing ) {
                
            $listing['country_id'] = rand( 1, $this->total_countries );
            $user
            ->listings()
            ->save( $listing )
            ->each( function($listing) { 
                $this->create_listing_images( $listing );
             } );
        }
    }

    public function create_listing_images( $listing )
    {
        // @Todo: Improve
        // Not using factory here since we can't pass 
        // the user id to the $faker->image() method 
        // to save downloaded images from faker

        $image_path = $this->path . md5($listing->user->id);
        for( $x = 0; $x < $this->imagesCount; $x++ ) {
            $image = [];
            $image['image'] = $this->faker->image( $image_path , '600', '480', 'city') + rand(1,10);
            $image['description'] = $this->faker->paragraph();
            $image['order'] = $x+1;
            $listing->images->save( $image );
        }

    }

    
}
