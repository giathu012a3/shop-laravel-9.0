<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    /**
     * Tạo đơn hàng từ giỏ hàng
     *
     * @param User $user
     * @param string $paymentStatus
     * @return void
     * @throws Exception
     */
    public function createFromCart(User $user, string $paymentStatus)
    {
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            throw new Exception('Giỏ hàng của bạn đang trống.');
        }

        DB::transaction(function () use ($cartItems, $paymentStatus) {
            foreach ($cartItems as $item) {
                // Tạo order mới
                Order::create([
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'address' => $item->address,
                    'user_id' => $item->user_id,
                    'product_title' => $item->product_title,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'image' => $item->image,
                    'product_id' => $item->product_id,
                    'payment_status' => $paymentStatus,
                    'delivery_status' => 'Đang Xử lý',
                ]);

                // Cập nhật số lượng tồn kho của sản phẩm
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('quantity', $item->quantity);
                }

                // Xóa khỏi giỏ hàng
                $item->delete();
            }
        });
    }

    /**
     * Hủy đơn hàng
     *
     * @param int $orderId
     * @return bool
     * @throws Exception
     */
    public function cancel(int $orderId)
    {
        return DB::transaction(function () use ($orderId) {
            $order = Order::find($orderId);
            if (!$order) {
                throw new Exception('Không tìm thấy đơn hàng.');
            }

            if ($order->delivery_status === 'Đơn hàng đã bị hủy') {
                return false;
            }

            // Hoàn lại số lượng tồn kho cho sản phẩm
            $product = Product::find($order->product_id);
            if ($product) {
                $product->increment('quantity', $order->quantity);
            }

            $order->delivery_status = 'Đơn hàng đã bị hủy';
            return $order->save();
        });
    }
}
