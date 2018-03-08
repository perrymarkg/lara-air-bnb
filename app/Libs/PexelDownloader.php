<?php

namespace App\Libs;

class PexelDownloader {

    private $storagePath;

    function __construct()
    {
        $this->storagePath = storage_path('app\pexels');

        if( !file_exists( $this->storagePath) )
            mkdir($this->storagePath);
    }

    function downloadImage( $image_url )
    {
        
        $filePath = $this->getFilePath( $image_url );
        
        $data = $this->getUrldata( $image_url, $filePath );
        
        $this->writeDataToFIle( $data, $filePath );

        return $filePath;
    }

    function getUrlData( $image_url, $file_path )
    {
        $ch = curl_init($image_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        //curl_setopt($ch, CURLOPT_VERBOSE, true); 
        curl_exec($ch);
        $result=curl_exec($ch);
        curl_close($ch); 
        return $result;
    }

    function writeDataToFile( $data, $filePath ){
        $fp = fopen($filePath, 'w+');
        fwrite($fp, $data);
        fclose($fp);
    }

    function getFileName( $image_url ) {
        $array = explode( '/', str_replace('https://', '', $image_url) );
        return end( $array );
    }
    
    function getFilePath( $image_url ) {
        return $this->storagePath . '/' . $this->getFileName( $image_url );
    }
}