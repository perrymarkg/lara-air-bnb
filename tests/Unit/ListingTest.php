<?php

namespace Tests\Unit;

use PHPUnit\Framework\Constraint\IsType;

use Tests\TestCase;
use App\Models\Listing;
use App\Models\Country;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testRetrieveCountryFromListing() {

        $listing = Listing::find(3);
        $this->assertTrue( is_int($listing->country_id) );
        $country = Country::find($listing->country_id);
        $this->assertEquals( $listing->country->name, $country->name );

    }
}
