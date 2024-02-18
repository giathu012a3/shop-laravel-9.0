<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment_product;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Reply_Comment_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Models\Comment;

use Session;
use Stripe;


class HomeCotroller extends Controller
{
    public function index()
    {

        $product = Product::paginate(6);
        $comment = Comment::orderBy('id', 'desc')->paginate(2);
        $reply = Reply::all();
        $categories = Category::all();

        return view('home.userpage', compact('product', 'comment', 'reply', 'categories'));
    }
    public function view_product_category($id)
    {

        $categories = Category::all();
        $categori = Category::find($id);
        $categoriesName = $categori->category_name;
        $product = Product::where('category', '=', $categoriesName)->paginate(10);


        return view('home.view_product_category', compact('product','categories','categoriesName'));
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            $total_product = Product::all()->count();

            $total_order = Order::all()->count();

            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }
            ;
            $total_delivered = order::where('delivery_status', '=', 'Đã giao hàng')->get()->count();
            $total_processing = order::where('delivery_status', '=', 'Đang Xử lý')->get()->count();

            $categories = Category::all();


            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::paginate(6);
            $comment = Comment::orderBy('id', 'desc')->paginate(2);

            $reply = Reply::all();
            $categories = Category::all();

            return view('home.userpage', compact('product', 'comment', 'reply', 'categories'));

        }
    }

    public function view_all_product()
    {
        $product = Product::paginate(9);
        $categories = Category::all();

        return view('home.view_all_product  ', compact('product', 'categories'));
    }

    public function product_details($id)
    {
        $comment_product = Comment_product::orderBy('id', 'desc')->paginate(4);
        $reply = Reply_Comment_product::all();
        $product = Product::find($id);
        $categories = Category::all();

        return view('home.product_details', compact('product', 'comment_product', 'reply', 'categories'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();
    
            // Lấy số lượng sản phẩm còn lại
            $stock = $product->quantity;
    
            // Lấy số lượng sản phẩm mà khách hàng muốn mua
            $quantity = $request->quantity;
    
            // Kiểm tra số lượng mua có vượt quá số lượng còn lại hay không
            if ($quantity > $stock) {
                // Nếu vượt quá, thông báo cho khách hàng biết và yêu cầu họ chọn số lượng nhỏ hơn
                return redirect()->back()->with('message', 'Số lượng sản phẩm bạn muốn mua vượt quá số lượng còn lại. Vui lòng chọn số lượng nhỏ hơn hoặc sản phẩm khác.');
            } else {
                // Nếu không vượt quá, tiếp tục thêm vào giỏ hàng như bình thường
                if ($product_exist_id ) {
                    $cart = Cart::find($product_exist_id)->first();
                    $cart->quantity = $quantity + $request->quantity;
    
                    if ($product->discount_price != null && $product->discount_price != 0) {
    
                        $cart->price = $product->discount_price * $cart->quantity;
                    } else {
    
                        $cart->price = $product->price * $cart->quantity;
                    }
                    $cart->save();
    
                    return redirect()->back()->with('message', 'Đã thêm sản phẩm vào giỏ hàng');
                } else {
                    $cart = new Cart;
                    $cart->name = $user->name;
    
                    $cart->email = $user->email;
    
                    $cart->phone = $user->phone;
    
                    $cart->address = $user->address;
    
                    $cart->user_id = $user->id;
    
                    $cart->product_title = $product->title;
    
                    $cart->product_id = $product->id;
    
                    if ($product->discount_price != null && $product->discount_price != 0) {
    
                        $cart->price = $product->discount_price * $request->quantity;
                    } else {
    
                        $cart->price = $product->price * $request->quantity;
                    }
    
    
                    $cart->image = $product->image;
    
                    $cart->quantity = $request->quantity;
    
                    $cart->save();
    
                    return redirect()->back()->with('message', 'Đã thêm sản phẩm vào giỏ hàng');
                }
            }
        }
    }
    

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            $categories = Category::all();

            return view('home.show_cart', compact('cart', 'categories'));
        } else {
            return redirect('login');
        }

    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
    
        $data = Cart::where('user_id', '=', $userid)->get();
    
        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
    
            $order->email = $data->email;
    
            $order->phone = $data->phone;
    
            $order->address = $data->address;
    
            $order->user_id = $data->user_id;
    
            $order->product_title = $data->product_title;
    
            $order->price = $data->price;
    
            $order->quantity = $data->quantity;
    
            $order->image = $data->image;
            $order->product_id = $data->product_id;
    
            $order->payment_status = 'Thanh toán khi nhận hàng';
    
            $order->delivery_status = 'Đang Xử lý';
    
            $order->save();
    
            // Thêm đoạn code này để cập nhật số lượng tồn của sản phẩm
            $product = Product::find($data->product_id);
            $product->decrement('quantity', $data->quantity);
    
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'Chúng tôi đã nhận được đơn hạng của bạn, Chúng tôi sẽ sớm kết nối tới bạn');
    }
    
    public function stripe($totalprice)
    {
        $categories = Category::all();

        return view('home.stripe', compact('totalprice','categories'));
    }
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Cảm ơn vì Đã thanh toán trước"
        ]);
        $user = Auth::user();
        $userid = $user->id;

        $data = Cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;

            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;

            $order->price = $data->price;

            $order->quantity = $data->quantity;

            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Đã Thanh toán';

            $order->delivery_status = 'Đang Xử lý';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Thanh toán thành công');

        return back();
    }

    public function show_order()
    {
        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;
            $order = Order::where('user_id', '=', $userid)->get();
            $categories = Category::all();

            return view('home.order', compact('order', 'categories'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $product = Product::find($order->product_id);
        $product->increment('quantity', $order->quantity);
        $order->delivery_status = 'Đơn hàng đã bị hủy';
        $order->save();
        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment = new Comment;

            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comments = $request->comment;
            $comment->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function add_product_comment(Request $request, $id)
    {
        if (Auth::id()) {
            $comment_product = new Comment_product;

            $comment_product->name = Auth::user()->name;
            $comment_product->user_id = Auth::user()->id;
            $comment_product->product_id = $id;
            $comment_product->comments = $request->comment;
            $comment_product->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $replay = new Reply;
            $replay->name = Auth::user()->name;
            $replay->user_id = Auth::user()->id;
            $replay->comments_id = $request->commentId;
            $replay->reyly = $request->reply;

            $replay->save();

            return redirect()->back();

        } else {
            return redirect('login');
        }
    }
    public function add_reply_product(Request $request, $id)
    {
        if (Auth::id()) {
            $replay = new Reply_Comment_product;
            $replay->name = Auth::user()->name;
            $replay->user_id = Auth::user()->id;
            $replay->comments_product_id = $request->commentId;
            $replay->reyly = $request->reply;
            $replay->product_id = $id;

            $replay->save();

            return redirect()->back();

        } else {
            return redirect('login');
        }
    }


    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")
            ->paginate(10);
        $categories = Category::all();

        return view('home.view_search_product', compact('product', 'categories','search_text'));
    }
}
