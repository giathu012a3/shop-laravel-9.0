<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('id', 'desc')->get();
        return view('admin.order', compact('order'));
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'delivery_status' => 'Đã giao hàng',
            'payment_status' => 'Đã thanh toán',
        ]);

        return redirect()->back();
    }

    public function printPdf($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function sendEmail($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.email_info', compact('order'));
    }

    public function sendUserEmail(Request $request, $id)
    {
        $order = Order::findOrFail($id);

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
    }

    public function search(Request $request)
    {
        $searchText = $request->search;
        $order = Order::where('name', 'LIKE', "%$searchText%")
            ->orWhere('phone', 'LIKE', "%$searchText%")
            ->orWhere('product_title', 'LIKE', "%$searchText%")
            ->get();

        return view('admin.order', compact('order'));
    }
}
