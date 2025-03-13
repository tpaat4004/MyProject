<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;

class VnpayController extends Controller
{
    private $vnp_TmnCode = 'G1C2X3OQ'; // Mã đối tác của bạn
    private $vnp_HashSecret = 'VXZKKT3BIAFRAQ4Q845TIXF3DINZ9XKZ'; // Khóa bí mật của bạn
    private $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'; // URL thanh toán của VNPay (có thể thay đổi nếu bạn sử dụng môi trường thực)
    private $vnp_ReturnUrl = 'http://localhost:5173/Thankyou'; // URL trả về sau khi thanh toán

    // Tạo URL thanh toán VNPay
    public function createPaymentUrl(Request $request)
    {
        try {
            // Kiểm tra người dùng đã đăng nhập chưa
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Bạn cần đăng nhập để thanh toán'], 401);
            }

            // Lấy thông tin đơn hàng
            $order = Order::find($request->order_id);
            if (!$order || $order->user_id != $user->id) {
                return response()->json(['error' => 'Đơn hàng không hợp lệ'], 400);
            }

            // Kiểm tra lại thời gian và khu vực
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // VNPAY thông tin
            $vnp_TxnRef = $order->id; // Mã đơn hàng
            $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order->id; // Thông tin đơn hàng
            $vnp_OrderType = "billpayment"; // Loại thanh toán

            // Chuyển giá trị tổng tiền thành đúng định dạng (VND và nhân với 100)
            $vnp_Amount = $order->total_amount * 100; // Tổng tiền thanh toán (VND)

            $vnp_Locale = "vn"; // Ngôn ngữ
            $vnp_IpAddr = $request->ip(); // Địa chỉ IP của khách hàng

            // Thời gian bắt đầu và thời gian hết hạn
            $startTime = date("YmdHis");
            $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

            // Các tham số của VNPay
            $vnp_Params = [
                "vnp_Version" => "2.1.0", // Phiên bản VNPay
                "vnp_TmnCode" => $this->vnp_TmnCode, // Mã đối tác
                "vnp_Amount" => $vnp_Amount, // Tổng tiền
                "vnp_Command" => "pay", // Lệnh thanh toán
                "vnp_CreateDate" => $startTime, // Thời gian tạo
                "vnp_CurrCode" => "VND", // Mã tiền tệ
                "vnp_IpAddr" => $vnp_IpAddr, // Địa chỉ IP khách hàng
                "vnp_Locale" => $vnp_Locale, // Ngôn ngữ
                "vnp_OrderInfo" => $vnp_OrderInfo, // Thông tin đơn hàng
                "vnp_OrderType" => $vnp_OrderType, // Loại đơn hàng
                "vnp_ReturnUrl" => $this->vnp_ReturnUrl, // URL trả về sau khi thanh toán
                "vnp_TxnRef" => $vnp_TxnRef, // Mã tham chiếu đơn hàng
                "vnp_ExpireDate" => $expire // Thời gian hết hạn
            ];

            Log::info('VNPay parameters:', $vnp_Params);

            // Tạo chữ ký bảo mật
            ksort($vnp_Params);
            $query = http_build_query($vnp_Params);
            $secureHash = hash_hmac('sha512', $query, $this->vnp_HashSecret);
            $vnp_Params['vnp_SecureHash'] = $secureHash;

            // Tạo URL thanh toán
            $vnp_Url = $this->vnp_Url . '?' . http_build_query($vnp_Params);

            return response()->json(['payment_url' => $vnp_Url], 200);
        } catch (\Exception $e) {
            Log::error('Error creating payment URL', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Lỗi khi tạo URL thanh toán'], 500);
        }
    }

    // Xử lý kết quả trả về từ VNPay (callback)
    public function vnpayReturn(Request $request)
    {
        try {
            $vnp_ResponseCode = $request->vnp_ResponseCode;
            $vnp_TxnRef = $request->vnp_TxnRef;
            $vnp_SecureHash = $request->vnp_SecureHash;

            // Kiểm tra chữ ký bảo mật
            $vnp_Params = $request->all();
            unset($vnp_Params['vnp_SecureHash']); // Loại bỏ chữ ký cũ
            ksort($vnp_Params);
            $query = http_build_query($vnp_Params);
            $secureHash = hash_hmac('sha512', $query, $this->vnp_HashSecret);

            // Kiểm tra kết quả thanh toán
            if ($vnp_SecureHash === $secureHash) {
                if ($vnp_ResponseCode === '00') {
                    // Thanh toán thành công
                    $order = Order::find($vnp_TxnRef);
                    if ($order) {
                        $order->status = 'paid';
                        $order->save();

                        // Gửi email xác nhận đơn hàng
                        Mail::send('emails.vn-confirmation', [
                            'name' => $order->customer_name,
                            'phone' => $order->phone,
                            'address' => $order->address,
                            'vnp_TxnRef' => $vnp_TxnRef,
                            'total' => $order->total_price,
                            'payment_status' => 'Thành công'
                        ], function ($message) use ($order) {
                            $message->to($order->user->email)
                                    ->subject('Xác nhận thanh toán đơn hàng #' . $order->id);
                        });

                        return response()->json(['message' => 'Thanh toán thành công và email xác nhận đã được gửi'], 200);
                    }
                    return response()->json(['error' => 'Đơn hàng không hợp lệ'], 400);
                } else {
                    return response()->json(['error' => 'Thanh toán không thành công. Mã lỗi: ' . $vnp_ResponseCode], 400);
                }
            } else {
                return response()->json(['error' => 'Chữ ký bảo mật không hợp lệ'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error processing VNPay callback', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Lỗi khi xử lý kết quả thanh toán'], 500);
        }
    }

    // Xử lý khi có lỗi xảy ra
    public function vnpayCancel()
    {
        return response()->json(['error' => 'Thanh toán bị hủy'], 400);
    }
}