<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    protected function priceEur(): Attribute 
    {
        return Attribute::make(
            get: fn() => (new CurrencyService())->convert($this->price, 'usd', 'eur'),
        );
    } 
}
