<?php

namespace App\Factories;

use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerFactory
{
    /**
     * @var \App\Repositories\CountryRepository|\App\Repositories\CustomerRepository
     */
    private $customerRepository;
    /**
     * @var array
     */
    private $phones;

    /**
     * CountryFactory constructor.
     */
    public function __construct(CustomerRepository $customerRepository = null) {
        $this->customerRepository = $customerRepository ?? new CustomerRepository();
    }

    public function newCustomerByName($name) : Customer {
        $customer = $this->customerRepository->getCustomerByName($name);
        $customer = $this->addRelationsIfExists($customer);
        $this->resetRelationships();
        return $customer;
    }

    public function setRelatedPhones(array $phones) {
        $this->phones = $phones;
    }

    private function addRelationsIfExists(Customer $customer) : Customer {
        if (!empty($this->phones)) {
            $customer->phones()->saveMany($this->phones);
        }
        return $customer;
    }

    private function resetRelationships() {
        $this->phones = null;
    }
}
