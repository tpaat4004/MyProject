<?php


namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        $user = Auth::user();  // Lấy người dùng hiện tại
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng'], 401);
        }

        // Kiểm tra sản phẩm có tồn tại không
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }

        // Kiểm tra giỏ hàng của người dùng đã có sản phẩm này chưa
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Nếu có rồi, cập nhật số lượng
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có, tạo mới
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }

    // Lấy giỏ hàng của người dùng
    public function getCart(Request $request)
    {
        // Kiểm tra session, xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để xem giỏ hàng'], 401);
        }

        $user = Auth::user();

        // Lấy giỏ hàng của người dùng từ cơ sở dữ liệu
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product') // Đảm bảo tải thông tin sản phẩm liên quan
            ->get();

        return response()->json($cartItems);
    }
    // Cập nhật giỏ hàng (thay đổi số lượng)
    public function updateCart(Request $request, $id)
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để cập nhật giỏ hàng'], 401);
        }

        // Xác thực số lượng sản phẩm
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Kiểm tra xem sản phẩm có trong giỏ hàng của người dùng không
        $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->first();
        if (!$cartItem) {
            return response()->json(['error' => 'Sản phẩm không có trong giỏ hàng'], 404);
        }

        // Cập nhật số lượng sản phẩm
        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();

        return response()->json(['message' => 'Giỏ hàng đã được cập nhật', 'quantity' => $cartItem->quantity]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        $user = Auth::user();  // Lấy người dùng hiện tại

        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng'], 401);
        }

        // Kiểm tra xem sản phẩm có trong giỏ hàng của người dùng không
        $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->first();
        if (!$cartItem) {
            return response()->json(['error' => 'Sản phẩm không có trong giỏ hàng'], 404);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
    }
}
