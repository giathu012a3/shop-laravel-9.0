<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;

class CartService
{
    public function add(Product $product, User $user, int $quantity)
    {
        if ($quantity > $product->quantity) {
            throw new Exception('Số lượng sản phẩm bạn muốn mua vượt quá số lượng còn lại. Vui lòng chọn số lượng nhỏ hơn.');
        }

        $existingCart = Cart::where('product_id', $product->id)
                            ->where('user_id', $user->id)
                            ->first();

        $price = ($product->discount_price && $product->discount_price > 0)
            ? $product->discount_price
            : $product->price;

        if ($existingCart) {
            $existingCart->quantity += $quantity;
            $existingCart->price = $price * $existingCart->quantity;
            $existingCart->save();
            return $existingCart;
        }

        return Cart::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'user_id' => $user->id,
            'product_title' => $product->title,
            'product_id' => $product->id,
            'price' => $price * $quantity,
            'image' => $product->image,
            'quantity' => $quantity,
        ]);
    }

    public function remove(int $cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart) {
            return $cart->delete();
        }
        return false;
    }

    public function getCartForUser(User $user)
    {
        return Cart::where('user_id', $user->id)->get();
    }
}
