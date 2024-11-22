<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_address',
        'address_line_2',
        'city',
        'province',
        'postal_code',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
