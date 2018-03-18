<?php

namespace App\Libs;

use GuzzleHttp\Client;

class GoogleMaps {

    private $client;

    private $url;

    private $data;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = 'https://maps.googleapis.com/maps/api/geocode/json?key=' .env('GOOGLE_MAPS_API_KEY');
    }

    public function toGeoCode($address)
    {
        $url = $this->url . '&address=' . urlencode($address);

        $response = $this->client->get( $url )->getBody();

        $this->data = json_decode($response);

        return $this;
    }

    public function getLatLng()
    {
        if( $this->hasResults() ){
            $loc['lat'] = $this->data->results[0]->geometry->location->lat;
            $loc['lng'] = $this->data->results[0]->geometry->location->lng;
            return $loc;
        }
        return false;
    }

    public function getData()
    {
        return $this->hasResults() ? $this->data : false;
    }

    public function hasResults()
    {
        return !empty( $this->data )
        && $this->data->status != 'ZERO_RESULTS' 
        && isset( $this->data->results ) 
        && isset( $this->data->results[0] ) ? true : false; 
    }

    public static function generateRandomPoints($lat, $lng, $km = 5)
    {
        // Convert all latitudes and longitudes to radians.
        $latR = deg2rad($lat);
        $lngR = deg2rad($lng);

        // rand1 and rand2 are unique random numbers generated in the range 0 to 1.0.
        $rand1 = lcg_value();
        $rand2 = lcg_value();
        
        $maxdist= $km / 6372.796924;

        $dist = acos($rand1*(cos($maxdist) - 1) + 1);

        $brg = 2*(3.14)*$rand2;

        $lat = asin(sin($latR)*cos($dist) + cos($latR)*sin($dist)*cos($brg));
        $lon = $lngR + atan2(sin($brg)*sin($dist)*cos($latR), cos($dist)-sin($latR)*sin($latR));

        return compact('latR', 'lngR', 'rand1', 'rand2', 'maxdist', 'dist', 'lat', 'lon');
    }

}