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

}
