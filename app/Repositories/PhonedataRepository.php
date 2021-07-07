<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PhonedataRepository
{
    private $phonedataTable = 'customer';

    /**
     * @param callable $callback The callback must receive an array like so, $callback(array $phoneData)
     * @param int      $iterationStepSize
     */
    public function iterateAll(callable $callback, $iterationStepSize = 100) {
        DB::table($this->phonedataTable)->orderBy('id')->chunk($iterationStepSize, function ($data) use ($callback) {
            foreach ($data as $item) {
                $callback($item);
            }
        });
    }


}
