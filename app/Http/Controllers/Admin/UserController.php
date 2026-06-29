<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.view_Admin', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'Xóa người dùng thành công');
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        $user->usertype = ($user->usertype == 1) ? 0 : 1;
        $user->save();

        return redirect()->back()->with('message', 'Chuyển quyền thành công');
    }

    public function search(Request $request)
    {
        $searchText = $request->search_admin;
        $user = User::where('name', 'LIKE', "%$searchText%")
            ->orWhere('email', 'LIKE', "%$searchText%")
            ->orWhere('phone', 'LIKE', "%$searchText%")
            ->get();

        return view('admin.view_Admin', compact('user'));
    }
}
