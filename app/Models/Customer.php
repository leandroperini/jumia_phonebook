<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function phones() {
        return $this->hasMany(Phone::class);
    }
}
