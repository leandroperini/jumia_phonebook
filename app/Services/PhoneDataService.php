<?php

namespace App\Services;

use App\Factories\CountryFactory;
use App\Factories\CustomerFactory;
use App\Factories\PhoneFactory;
use App\Repositories\PhoneDataRepository;
use Illuminate\Support\Facades\DB;

class PhoneDataService
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

    public function importPhoneData() : bool {
        try {
            $phoneDataRepository = new PhoneDataRepository();

            $countryFactory  = new CountryFactory();
            $customerFactory = new CustomerFactory();
            $phoneFactory    = new PhoneFactory();

            DB::transaction(function () use ($countryFactory, $phoneFactory, $customerFactory, $phoneDataRepository) {

                $phoneDataRepository->iterateAll(function ($phoneData) use ($countryFactory, $phoneFactory, $customerFactory) {
                    $phoneParts = $this->splitPhoneElements($phoneData->phone);

                    $country = $countryFactory->newCountryByCode($phoneParts['countryCode']);
                    $country->save();

                    $customer = $customerFactory->newCustomerByName($phoneData->name);
                    $customer->save();

                    $phoneFactory->setRelatedCountry($country);
                    $phoneFactory->setRelatedCustomer($customer);
                    $phone = $phoneFactory->newPhoneByNumber($phoneParts['phone']);
                    $phone->save();

                }, 10);
            });
            return true;
        } catch (\Throwable $t) {
            logger($t->getMessage(),$t->getTrace());
            return false;
        }
    }
}
