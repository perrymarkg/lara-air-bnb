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
        return $loc;
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

    public static function generateRandomPoints($lat, $lng)
    {
        $radius = 500 / 111000;
        return 'test';
    }

}