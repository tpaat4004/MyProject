<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Khai báo các cột được phép gán giá trị
    protected $fillable = [
        'user_id',
        'recipient_name',
        'recipient_phone',
        'address',
        'payment_method',
        'status',
        'total_amount',
    ];

    // Quan hệ với bảng User (1 - n)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    // Quan hệ với bảng OrderItem (1 - n) - để lưu thông tin chi tiết các sản phẩm trong đơn hàng
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id'); // Quan hệ với model OrderItem
    }
}
