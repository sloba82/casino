<?php

namespace App\Helpers;

class Distance
{

    /**
     * @param float $latitudeFrom
     * @param float $longitudeFrom
     * @param float $latitudeTo
     * @param float $longitudeTo
     * @return float|int
     */
    public static function getLocationDistance(float $latitudeFrom, float $longitudeFrom, float $latitudeTo, float $longitudeTo): float|int
    {
        $earth_radius = 6378;

        $dLat = deg2rad($latitudeTo - $latitudeFrom);
        $dLon = deg2rad($longitudeTo - $longitudeFrom);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }
}
