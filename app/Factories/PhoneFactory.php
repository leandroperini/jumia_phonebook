<?php

namespace App\Factories;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Phone;
use App\Repositories\PhoneRepository;

class PhoneFactory
{
    /**
     * @var \App\Models\Country
     */
    private $country;
    /**
     * @var \App\Models\Customer
     */
    private $customer;
    /**
     * @var \App\Repositories\PhoneRepository
     */
    private $phoneRepository;

    /**
     * CountryFactory constructor.
     */
    public function __construct(PhoneRepository $phoneRepository = null) {
        $this->phoneRepository = $phoneRepository ?? new PhoneRepository();
    }

    public function newPhoneByNumber($number) : Phone {
        $phone           = $this->phoneRepository->getPhoneByNumber($number);
        $phone           = $this->addRelationsIfExists($phone);
        $phone->is_valid = $this->checkValidity($number);
        $this->resetRelationships();
        return $phone;
    }

    public function checkValidity($number) {
        $validationRule = '.*';
        if ($this->country) {
            $validationRule = $this->country->validation_rule;
        }
        return preg_match('/' . $validationRule . '/', $number) === 1;
    }

    public function setRelatedCountry(Country $country) {
        $this->country = $country;
    }

    public function setRelatedCustomer(Customer $customer) {
        $this->customer = $customer;
    }

    private function addRelationsIfExists(Phone $phone) : Phone {
        if ($this->customer) {
            $phone->customer()->associate($this->customer);
        }
        if ($this->country) {
            $phone->country()->associate($this->country);
        }
        return $phone;
    }

    private function resetRelationships() {
        $this->country  = null;
        $this->customer = null;
    }
}
