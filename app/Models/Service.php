<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
    'name',
    'description',
    'unit_price',
    'tax_rate',
    'sku',
];

}
