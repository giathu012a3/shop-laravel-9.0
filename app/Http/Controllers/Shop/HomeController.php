<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(6);
        $comment = Comment::orderBy('id', 'desc')->paginate(2);
        $reply = Reply::all();
        $categories = Category::all();

        return view('home.userpage', compact('product', 'comment', 'reply', 'categories'));
    }

    public function redirect()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->usertype == '1') {
            return redirect()->route('admin.dashboard');
        }

        return $this->index();
    }
}
