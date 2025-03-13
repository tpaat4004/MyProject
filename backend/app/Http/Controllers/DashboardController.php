<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getSummary(Request $request)
{
    $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');
    $pendingOrders = Order::where('status', 'pending')->count();
    $totalUsers = User::count();
    $totalProducts = Product::count();

    // Lấy danh sách 5 sản phẩm bán chạy
    // $topProducts = Product::withCount('orders')  // Lấy số lượng đơn hàng cho mỗi sản phẩm
    //     ->orderBy('orders_count', 'desc')  // Sắp xếp theo số lượng đơn hàng giảm dần
    //     ->take(5)  // Lấy 5 sản phẩm bán chạy nhất
    //     ->get();

    return response()->json([
        'total_revenue' => $totalRevenue,
        'pending_orders' => $pendingOrders,
        'total_users' => $totalUsers,
        'total_products' => $totalProducts,
    ]);
}
}
