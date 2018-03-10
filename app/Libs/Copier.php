<?php

namespace App\Libs;

use Illuminate\Support\Facades\Storage;

class Copier {

    public static function copy($source, $dest)
    {
        $file_path = static::duplicateName( $dest );
        Storage::copy($source, $file_path );
        return $file_path;
    }

    public static function duplicateName( $dest_path )
    {
        $path_info = pathinfo( $dest_path );
        $ctr = 1;

        while( Storage::exists($dest_path) ) {
            $filename = $path_info['filename'] . '_' . $ctr . '.' . $path_info['extension'];
            $dest_path = dirname($dest_path) . '/' . $filename;
            $ctr++;
        }
        return $dest_path;
    }

}