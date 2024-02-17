<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeCotroller;
use App\Http\Controllers\AdminCotroller;
;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[HomeCotroller::class,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeCotroller::class,'redirect'])->middleware('auth','verified');
Route::get('/admin',[HomeCotroller::class,'redirect'])->middleware('auth','verified');

Route::get('/view_category',[AdminCotroller::class,'view_category']);
Route::post('/add_category',[AdminCotroller::class,'add_category']);
Route::get('/delete_category/{id}',[AdminCotroller::class,'delete_category']);

Route::get('/view_product',[AdminCotroller::class,'view_product']);


Route::post('/add_product',[AdminCotroller::class,'add_product']);

Route::get('/show_product',[AdminCotroller::class,'show_product']);
Route::get('/delete_product/{id}',[AdminCotroller::class,'delete_product']);
Route::get('/delete_comment/{id}',[AdminCotroller::class,'delete_comment']);
Route::get('/delete_comment_product/{id}',[AdminCotroller::class,'delete_comment_product']);

Route::get('/update_product/{id}',[AdminCotroller::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminCotroller::class,'update_product_confirm']);

Route::get('/order',[AdminCotroller::class,'order']);
Route::get('/delivered/{id}',[AdminCotroller::class,'delivered']);
Route::get('/print_pdf/{id}',[AdminCotroller::class,'print_pdf']);
Route::get('/send_email/{id}',[AdminCotroller::class,'send_email']);

Route::post('/send_user_email/{id}',[AdminCotroller::class,'send_user_email']);
Route::get('/search',[AdminCotroller::class,'searchdata']);
Route::get('/search_product_admin',[AdminCotroller::class,'searchProductdata']);
Route::get('/search_admin',[AdminCotroller::class,'search_admin']);
Route::get('/search_comment',[AdminCotroller::class,'searchComment']);
Route::get('/search_comment_product',[AdminCotroller::class,'searchCommentProduct']);
Route::get('/view_Admin',[AdminCotroller::class,'view_Admin']);
Route::get('/delete_user/{id}',[AdminCotroller::class,'delete_user']);
Route::get('/chagne_rosle/{id}',[AdminCotroller::class,'chagne_rosle']);
Route::get('/Comment',[AdminCotroller::class,'Comment']);
Route::get('/Comment_product',[AdminCotroller::class,'Comment_product']);





//USER
Route::get('/view_all_product',[HomeCotroller::class,'view_all_product']);
Route::get('/product_details/{id}',[HomeCotroller::class,'product_details']);
Route::post('/add_cart/{id}',[HomeCotroller::class,'add_cart']);

Route::get('/show_cart',[HomeCotroller::class,'show_cart']);
Route::get('/remove_cart/{id}',[HomeCotroller::class,'remove_cart']);

Route::get('/cash_order',[HomeCotroller::class,'cash_order']);
Route::get('/stripe/{totalprice}',[HomeCotroller::class,'stripe']);

Route::post('stripe/{totalprice}',[HomeCotroller::class, 'stripePost'])->name('stripe.post');

Route::get('/show_order',[HomeCotroller::class,'show_order']);
Route::get('/cancel_order/{id}',[HomeCotroller::class,'cancel_order']);

Route::post('/add_comment',[HomeCotroller::class,'add_comment']);
Route::post('/add_reply',[HomeCotroller::class,'add_reply']);
Route::get('/product_search',[HomeCotroller::class,'product_search']);
Route::post('/add_product_comment/{id}',[HomeCotroller::class,'add_product_comment']);
Route::post('/add_reply_product/{id}',[HomeCotroller::class,'add_reply_product']);
// Route::get('/view_category',[HomeCotroller::class,'view_category']);
// web.php
Route::get('view_product_category/{id}', [HomeCotroller::class,'view_product_category']);


