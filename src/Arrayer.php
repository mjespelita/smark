<?php

namespace Smark\Smark;

class Arrayer
{
    public static function flattenArray($array) {
        $result = [];
        array_walk_recursive($array, function($a) use (&$result) { $result[] = $a; });
        return $result;
    }

    public static function uniqueMultidimensionalArray($array, $key) {
        $temp_array = [];
        $i = 0;
        $key_array = [];

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
