<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'postal_code',
        'session_id',
        'save_info',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
