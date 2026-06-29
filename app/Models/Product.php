<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'quantity',
        'price',
        'discount_price',
    ];

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category', 'category_name');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeDiscounted($query)
    {
        return $query->whereNotNull('discount_price')->where('discount_price', '>', 0);
    }

    public function scopeSearch($query, $text)
    {
        return $query->where('title', 'LIKE', "%$text%")
                     ->orWhere('category', 'LIKE', "%$text%");
    }
}
