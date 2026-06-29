<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.show_product', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->discount_price = $request->dis_price;
        $product->save();

        return redirect()->back()->with('message', 'Sản phẩm đã được thêm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->discount_price = $request->dis_price;
        $product->save();

        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('message', 'Xóa Sản phẩm thành công');
    }

    public function search(Request $request)
    {
        $searchText = $request->search_products;
        $products = Product::search($searchText)->get();

        return view('admin.show_product', compact('products'));
    }
}
