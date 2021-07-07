<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PhoneDataRepository
{
    private $phoneDataTable = 'customer';

    /**
     * @param callable $callback The callback must receive an array like so, $callback(array $phoneData)
     * @param int      $iterationStepSize
     */
    public function iterateAll(callable $callback, $iterationStepSize = 100) {
        DB::table($this->phoneDataTable)->orderBy('id')->chunk($iterationStepSize, function ($data) use ($callback) {
            foreach ($data as $item) {
                $callback($item);
            }
        });
    }


}
