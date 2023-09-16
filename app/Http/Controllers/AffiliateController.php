<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Services\AffiliateServices;
use App\Http\Requests\AffiliateSearchRequest;

class AffiliateController extends Controller
{

    private $affiliateServices;

    public function __construct(AffiliateServices $affiliateServices)
    {
        $this->affiliateServices = $affiliateServices;
    }


    public function index()
    {
        return view('home', [
            'offices' => City::GamblingOffices,
        ]);
    }

    public function list(AffiliateSearchRequest $request)
    {
        $officeVal = explode('_', $request->get('office'));
        $distanceVal = $request->get('distance');

        $affiliates = $this->affiliateServices->affiliatesFromOfficeDist((float) $officeVal[0], (float) $officeVal[1], (int) $distanceVal);
        return view('_includes.search_result', [
            'affiliates' =>  $affiliates
        ]);
    }
}
