<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'discount', 'is_active', 'category_id', 'slug'];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')->withPivot('quantity_in_stock');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('order', 1)->first()->path ?? null;
    }

    public function secondaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('order', 2)->first()->path ?? null;
    }

    public function totalStock()
    {
        return $this->sizes->sum('quantity_in_stock');
    }

}
