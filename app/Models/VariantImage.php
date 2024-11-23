<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VariantImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_variant_id',
        'image_path',
        'order',
        'is_active',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
