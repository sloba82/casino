<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Services\AffiliateServices;
use App\Http\Requests\AffiliateSearchRequest;
use Illuminate\View\View;

class AffiliateController extends Controller
{

    /**
     * @var AffiliateServices
     */
    private $affiliateServices;

    /**
     * AffiliateController constructor.
     * @param AffiliateServices $affiliateServices
     */
    public function __construct(AffiliateServices $affiliateServices)
    {
        $this->affiliateServices = $affiliateServices;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home', [
            'offices' => City::GamblingOffices,
        ]);
    }

    /**
     * @param AffiliateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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
