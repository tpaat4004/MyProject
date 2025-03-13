<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::with('items.product')->find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return response()->json(['order' => $order]);
    }


    public function index()
    {
        try {
            $orders = Order::with('items.product') // Lấy thông tin chi tiết sản phẩm trong đơn hàng
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Không thể tải danh sách đơn hàng.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = $request->status;
            $order->save();

            return response()->json(['message' => 'Cập nhật trạng thái thành công.'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Không thể cập nhật trạng thái.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function createOrder(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để tạo đơn hàng.'], 401);
        }

        // Validate input
        $validatedData = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:15',
            'address' => 'required|string',
            'payment_method' => 'required|string|in:cash,credit_card,vnpay',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Lấy giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Giỏ hàng của bạn trống.'], 400);
        }

        // Kiểm tra tổng tiền từ frontend khớp với giỏ hàng
        $calculatedTotal = $cartItems->reduce(function ($sum, $item) {
            return $sum + ($item->product->price * $item->quantity);
        }, 0);

        if ($calculatedTotal !== (float)$validatedData['total_amount']) {
            return response()->json(['error' => 'Tổng tiền không khớp với giỏ hàng.'], 400);
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
            'recipient_name' => $validatedData['recipient_name'],
            'recipient_phone' => $validatedData['recipient_phone'],
            'address' => $validatedData['address'],
            'payment_method' => $validatedData['payment_method'],
            'status' => 'pending', // Trạng thái mặc định
            'total_amount' => $validatedData['total_amount'],
        ]);

        // Lưu các sản phẩm trong giỏ vào bảng order_items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi tạo đơn hàng
        Cart::where('user_id', Auth::id())->delete();

        // Trả về thông tin đơn hàng vừa tạo
        return response()->json([
            'message' => 'Đơn hàng đã được tạo thành công.',
            'order' => [
                'id' => $order->id,
                'recipient_name' => $order->recipient_name,
                'recipient_phone' => $order->recipient_phone,
                'address' => $order->address,
                'payment_method' => $order->payment_method,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
            ],
        ]);
    }

    public function getOrders()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để xem danh sách đơn hàng'], 401);
        }

        $user = Auth::user();

        // Lấy danh sách đơn hàng của người dùng
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product']) // Tải các sản phẩm liên quan từ bảng order_items
            ->get();

        return response()->json($orders);
    }

    public function cancelOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Chỉ có thể hủy đơn hàng đang chờ xử lý.'], 400);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json(['message' => 'Đơn hàng đã được hủy thành công.'], 200);
    }

    public function sendEmail($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);

        // Kiểm tra xem user có tồn tại và email có hợp lệ không
        if (!$order->user || !$order->user->email) {
            return response()->json(['error' => 'Không thể tìm thấy email của người dùng.'], 400);
        }

        $emailData = [
            'name' => $order->recipient_name,
            'phone' => $order->recipient_phone,
            'address' => $order->address,
            'total' => $order->total_amount,
            'items' => $order->items,
        ];

        try {
            Mail::send('emails.order-confirmation', $emailData, function ($message) use ($order) {
                $message->to($order->user->email) // Lấy email từ user
                    ->subject('Xác nhận đơn hàng');
            });

            return response()->json(['message' => 'Email xác nhận đã được gửi.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể gửi email. Vui lòng thử lại.', 'message' => $e->getMessage()], 500);
        }
    }

    
}
