<?php

namespace App\Models;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'is_active', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function primaryImage()
    {
        $variant = $this->variants()->first();
        return $variant ? $variant->images()->orderBy('order')->first() : null;
    }

    public function hoverImage()
    {
        $variant = $this->variants()->first();
        return $variant ? $variant->images()->orderBy('order', 'desc')->first() : null;
    }


}