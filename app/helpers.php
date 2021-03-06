<?php

if (!function_exists('random_color_part')){
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('random_color')){
    function random_color() {
        return '#'.random_color_part() . random_color_part() . random_color_part();
    }
}

if (!function_exists('random_color_array')){
    function random_color_array($count) {
        $color_array = [];

        for($i = 0; $i < $count; $i++)
            $color_array[$i] = random_color();

        return $color_array;
    }
}
