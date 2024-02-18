<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TreeNotification extends Notification
{
    use Queueable;

    // Biến để lưu trữ thông tin về cây cối
    protected $tree;

    // Hàm khởi tạo class notification
    public function __construct($tree)
    {
        // Gán biến $tree bằng tham số truyền vào
        $this->tree = $tree;
    }

    // Hàm xác định kênh thông báo
    public function via($notifiable)
    {
        // Trả về một mảng chứa tên của các kênh thông báo
        return ['database'];
    }

    // Hàm xác định dữ liệu thông báo cho cơ sở dữ liệu
    public function toDatabase($notifiable)
    {
        // Trả về một mảng chứa các dữ liệu mà bạn muốn lưu trữ trong cơ sở dữ liệu
        return [
            'tree_id' => $this->tree->id,
            'tree_name' => $this->tree->name,
            'tree_price' => $this->tree->price,
            'tree_image' => $this->tree->image,
            'tree_description' => $this->tree->description,
        ];
    }
}
