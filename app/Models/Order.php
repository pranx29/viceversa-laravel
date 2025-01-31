<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const SHIPPING_COST = 250.00;
    protected $fillable = ['user_id', 'address_id', 'status', 'guest_email', 'shipping_cost'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function total()
    {
        return $this->items->sum(function($item){
            return $item->price * $item->quantity;
        }) + $this->shipping_cost;
    }
}
