<?php

namespace App\Libs;

class PexelDownloader {

    private $storagePath;
    private $additionalPath;

    function __construct( $defaultPath = 'app\sample_images' )
    {
        $this->storagePath = storage_path( $defaultPath );
        $this->createDownloadDir();
    }

    function createDownloadDir()
    {
        if( !file_exists( $this->storagePath) )
            mkdir($this->storagePath, 0755, true);
    }

    function getStoragePath()
    {
        return $this->storagePath;
    }

    function downloadImages( $images, $folder = '' )
    {
        $result = [];
        foreach($images as $image){
            $result[] = $this->downloadImage($image, $folder );
        }
        return $result;
    }

    function downloadImage( $imageUrl, $folder = '' )
    {
        // Alternative http://image.intervention.io/api/make 
        if( $folder && !file_exists( $this->storagePath . '/' . $folder ) ){
            mkdir( $this->storagePath . '/' . $folder, 0755, true );
        }

        if( $folder )
            $folder = $folder . '/';

        $filePath = $this->getFilePath( $imageUrl, $folder );
        
        $data = $this->getUrldata( $imageUrl, $filePath );
        
        $this->writeDataToFIle( $data, $filePath );

        return $filePath;
    }

    function getUrlData( $image_url )
    {
        /* $ch = curl_init($image_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        //curl_setopt($ch, CURLOPT_VERBOSE, true); 
        curl_exec($ch);
        $result=curl_exec($ch);
        curl_close($ch); 
        return $result; */
        return file_get_contents($image_url);
    }

    function writeDataToFile( $data, $filePath ){
        $fp = fopen($filePath, 'w+');
        fwrite($fp, $data);
        fclose($fp);
    }

    function getFileName( $image_url ) {

        if (strpos($image_url, '?') !== false) {
            $t = explode('?', $image_url);
            $image_url = $t[0];            
        }
        return basename($image_url);
    }
    
    function getFilePath( $image_url, $folder = '') {
        return $this->storagePath . '/' . $folder . $this->getFileName( $image_url );
    }

}