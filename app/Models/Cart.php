<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mongodb';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'guest_id',
        'products',
    ];

    protected $casts = [
        'products' => 'array', 
        'total_price' => 'float',
    ];

    public function updateTotalPrice()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product['total_price'];
        }
        $this->total_price = $total;
        $this->save();
    }

    
}
