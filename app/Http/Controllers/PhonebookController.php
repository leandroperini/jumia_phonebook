<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Services\PhoneService;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{

    public function listPhones(PhoneService $phoneService, CountryService $countryService, Request $request) {
        $filterState   = $request->query('filterState', '-1');
        $filterCountry = $request->query('filterCountry', '-1');
        return view('phonebook', [
            'phones'        => $phoneService->getPhonesByFilterPaginated([
                "is_valid"   => $filterState,
                "country_id" => $filterCountry,
            ])->appends([
                'filterState'   => $filterState,
                'filterCountry' => $filterCountry,
            ]),
            'filterState'   => $request->query('filterState', '-1'),
            'filterCountry' => $request->query('filterCountry', '-1'),
            'countries'     => $countryService->getAllCountries(),
        ]);
    }
}
