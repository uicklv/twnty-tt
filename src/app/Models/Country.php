<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function weather()
    {
        return $this->hasone(Weather::class);
    }
}
