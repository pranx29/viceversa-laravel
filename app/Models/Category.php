<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Accessor for the image attribute
    public function getImageAttribute($value)
    {
        // If the image is a URL, return it as it is
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // Otherwise, return the full URL to the image in storage
        return url('storage/' . $value);
    }
}
