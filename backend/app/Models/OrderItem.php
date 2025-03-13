<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Khai báo các cột được phép gán giá trị
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Quan hệ với bảng Order (n - 1)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với bảng Product (n - 1)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
