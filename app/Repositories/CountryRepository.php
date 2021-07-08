<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    private $countryCodesMap = [
        '237' => ['name'           => 'Cameroon',
                  'validationCode' => '[2368]\d{7,8}',
        ],
        '251' => ['name'           => 'Ethiopia',
                  'validationCode' => '[1-59]\d{8}',
        ],
        '212' => ['name'           => 'Morocco',
                  'validationCode' => '[5-9]\d{8}',
        ],
        '258' => ['name'           => 'Mozambique',
                  'validationCode' => '[28]\d{7,8}',
        ],
        '256' => ['name'           => 'Uganda',
                  'validationCode' => '\d{9}',
        ],
    ];

    /**
     * @throws \Exception
     */
    public function inferCountryNameByCode($code) : string {
        if ($this->countryCodesMap[$code] ?? false) {
            return $this->countryCodesMap[$code]['name'];
        }
        throw new \Exception('Unable to find a country name for this code.');
    }

    /**
     * @throws \Exception
     */
    public function inferCountryValidationRuleByCode($code) : string {
        if ($this->countryCodesMap[$code] ?? false) {
            return $this->countryCodesMap[$code]['validationCode'];
        }
        throw new \Exception('Unable to find a country name for this code.');
    }

    public function getCountryByCode($code) {
        return Country::firstOrNew([
            'code' => $code,
        ]);
    }

    public function getAll() {
        return Country::all();
    }

}
