<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreReplyRequest;
use App\Models\Comment;
use App\Models\Comment_product;
use App\Models\Reply;
use App\Models\Reply_Comment_product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(StoreCommentRequest $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        Comment::create([
            'name' => Auth::user()->name,
            'user_id' => Auth::id(),
            'comments' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function addProductComment(StoreCommentRequest $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        Comment_product::create([
            'name' => Auth::user()->name,
            'user_id' => Auth::id(),
            'product_id' => $id,
            'comments' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function addReply(StoreReplyRequest $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        Reply::create([
            'name' => Auth::user()->name,
            'user_id' => Auth::id(),
            'comments_id' => $request->commentId,
            'reyly' => $request->reply,
        ]);

        return redirect()->back();
    }

    public function addReplyProduct(StoreReplyRequest $request, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        Reply_Comment_product::create([
            'name' => Auth::user()->name,
            'user_id' => Auth::id(),
            'comments_product_id' => $request->commentId,
            'reyly' => $request->reply,
            'product_id' => $id,
        ]);

        return redirect()->back();
    }
}
