<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'user_id',
        'product_title',
        'quantity',
        'price',
        'image',
        'product_id',
        'payment_status',
        'delivery_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopePending($query)
    {
        return $query->where('delivery_status', 'Đang Xử lý');
    }

    public function scopeDelivered($query)
    {
        return $query->where('delivery_status', 'Đã giao hàng');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
