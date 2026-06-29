<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function store(StoreCartRequest $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        try {
            $product = Product::findOrFail($id);
            $this->cartService->add($product, Auth::user(), $request->quantity);
            return redirect()->back()->with('message', 'Đã thêm sản phẩm vào giỏ hàng');
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function show()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $cart = $this->cartService->getCartForUser(Auth::user());
        $categories = Category::all();

        return view('home.show_cart', compact('cart', 'categories'));
    }

    public function destroy($id)
    {
        $this->cartService->remove($id);
        return redirect()->back();
    }
}
