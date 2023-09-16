<?php

namespace App\Services;

use App\Helpers\Distance;
use App\Models\Affiliate;

class AffiliateServices
{

    /**
     * @var Affiliate
     */
    private $affiliate;

    /**
     * AffiliateServices constructor.
     * @param Affiliate $affiliate
     */
    public function __construct(Affiliate $affiliate)
    {
        $this->affiliate = $affiliate;
    }

    /**
     * @param float $latitudeFrom
     * @param float $longitudeFrom
     * @param int $matchDis
     * @param string $sort
     * @return array
     */
    public function affiliatesFromOfficeDist(float $latitudeFrom, float $longitudeFrom, int $matchDis, string $sort = 'ASC'): Array
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

}
