<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function getCustomerByName($name) : Customer {
        return Customer::firstOrNew([
            'name' => $name,
        ]);
    }

}
