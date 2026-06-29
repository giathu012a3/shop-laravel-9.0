<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;

class OrderController extends Controller
{
    protected $orderService;
    protected $stripeService;

    public function __construct(OrderService $orderService, StripeService $stripeService)
    {
        $this->orderService = $orderService;
        $this->stripeService = $stripeService;
    }

    public function cashOrder()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        try {
            $this->orderService->createFromCart(Auth::user(), 'Thanh toán khi nhận hàng');
            return redirect()->back()->with('message', 'Chúng tôi đã nhận được đơn hàng của bạn, chúng tôi sẽ sớm kết nối tới bạn.');
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function stripe($totalprice)
    {
        $categories = Category::all();
        return view('home.stripe', compact('totalprice', 'categories'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        try {
            // Thanh toán qua Stripe
            $this->stripeService->charge($totalprice, $request->stripeToken);

            // Tạo hóa đơn và giải phóng giỏ hàng
            $this->orderService->createFromCart(Auth::user(), 'Đã Thanh toán');

            Session::flash('success', 'Thanh toán thành công');
            return back();
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();
        }
    }

    public function show()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $order = Order::forUser(Auth::id())->get();
        $categories = Category::all();

        return view('home.order', compact('order', 'categories'));
    }

    public function cancel($id)
    {
        try {
            $this->orderService->cancel($id);
            return redirect()->back()->with('message', 'Đã hủy đơn hàng thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
