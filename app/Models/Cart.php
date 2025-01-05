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
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    private static function getGuestId()
    {
        if (!session()->has('guest_id')) {
            session(['guest_id' => uniqid('guest_', true)]);
        }
        return session('guest_id');
    }

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
        $userId = Auth::check() ? Auth::id() : self::getGuestId();
        $cart = Cart::where('user_id', $userId)
            ->first();
        return $cart;
    }

    public static function getCartItems()
    {
        $cart = self::getCart();

        if (!$cart) {
            return [];
        }

        $cartItems = $cart ? $cart->items : [];
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
    public static function addItem($product, $selectedSize)
    {
        $cart = self::getCart();

        if (!$cart) {
            $userId = Auth::check() ? Auth::id() : session()->get('guest_id');
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->items = [];
        }

        $items = $cart->items;

        // Check if product with same size exists
        $existingProductIndex = collect($items)->search(function ($item) use ($product, $selectedSize) {
            return $item['product_id'] == $product->id && $item['size_id'] == $selectedSize;
        });

        if ($existingProductIndex !== false) {
            // Update quantity if product exists
            $items[$existingProductIndex]['quantity']++;
        } else {
            // Add the new product to the array
            $items[] = [
                'product_id' => $product->id,
                'size_id' => $selectedSize,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }

        $totalPrice = array_reduce($items, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Update the cart with the new items and total price
        $cart->items = $items;
        $cart->total_price = $totalPrice;
        $cart->save();
    }

    // Remove product from cart
    public static function removeProduct($productId, $sizeId)
    {
        $cart = self::getCart();
        $items = $cart->items;

        // Find the product with the same product_id and selected size
        $itemIndex = collect($items)->search(function ($item) use ($productId, $sizeId) {
            return $item['product_id'] == $productId && $item['size_id'] == $sizeId;
        });

        // If product is found, remove it from the array
        if ($itemIndex !== false) {
            unset($items[$itemIndex]);
            $items = array_values($items); // Re-index the array

            // Update the products array in the cart
            $cart->items = $items;

            // Recalculate the total price
            $totalPrice = array_reduce($items, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // Update the cart's total price and updated_at timestamp
            $cart->total_price = $totalPrice;
            $cart->updated_at = now();

            // Save the updated cart
            $cart->save();
        }
    }

    // Update product quantity in cart
    public static function updateProductQuantity($productId, $sizeId, $quantity)
    {
        $cart = self::getCart();

        $items = $cart->items;

        // Find the product with the same product_id and selected size
        $itemIndex = collect($items)->search(function ($item) use ($productId, $sizeId) {
            return $item['product_id'] == $productId && $item['size_id'] == $sizeId;
        });

        // If product is found, update the quantity
        if ($itemIndex !== false) {
            $items[$itemIndex]['quantity'] = $quantity;

            // Update the items array in the cart
            $cart->items = $items;

            // Update the cart's updated_at timestamp
            $cart->updated_at = now();

            // Save the updated cart
            $cart->save();
        }
    }

    // Clear the cart
    public static function clearCart()
    {
        $cart = self::getCart();

        if ($cart) {
            $cart->items = [];
            $cart->updated_at = now();
            $cart->save();
        }
    }


}
