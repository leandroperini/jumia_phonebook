<?php

namespace App\Services;


use App\Repositories\CountryRepository;

class CountryService
{
    public function getAllCountries() {
        $countryRepository = new CountryRepository();
        return $countryRepository->getAll();
    }


}
