<?php

namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository
{
    public function getPhoneByNumber($number) {
        return Phone::firstOrNew([
            'number' => $number,
        ]);
    }

    public function getPhonesWithItsCountryPaginated($countryId = -1, $isValid = -1, $pageSize = 5) {
        $query = Phone::with('country');
        if ($countryId > -1) {
            $query->where('country_id', $countryId);
        }
        if ($isValid > -1) {
            $query->where('is_valid', $isValid);
        }
        return $query->simplePaginate($pageSize);
    }

}
