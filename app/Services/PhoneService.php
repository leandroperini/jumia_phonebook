<?php

namespace App\Services;

use App\Repositories\PhoneRepository;

class PhoneService
{
    public function getPhonesByFilterPaginated(array $filters = []) {
        $phoneRepository = new PhoneRepository();
        return $phoneRepository->getPhonesWithItsCountryPaginated($filters['country_id'], $filters['is_valid']);
    }


}
