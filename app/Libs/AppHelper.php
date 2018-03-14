<?php

namespace App\Libs;

use Illuminate\Support\Facades\Route;

class AppHelper {

    public static function test($var = 'Testing var')
    {
        return 'The Variable: ' .$var;
    }

    public static function isActiveRoute( $allowed_routes, $class = 'active')
    {
        $current_route = Route::currentRouteName();

        if( is_array($allowed_routes) )
            return in_array($current_route, $allowed_routes) ? $class : 'test';
        
        return $allowed_routes === $current_route ? $class : 'test';
    }

    public static function displayInputValue($old, $value, $format = NULL)
    {
        $result = $old ? $old : $value;

        if( $format == 'price' && is_float($result) ) {
            $result = number_format($result, 2, '.', ',');
        }
            
        return $result;
    }

    public static function setSelectedOption($select_value, $old, $value)
    {
        $result = $old ? $old : $value;

        return $select_value == $result ? 'selected' : '';
    }

    public static function readJSON( $file )
    {
        return json_decode( file_get_contents( $file ), true );
    }
}