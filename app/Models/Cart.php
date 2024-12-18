<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'carts';

    protected $fillable = [
        'user_id',
        'guest_id',
        'products',
        'updated_at',
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public static function getCart()
    {
        $user_id = Auth::check() ? Auth::id() : null;
        $guest_id = !$user_id ? session()->getId() : null;

        $cart = Cart::where('user_id', $user_id)
            ->orWhere('guest_id', $guest_id)
            ->first();

        return $cart;
    }

    public static function getCartItems()
    {
        $cart = self::getCart();
        // convert the JSON to an array
        $cartItems = $cart ? $cart->products : [];

        return $cartItems;
    }

    // Get cart count products * quantity
    public static function getCartCount()
    {
        $cartItems = self::getCartItems();
        $cartCount = 0;

        foreach ($cartItems as $item) {
            $cartCount += $item['quantity'];
        }

        return $cartCount;
    }

    // Add product to cart
    public static function addProduct($product, $selectedSize)
    {
        $cart = self::getCart();

        $products = $cart->products;

        // Check if product with same size exists
        $existingProductIndex = collect($products)->search(function ($item) use ($product, $selectedSize) {
            return $item['product_id'] == $product->id && $item['size']['id'] == $selectedSize;
        });

        if ($existingProductIndex !== false) {
            // Update quantity if product exists
            $products[$existingProductIndex]['quantity']++;
        } else {
            // Add the new product to the array
            $products[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'size' => [
                    'id' => $selectedSize,
                    'name' => $product->sizes->where('id', $selectedSize)->first()->name,
                ],
                'quantity' => 1,
                'price' => $product->price,
                'discount' => $product->discount,
                'image' => $product->primaryImage(),
            ];
        }

        $cart->products = $products;
        $cart->updated_at = now();
        $cart->save();
    }

    // Remove product from cart
    public static function removeProduct($productId, $sizeId)
    {
        $cart = self::getCart();

        $products = $cart->products;

        // Find the product with the same product_id and selected size
        $productIndex = collect($products)->search(function ($item) use ($productId, $sizeId) {
            return $item['product_id'] == $productId && $item['size']['id'] == $sizeId;
        });

        // If product is found, remove it from the array
        if ($productIndex !== false) {
            unset($products[$productIndex]);
            $products = array_values($products); // Re-index the array

            // Update the products array in the cart
            $cart->products = $products;

            // Update the cart's updated_at timestamp
            $cart->updated_at = now();

            // Save the updated cart
            $cart->save();
        }
    }

    // Update product quantity in cart
    public static function updateProductQuantity($productId, $sizeId, $quantity)
    {
        $cart = self::getCart();

        $products = $cart->products;

        // Find the product with the same product_id and selected size
        $productIndex = collect($products)->search(function ($item) use ($productId, $sizeId) {
            return $item['product_id'] == $productId && $item['size']['id'] == $sizeId;
        });

        // If product is found, update the quantity
        if ($productIndex !== false) {
            $products[$productIndex]['quantity'] = $quantity;

            // Update the products array in the cart
            $cart->products = $products;

            // Update the cart's updated_at timestamp
            $cart->updated_at = now();

            // Save the updated cart
            $cart->save();
        }
    }


}
