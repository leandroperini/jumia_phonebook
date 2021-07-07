<?php

namespace App\Repositories;

class CountryRepository
{
    private $countryCodesMap = [
        '237' => ['name'=>'Cameroon', 'validationCode'=>'[2368]\d{7,8}'],
        '251' => ['name'=>'Ethiopia', 'validationCode'=>'[1-59]\d{8}'],
        '212' => ['name'=>'Morocco', 'validationCode'=>'[5-9]\d{8}'],
        '258' => ['name'=>'Mozambique', 'validationCode'=>'[28]\d{7,8}'],
        '256' => ['name'=>'Uganda', 'validationCode'=>'\d{9}'],
    ];

    /**
     * @throws \Exception
     */
    public function getCountryNameByCode($code) : string {
        if ($this->countryCodesMap[$code] ?? false) {
            return $this->countryCodesMap[$code]['name'];
        }
        throw new \Exception('Unable to find a coutry name for this code.');
    }

    /**
     * @throws \Exception
     */
    public function getCountryValidationRuleByCode($code) : string {
        if ($this->countryCodesMap[$code] ?? false) {
            return $this->countryCodesMap[$code]['validationCode'];
        }
        throw new \Exception('Unable to find a coutry name for this code.');
    }


}
