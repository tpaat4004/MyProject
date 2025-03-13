<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration CreateCartTable
class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Không nullable, đảm bảo có user_id
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Tham chiếu đến bảng products
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}

