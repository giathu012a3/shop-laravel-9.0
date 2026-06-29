<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comment_product;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comments()
    {
        $comment = Comment::orderBy('id', 'desc')->paginate(10);
        return view('admin.Comment', compact('comment'));
    }

    public function productComments()
    {
        $comment = Comment_product::orderBy('id', 'desc')->paginate(10);
        $product = Product::all();
        return view('admin.Comment_product', compact('comment', 'product'));
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('message', 'Xóa bình luận thành công');
    }

    public function destroyProductComment($id)
    {
        $comment = Comment_product::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('message', 'Xóa bình luận thành công');
    }

    public function searchComment(Request $request)
    {
        $searchText = $request->search_comment;
        $comment = Comment::where('name', 'LIKE', "%$searchText%")
            ->orWhere('comments', 'LIKE', "%$searchText%")
            ->orWhere('created_at', 'LIKE', "%$searchText%")
            ->get();

        return view('admin.Comment', compact('comment'));
    }

    public function searchProductComment(Request $request)
    {
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
    }
}
