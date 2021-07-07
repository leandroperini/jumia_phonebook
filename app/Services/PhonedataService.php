<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Phone;
use App\Repositories\CountryRepository;
use App\Repositories\PhonedataRepository;
use Illuminate\Http\JsonResponse;

class PhonedataService
{

    /**
     * @param string $wholePhone
     *
     * @return array ["countryCode"=>"string", "phone"=>"string"]
     */
    public function splitPhoneElements(string $wholePhone) : array {
        return [
            "countryCode" => $this->extractCountryCode($wholePhone),
            "phone"       => $this->extractPhone($wholePhone),
        ];
    }

    public function extractCountryCode(string $wholePhone) : string {
        $match = '';
        preg_match("/\((?<countryCode>.+)\)/", $wholePhone, $match);
        return trim($match['countryCode'] ?? '');
    }

    public function extractPhone(string $wholePhone) : string {
        $match = '';
        preg_match("/\(.+\) (?<phone>.+)/", $wholePhone, $match);
        return trim($match['phone'] ?? '');
    }

    public function importPhoneData() {
        $PhonedataRepository = new PhonedataRepository();
        $CountryRepository   = new CountryRepository();
        $PhonedataRepository->iterateAll(function ($phoneData) use ($CountryRepository) {
            $phoneParts = $this->splitPhoneElements($phoneData->phone);

            $country                  = Country::firstOrNew([
                'code' => $phoneParts['countryCode'],
            ]);
            $country->name            = $CountryRepository->getCountryNameByCode($country->code);
            $country->validation_rule = $CountryRepository->getCountryValidationRuleByCode($country->code);
            $country->save();

            $customer = Customer::firstOrCreate([
                'name' => $phoneData->name,
            ]);

            $phone = Phone::firstOrNew([
                'number'   => $phoneParts['phone'],
            ]);
            $phone->country()->associate($country);
            $phone->customer()->associate($customer);
            $phone->save();

        }, 10);

        return JsonResponse::HTTP_NO_CONTENT;
    }
}
