<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createCountries();
    }

    public function createCountries()
    {
        $this->command->info('Creating Countries ... ');
        $countries = \Helper::readJSON( base_path() . '/countries.json' );
        foreach( $countries as $country ){
            $c = new Country( $country );
            $c->save();
        }
        $this->totalCountries = count( $countries );
        $this->command->info('Done');
    }
}
