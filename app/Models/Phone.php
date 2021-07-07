<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'number',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function isValid() {
        return preg_match($this->country()->validation_rule, $this->number) === 1;
    }
}
