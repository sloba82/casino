<?php

namespace App\Services;

use App\Helpers\Distance;
use App\Models\Affiliate;

class AffiliateServices
{

    private $affiliate;

    public function __construct(Affiliate $affiliate)
    {
        $this->affiliate = $affiliate;
    }

    public function affiliatesFromOfficeDist(float $latitudeFrom, float $longitudeFrom, int $matchDis, string $sort = 'ASC')
    {

        $allAffiliates = $this->affiliate->getAffiliates();

        $matchDistanceArray = [];
        foreach ($allAffiliates as $affiliate) {
            $distance = Distance::getLocationDistance($latitudeFrom, $longitudeFrom, $affiliate['latitude'], $affiliate['longitude']);
            if ($distance <= $matchDis) {
                $affiliate['distance'] = $distance;
                $matchDistanceArray[] = $affiliate;
            }
        }

        usort($matchDistanceArray, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'ASC':
                    return $a['affiliate_id'] > $b['affiliate_id'];
                    break;
                case 'DESC':
                    return $a['affiliate_id'] < $b['affiliate_id'];
                    break;
            }
        });

        return $matchDistanceArray;
    }



    public function test()
    {
        return 'test';
    }
}
