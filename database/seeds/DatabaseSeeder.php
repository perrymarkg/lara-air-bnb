<?php

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\User;
use App\Models\Listing;

class DatabaseSeeder extends Seeder
{
    private $total_countries = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Countries
        print "Adding Countries ... ";
        $countries = json_decode( file_get_contents( base_path() . '/countries.json' ), true );
        foreach( $countries as $country ){
            $c = new Country( $country );
            $c->save();
        }
        $this->total_countries = count( $countries );
        print " done \n";

        // Create 3 users, foreach users create 5 listings.
        print "Creating Users and listings ...";
        factory(User::class, 3)
        ->create()
        ->each( function($user) {
            
            $listings = factory(Listing::class, 5)->make();

            foreach ( $listings as $listing ) {
                $listing['country_id'] = rand( 1, $this->total_countries );
                $user->listings()->save( $listing );
            }
            
        } );
        print "done \n";
    }
}
