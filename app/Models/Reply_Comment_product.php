<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply_Comment_product extends Model
{
    use HasFactory;

    protected $table = 'reply__comment_products';

    protected $fillable = [
        'name',
        'comments_product_id',
        'reyly',
        'user_id',
        'product_id',
    ];

    public function commentProduct()
    {
        return $this->belongsTo(Comment_product::class, 'comments_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
