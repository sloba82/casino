<?php

namespace Tests\Unit;

use App\Models\Affiliate;
use App\Models\City;
use Tests\TestCase;
use App\Services\AffiliateServices;

class AffiliateDistanceTest extends TestCase
{

    private $affiliateServices;
    private $city;

    public function setUp(): void
    {
        parent::setUp();
        $this->affiliateServices = new AffiliateServices(new Affiliate());
        $this->city = new City();
    }


    public function test_affiliate_distance_from(): void
    {
        $searchCity = 'Dublin';
        $distance = 100;
        $cities = $this->city::GamblingOffices;

        $fromCity = [];
        foreach ($cities as $city) {
            if ($city['city'] == $searchCity) {
                $fromCity = $city;
            }
        }

        $selectedAffiliates = $this->affiliateServices->affiliatesFromOfficeDist($fromCity['latitude'], $fromCity['longitude'], $distance);

        foreach ($selectedAffiliates as $affiliates) {

            $this->assertGreaterThan(
                $affiliates['distance'],
                $distance,
                "Distance is more then {$distance} km"
            );
        }
    }
}
