<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Libs\GoogleMaps;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoogleMapsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGoogleMapEnvKey()
    {
        $key = env('GOOGLE_MAPS_API_KEY');
        $this->assertEquals('AIzaSyDQNfkCG2DL1TANV78v8nR7nf2clb9q-ag', $key);
    }

    public function testGeoCode()
    {
        $gmaps = new GoogleMaps();
        $geocode = $gmaps->toGeoCode('Bafastewaw');
        
        $this->assertFalse($geocode->hasResults());
        $this->assertFalse($geocode->getData());

        $geocode = $gmaps->toGeoCode('Baguio City');
        $this->assertTrue($geocode->hasResults());
        $this->assertArrayHasKey('lat', $geocode->getLatLng());
        $this->assertArrayHasKey('lng', $geocode->getLatLng());

    }

    public function testGenerateRandomPoint()
    {
        $lat = '16.4361881';
        $lng = '120.6323503';

        $res = GoogleMaps::generateRandomPoints($lat, $lng);
        dd($res);
    }
}
