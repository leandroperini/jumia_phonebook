<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'validation_rule',
    ];
    public function phones() {
        return $this->hasMany(Phone::class);
    }
}
