<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\OrderController as ShopOrderController;
use App\Http\Controllers\Shop\ProductController as ShopProductController;
use App\Http\Controllers\Shop\CommentController as ShopCommentController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect')->middleware('auth');

Route::get('/view_all_product', [ShopProductController::class, 'viewAll'])->name('products.all');
Route::get('/product_details/{id}', [ShopProductController::class, 'details'])->name('products.details');
Route::get('/product_search', [ShopProductController::class, 'search'])->name('products.search');
Route::get('/view_product_category/{id}', [ShopProductController::class, 'viewByCategory'])->name('products.category');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/show_cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/add_cart/{id}', [CartController::class, 'store'])->name('cart.add');
    Route::get('/remove_cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    Route::get('/cash_order', [ShopOrderController::class, 'cashOrder'])->name('order.cash');
    Route::get('/stripe/{totalprice}', [ShopOrderController::class, 'stripe'])->name('order.stripe');
    Route::post('/stripe/{totalprice}', [ShopOrderController::class, 'stripePost'])->name('stripe.post');
    Route::get('/show_order', [ShopOrderController::class, 'show'])->name('order.show');
    Route::get('/cancel_order/{id}', [ShopOrderController::class, 'cancel'])->name('order.cancel');

    Route::post('/add_comment', [ShopCommentController::class, 'addComment'])->name('comment.add');
    Route::post('/add_reply', [ShopCommentController::class, 'addReply'])->name('reply.add');
    Route::post('/add_product_comment/{id}', [ShopCommentController::class, 'addProductComment'])->name('comment.product.add');
    Route::post('/add_reply_product/{id}', [ShopCommentController::class, 'addReplyProduct'])->name('reply.product.add');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/view_category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/add_category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/delete_category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/view_product', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/add_product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/show_product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/update_product/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/update_product_confirm/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/delete_product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/search_product_admin', [ProductController::class, 'search'])->name('admin.product.search');

    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/delivered/{id}', [OrderController::class, 'delivered'])->name('admin.order.delivered');
    Route::get('/print_pdf/{id}', [OrderController::class, 'printPdf'])->name('admin.order.pdf');
    Route::get('/send_email/{id}', [OrderController::class, 'sendEmail'])->name('admin.order.email');
    Route::post('/send_user_email/{id}', [OrderController::class, 'sendUserEmail'])->name('admin.order.email.send');
    Route::get('/search', [OrderController::class, 'search'])->name('admin.order.search');

    Route::get('/view_Admin', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/delete_user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/chagne_rosle/{id}', [UserController::class, 'changeRole'])->name('admin.users.change_role');
    Route::get('/search_admin', [UserController::class, 'search'])->name('admin.users.search');

    Route::get('/Comment', [CommentController::class, 'comments'])->name('admin.comments.index');
    Route::get('/Comment_product', [CommentController::class, 'productComments'])->name('admin.comments.product.index');
    Route::get('/delete_comment/{id}', [CommentController::class, 'destroyComment'])->name('admin.comment.destroy');
    Route::get('/delete_comment_product/{id}', [CommentController::class, 'destroyProductComment'])->name('admin.comment.product.destroy');
    Route::get('/search_comment', [CommentController::class, 'searchComment'])->name('admin.comment.search');
    Route::get('/search_comment_product', [CommentController::class, 'searchProductComment'])->name('admin.comment.product.search');
});
