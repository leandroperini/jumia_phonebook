<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public    $timestamps = false;
    protected $fillable   = [
        'number',
        'is_valid',
    ];

    protected $casts = [
        'is_valid' => 'boolean',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

}
