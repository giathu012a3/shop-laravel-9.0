<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'category_name' => $request->category
        ]);

        return redirect()->back()->with('message', 'Thêm Danh Mục thành công');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('message', 'Xóa Danh Mục thành công');
    }
}
