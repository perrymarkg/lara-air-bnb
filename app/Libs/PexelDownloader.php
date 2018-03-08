<?php

namespace App\Libs;

class PexelDownloader {

    private $storagePath;
    private $additionalPath;

    function __construct()
    {
        $this->storagePath = storage_path('app\pexels');
        $this->createDownloadDir();
    }

    function createDownloadDir()
    {
        if( !file_exists( $this->storagePath) )
            mkdir($this->storagePath, 0755, true);
    }

    function setExtraPath( $extraPath )
    {
        $this->storagePath = $this->storagePath . '/' . $extraPath;
        $this->createDownloadDir();
    }

    function getStoragePath()
    {
        return $this->storagePath;
    }

    function downloadImages( $images )
    {
        foreach($images as $image){
            $this->downloadImage($image);
        }
    }

    function downloadImage( $imageUrl )
    {

        $filePath = $this->getFilePath( $imageUrl );
        
        $data = $this->getUrldata( $imageUrl, $filePath );
        
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