<?php

namespace App\Factories;

use App\Models\Country;
use App\Repositories\CountryRepository;

class CountryFactory
{
    /**
     * @var \App\Repositories\CountryRepository
     */
    private $countryRepository;

    /**
     * CountryFactory constructor.
     */
    public function __construct(CountryRepository $countryRepository = null) {
        $this->countryRepository = $countryRepository ?? new CountryRepository();
    }

    /**
     * @throws \Exception
     */
    public function newCountryByCode($code) : Country {
        $country                  = $this->countryRepository->getCountryByCode($code);
        $country->name            = $this->countryRepository->inferCountryNameByCode($code);
        $country->validation_rule = $this->countryRepository->inferCountryValidationRuleByCode($code);
        return $country;
    }
}
