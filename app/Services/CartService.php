<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;

class CartService
{
    /**
     * Thêm sản phẩm vào giỏ hàng
     *
     * @param Product $product
     * @param User $user
     * @param int $quantity
     * @return Cart
     * @throws Exception
     */
    public function add(Product $product, User $user, int $quantity)
    {
        // Kiểm tra số lượng tồn kho
        if ($quantity > $product->quantity) {
            throw new Exception('Số lượng sản phẩm bạn muốn mua vượt quá số lượng còn lại. Vui lòng chọn số lượng nhỏ hơn.');
        }

        // Tìm xem sản phẩm đã có trong giỏ hàng của user chưa
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

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     *
     * @param int $cartId
     * @return bool
     */
    public function remove(int $cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart) {
            return $cart->delete();
        }
        return false;
    }

    /**
     * Lấy giỏ hàng của user
     *
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCartForUser(User $user)
    {
        return Cart::where('user_id', $user->id)->get();
    }
}
