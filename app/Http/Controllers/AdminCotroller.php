<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Comment_product;
use App\Models\Order;
use App\Models\Reply;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Notification;
use PDF;

class AdminCotroller extends Controller
{
    
    public function view_category()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $usertype = Auth::user()->usertype;
                $data = Category::all();

                return view('admin.category', compact('data'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }
    public function add_category(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $data = new Category;
                $data->category_name = $request->category;

                $data->save();
                return redirect()->back()->with('message', 'Thêm Danh Mục thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }

    }

    public function delete_category($id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $data = Category::find($id);
                $data->delete();
                return redirect()->back()->with('message', 'Xóa Danh Mục thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }

        } else {
            return redirect('login');
        }
    }

    public function view_product()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $category = Category::all();
                return view('admin.product', compact('category'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }

        } else {
            return redirect('login');
        }
    }
    public function add_product(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $product = new Product;

                $product->title = $request->title;

                $product->description = $request->description;

                $product->price = $request->price;

                $product->quantity = $request->quantity;

                $product->discount_price = $request->dis_price;

                $product->category = $request->category;

                $image = $request->image;

                $imagename = time() . '.' . $image->getClientOriginalExtension();

                $request->image->move('product', $imagename);
                $product->image = $imagename;

                $product->save();

                return redirect()->back()->with('message', 'Sản phẩm đã được thêm thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }

    }

    public function show_product()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $products = Product::all();
                return view('admin.show_product', compact('products'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function delete_product($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $data = Product::find($id);
                $data->delete();
                return redirect()->back()->with('message', 'Xóa Sản phẩm thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }
    public function delete_comment($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $data = Comment::find($id);
                $data->delete();
                return redirect()->back()->with('message', 'Xóa bình luận thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }
    public function delete_comment_product($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $data = Comment_product::find($id);
                $data->delete();
                return redirect()->back()->with('message', 'Xóa bình luận thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function update_product($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $product = Product::find($id);
                $category = Category::all();
                return view('admin.update_product', compact('product', 'category'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function update_product_confirm(Request $request, $id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $product = Product::find($id);
                $product->title = $request->title;

                $product->description = $request->description;

                $product->price = $request->price;

                $product->discount_price = $request->dis_price;

                $product->category = $request->category;

                $product->quantity = $request->quantity;

                $image = $request->image;
                if ($image) {
                    $imagename = time() . '.' . $image->getClientOriginalExtension();

                    $request->image->move('product', $imagename);
                    $product->image = $imagename;

                }

                $product->save();

                return redirect()->back()->with('message', 'Cập nhật thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function order()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $order = Order::orderBy('id', 'desc')->get();
                return view('admin.order', compact('order'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();
                $categories  = Category::all();


                return view('home.userpage', compact('product', 'comment', 'reply','categories'));

            }
        } else {
            return redirect('login');
        }
    }

    public function delivered($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $order = Order::find($id);
                $order->delivery_status = "Đã giao hàng";

                $order->payment_status = "Đã thanh toán";

                $order->save();

                return redirect()->back();
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function print_pdf($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $order = Order::find($id);
                $pdf = PDF::loadView('admin.pdf', compact('order'));

                return $pdf->download('order_details.pdf');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function send_email($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $order = Order::find($id);
                return view('admin.email_info', compact('order'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function send_user_email(Request $request, $id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $order = order::find($id);

                $details = [
                    'greeting' => $request->greeting,
                    'firstline' => $request->firstline,
                    'body' => $request->body,
                    'button' => $request->button,
                    'url' => $request->url,
                    'lastline' => $request->lastline,
                ];

                Notification::send($order, new SendEmailNotification($details));
                return redirect()->back();
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function searchdata(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $searchText = $request->search;
                $order = Order::where('name', 'LIKE', "%$searchText%")
                    ->orWhere('phone', 'LIKE', "%$searchText%")
                    ->orWhere('product_title', 'LIKE', "%$searchText%")->get();

                return view('admin.order', compact('order'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function searchProductdata(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $searchText = $request->search_products;
                // $products=Product::all();
                $products = Product::where('title', 'LIKE', "%$searchText%")
                    ->orWhere('category', 'LIKE', "$searchText")->get();

                return view('admin.show_product', compact('products'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.show_product', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }
    
    public function search_admin(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $searchText = $request->search_admin;
                $user = user::where('name', 'LIKE', "%$searchText%")
                    ->orWhere('email', 'LIKE', "%$searchText%")
                    ->orWhere('phone', 'LIKE', "%$searchText%")->get();

                return view('admin.view_Admin', compact('user'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function view_Admin()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $user = User::all();
                return view('admin.view_Admin', compact('user'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function delete_user($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $user = User::find($id);
                $user->delete();
                return redirect()->back()->with('message', 'Xóa Danh Mục thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }

    }

    public function chagne_rosle($id)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $user = User::find($id);
                if ($user->usertype == 1) {
                    $user->usertype = 0;
                } else {
                    $user->usertype = 1;
                }
                $user->save();
                return redirect()->back()->with('message', 'Chuyển quyền thành công');
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }



    }
    public function Comment()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $comment = Comment::orderBy('id', 'desc')->paginate(10);

                return view('admin.Comment', compact('comment'));

            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);
                $reply = Reply::all();
                return view('home.userpage', compact('product', 'comment', 'reply'));
            }
        } else {
            return redirect('login');
        }
    }
    
    public function Comment_product()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $comment = Comment_product::orderBy('id', 'desc')->paginate(10);
                $product=Product::all();

                return view('admin.Comment_product', compact('comment','product'));

            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);
                $reply = Reply::all();
                return view('home.userpage', compact('product', 'comment', 'reply'));
            }
        } else {
            return redirect('login');
        }
    }

    public function searchComment(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $searchText = $request->search_comment;
                $comment = Comment::where('name', 'LIKE', "%$searchText%")
                    ->orWhere('comments', 'LIKE', "%$searchText%")
                    ->orWhere('created_at', 'LIKE', "%$searchText%")->get();

                return view('admin.Comment', compact('comment'));
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

    public function searchCommentProduct(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $product = Product::all();
                $searchText = $request->search_comment_product;
                
                $comment = Comment_product::where(function ($query) use ($searchText) {
                        $query->where('name', 'LIKE', "%$searchText%")
                            ->orWhere('comments', 'LIKE', "%$searchText%")
                            ->orWhere('created_at', 'LIKE', "%$searchText%");
                    })
                    ->orWhereHas('product', function($query) use ($searchText) {
                        $query->where('title', 'LIKE', "%$searchText%");
                    })
                    ->get();
                
                return view('admin.Comment_product', compact('comment', 'product'));
                
            } else {
                $product = Product::paginate(6);
                $comment = Comment::orderBy('id', 'desc')->paginate(2);

                $reply = Reply::all();

                return view('home.userpage', compact('product', 'comment', 'reply'));

            }
        } else {
            return redirect('login');
        }
    }

}
