<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment_product;
use App\Models\Product;
use App\Models\Reply_Comment_product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewAll()
    {
        $product = Product::paginate(9);
        $categories = Category::all();

        return view('home.view_all_product', compact('product', 'categories'));
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);
        $comment_product = Comment_product::orderBy('id', 'desc')->paginate(4);
        $reply = Reply_Comment_product::all();
        $categories = Category::all();

        return view('home.product_details', compact('product', 'comment_product', 'reply', 'categories'));
    }

    public function search(Request $request)
    {
        $searchText = $request->search;
        $product = Product::search($searchText)->paginate(10);
        $categories = Category::all();

        return view('home.view_search_product', compact('product', 'categories', 'searchText'));
    }

    public function viewByCategory($id)
    {
        $categories = Category::all();
        $categori = Category::findOrFail($id);
        $categoriesName = $categori->category_name;
        $product = Product::where('category', $categoriesName)->paginate(10);

        return view('home.view_product_category', compact('product', 'categories', 'categoriesName'));
    }
}
