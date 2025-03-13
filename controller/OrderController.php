<?php
require_once "model/OrderModel.php";
require_once "model/CartModel.php";
require_once "helpers/mail.php";


class OrderController
{
    private $orderModel;
    private $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        $orders = $this->orderModel->getOrdersByUser($_SESSION['user']['id']);
        renderView("view/orders/list.php", compact('orders'), "Danh sách đơn hàng");
    }

    public function trackingOrder()
    {
        $orderDetails = [];
        $orderInfo = null;
        $orderCode = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderCode = trim($_POST['code'] ?? '');

            if (empty($orderCode)) {
                $_SESSION['error'] = "Vui lòng nhập mã đơn hàng!";
            } else {
                $orderDetails = $this->orderModel->getOrderWithDetails($orderCode);

                if (!empty($orderDetails)) {
                    $orderInfo = $orderDetails[0]; // Lấy thông tin đơn hàng từ kết quả đầu tiên
                } else {
                    $_SESSION['error'] = "Không tìm thấy đơn hàng với mã: $orderCode";
                }
            }
        }

        renderView("view/orders/tracking_order.php", compact('orderInfo', 'orderDetails', 'orderCode'), "Tra cứu đơn hàng");
    }


    public function vnpay_payment()
    {

        if (!isset($_SESSION['order_data'])) {
            die("Không tìm thấy đơn hàng.");
        }

        $order = $_SESSION['order_data'];
        $vnp_TmnCode = $_ENV['VNP_TMN_CODE'];
        $vnp_HashSecret = $_ENV['VNP_HASH_SECRET'];
        $vnp_Url = $_ENV['VNP_URL'];
        $vnp_Returnurl = $_ENV['VNP_RETURN_URL'];

        $vnp_TxnRef = $order['code']; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng " . $order['code'];
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $order['total_price'] * 100; // VNPay nhận đơn vị VNĐ x 100
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        header('Location: ' . $vnp_Url);
        exit;
    }

    public function vnpay_return()
    {
        if (!isset($_GET['vnp_SecureHash']) || !isset($_GET['vnp_ResponseCode'])) {
            $_SESSION['error'] = "Dữ liệu thanh toán không hợp lệ!";
            header("Location: /cart");
            exit;
        }

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = [];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $_ENV['VNP_HASH_SECRET']);

        if (!hash_equals($secureHash, $vnp_SecureHash)) {
            $_SESSION['error'] = "Lỗi xác thực thanh toán!";
            var_dump($secureHash);
            // header("Location: /shop");
            // exit;
        }

        if ($_GET['vnp_ResponseCode'] != '00') {
            $_SESSION['error'] = "Thanh toán thất bại!";
            var_dump($_GET['vnp_ResponseCode']);
            // header("Location: /cart");
            // exit;
        }

        if (!isset($_SESSION['order_data'])) {
            $_SESSION['error'] = "Không tìm thấy dữ liệu đơn hàng!";
            var_dump($_SESSION['order_data']);
            // header("Location: /cart");
            // exit;
        }

        $order = $_SESSION['order_data'];
        $code = $_GET['vnp_TxnRef'];
        $total_price = $_GET['vnp_Amount'] / 100;
        $status = 'paid';

        $orderId = $this->orderModel->createOrder([
            'userId' => $order['idUser'],
            'code' => $code,
            'name' => $order['name'],
            'phone' => $order['phone'],
            'total' => $total_price,
            'address' => $order['address'],
            'note' => $order['noteOrder'],
            'status' => $status,
            'paymentMethod' => $order['payment'],
            'coupon' => $_SESSION['coupon']['code'] ?? null
        ]);

        if (!$orderId) {
            $_SESSION['error'] = "Lỗi khi lưu đơn hàng!";
            var_dump($orderId);
            // header("Location: /cart");
            // exit;
        }

        $user_id = $order['idUser'];
        $session_id = session_id();
        if ($orderId) {
            // Lưu chi tiết đơn hàng vào bảng orders_detail
            $carts = $this->cartModel->getCart($user_id, $session_id);
            foreach ($carts as $cart) {
                $data = [
                    'idOrder' => $orderId,
                    'idProductVariants' => $cart['idProductVariants'],
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price']
                ];

                $this->orderModel->createOrderDetail($data);

                //Giảm số lượng trong kho
                $this->orderModel->reduceProductQuantity($cart['idProductVariants'], $cart['quantity']);
            }

            //Nếu có mã giảm giá, trừ số lượng còn lại
            if (!empty($_SESSION['coupon']['code'])) {
                $couponCode = $_SESSION['coupon']['code'];
                $this->orderModel->reduceCouponQuantity($couponCode);
            }
        }


        $this->cartModel->clearCart($user_id, $session_id);
        unset($_SESSION['coupon']);

        if (!empty($_SESSION['user']['email'])) {
            $email = $_SESSION['user']['email'];
            $subject = "Xác nhận đơn hàng #$code";
            $body = "
            <h3>Xin chào {$order['name']},</h3>
            <p>Cảm ơn bạn đã đặt hàng tại <b>Hạt Ngon</b>!</p>
            <p>Đơn hàng của bạn: <b>$code</b></p>
            <p>Tổng tiền: <b>" . number_format($total_price, 0, ',', '.') . " VND</b></p>
            <p>Phương thức thanh toán: <b>{$order['payment']}</b></p>
            <p>Địa chỉ nhận hàng: <b>{$order['address']}</b></p>
            <p>Chúng tôi sẽ liên hệ để xác nhận và giao hàng sớm nhất!</p>
            <p>Trân trọng,</p>
            <p><b>Hạt Ngon</b></p>";
            sendMail($email, $subject, $body);
        }

        $_SESSION['success'] = "Thanh toán thành công. Đơn hàng đã được tạo.";
        header("Location: /orders/success");
        exit;
    }



    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment = $_POST['payment'] ?? null;
            $user_id = $_SESSION['user']['id'] ?? null;
            $session_id = session_id();
            $carts = $this->cartModel->getCart($user_id, $session_id);

            // Kiểm tra giỏ hàng
            if (empty($carts)) {
                $_SESSION['error'] = "Giỏ hàng trống, vui lòng thêm sản phẩm trước khi đặt hàng!";
                header("Location: /cart");
                exit;
            }

            $total = 0;
            foreach ($carts as $cart) {
                $total += $cart['price'] * $cart['quantity'];
            }

            // Áp dụng mã giảm giá (nếu có)
            $discountAmount = $_SESSION['coupon']['discount'] ?? 0;
            $discountValue = ($total * $discountAmount) / 100;
            $totalAfterDiscount = $total - $discountValue + 30000; // Cộng phí vận chuyển

            // Tạo mã đơn hàng duy nhất
            $code = uniqid("ORD_");

            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $note = trim($_POST['note'] ?? '');
            $status = 'pending';

            if (!empty($_POST['new_address_check'])) {
                // Nhập địa chỉ mới
                $address = trim($_POST['address'] ?? '');
                if (empty($address) || empty($name) || empty($phone)) {
                    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin địa chỉ mới!";
                    header("Location: /orders/checkout");
                    exit;
                }
                $addressId = $this->orderModel->saveNewAddress($user_id, $name, $phone, $address);
            } else {
                // Chọn địa chỉ có sẵn
                $addressId = $_POST['saved_address_id'] ?? null;
                if (!$addressId) {
                    $_SESSION['error'] = "Vui lòng chọn địa chỉ nhận hàng!";
                    header("Location: /orders/checkout");
                    exit;
                }
                $savedAddress = $this->orderModel->getAddressById($addressId);
                $name = $savedAddress['name'];
                $phone = $savedAddress['phone'];
                $address = $savedAddress['address'];
            }


            // Lưu đơn hàng vào bảng `orders`
            $orderId = $this->orderModel->createOrder([
                'userId' => $user_id,
                'code' => $code,
                'name' => $name,
                'phone' => $phone,
                'total' => $totalAfterDiscount,
                'address' => $address,
                'note' => $note,
                'status' => $status,
                'paymentMethod' => $payment,
                'coupon' => $_SESSION['coupon']['code'] ?? null
            ]);

            if (!$orderId) {
                $_SESSION['error'] = "Đã có lỗi xảy ra khi tạo đơn hàng!";
                header("Location: /orders");
                exit;
            }

            // Lưu chi tiết đơn hàng vào bảng `orders_detail`
            foreach ($carts as $cart) {
                $data = [
                    'idOrder' => $orderId,
                    'idProductVariants' => $cart['idProductVariants'],
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price']
                ];
                $this->orderModel->createOrderDetail($data);
                // Cập nhật số lượng tồn kho
                $this->orderModel->reduceProductQuantity($cart['idProductVariants'], $cart['quantity']);
            }

            // Nếu có mã giảm giá, trừ số lượng còn lại
            if (!empty($_SESSION['coupon']['code'])) {
                $couponCode = $_SESSION['coupon']['code'];
                $this->orderModel->reduceCouponQuantity($couponCode);
            }

            // Xử lý thanh toán VNPAY
            if ($payment == 'vnpay') {
                $_SESSION['order_data'] = [
                    'code' => $code,
                    'total_price' => $totalAfterDiscount,
                    'idUser' => $user_id,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'noteOrder' => $note,
                    'payment' => $payment
                ];
                header("Location: /orders/vnpay_payment");
                exit;
            }

            // Lưu thông tin đơn hàng vào session để hiển thị trong trang success
            $_SESSION['last_order'] = [
                'code' => $code,
                'total' => $totalAfterDiscount,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'status' => $status,
                'paymentMethod' => $payment
            ];

            // Gửi email xác nhận đơn hàng
            $email = $_SESSION['user']['email'] ?? null;
            if ($email) {
                $subject = "Xác nhận đơn hàng #$code";
                $body = "
                <h3>Xin chào $name,</h3>
                <p>Cảm ơn bạn đã đặt hàng tại <b>Hạt Ngon</b>!</p>
                <p>Đơn hàng của bạn: <b>$code</b></p>
                <p>Tổng tiền: <b>" . number_format($totalAfterDiscount, 0, ',', '.') . " VND</b></p>
                <p>Phương thức thanh toán: <b>$payment</b></p>
                <p>Địa chỉ nhận hàng: <b>$address</b></p>
                <p>Chúng tôi sẽ liên hệ để xác nhận và giao hàng sớm nhất!</p>
                <p>Trân trọng,</p>
                <p><b>Hạt Ngon</b></p>";
                sendMail($email, $subject, $body);
            }

            // Xóa giỏ hàng và mã giảm giá sau khi đặt hàng thành công
            $this->cartModel->clearCart($user_id, $session_id);
            unset($_SESSION['coupon']);

            $_SESSION['message'] = "Đơn hàng đã được tạo thành công!";
            header("Location: /orders/success");
            exit;
        } else {
            // Hiển thị trang thanh toán
            $user_id = $_SESSION['user']['id'] ?? null;
            $session_id = session_id();
            $carts = $this->cartModel->getCart($user_id, $session_id);
            $addresses = $this->orderModel->getUserAddresses($user_id);
            renderView("view/orders/list.php", compact('carts', 'addresses'), "Thanh toán");
        }
    }



    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['orderId'];
            $status = $_POST['status'];

            if ($this->orderModel->updateOrderStatus($orderId, $status)) {
                // Lấy thông tin đơn hàng và email từ bảng users
                $orderInfo = $this->orderModel->getOrderById($orderId);
                $email = $orderInfo['email'] ?? ''; // Email có thể NULL nếu userId = NULL
                $name = $orderInfo['name'];

                if (!empty($email)) {
                    $subject = "Cập nhật trạng thái đơn hàng #$orderId";
                    $body = "
                    <h3>Chào $name,</h3>
                    <p>Đơn hàng của bạn (#$orderId) hiện đã được cập nhật trạng thái:</p>
                    <h4 style='color: blue;'>$status</h4>
                    <p>Cảm ơn bạn đã mua hàng tại <b>Fashion</b>!</p>
                ";

                    if (sendMail($email, $subject, $body)) {
                        http_response_code(200);
                        echo json_encode(["message" => "Cập nhật thành công và đã gửi email!"]);
                    } else {
                        http_response_code(500);
                        echo json_encode(["message" => "Cập nhật thành công nhưng gửi email thất bại!"]);
                    }
                }
            }
            exit;
        }
    }




    public function applyCoupon()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['applyCoupon'])) {
                $couponCode = trim($_POST['coupon'] ?? '');

                if (!empty($couponCode)) {
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->prepare("SELECT * FROM coupons WHERE codeCoupon = ? AND startDate <= NOW() AND endDate >= NOW() AND quantityCoupon > 0");
                    $stmt->execute([$couponCode]);
                    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($coupon) {
                        $_SESSION['coupon'] = [
                            'code' => $coupon['codeCoupon'],
                            'discount' => (int) $coupon['discount']
                        ];
                    } else {
                        $_SESSION['error'] = "Mã giảm giá không hợp lệ hoặc đã hết hạn!";
                    }
                } else {
                    $_SESSION['error'] = "Vui lòng nhập mã giảm giá!";
                }
            }

            $user_id = $_SESSION['user']['id'] ?? null;
            $session_id = session_id();
            $cartModel = new CartModel();
            $_SESSION['cart'] = $cartModel->getCart($user_id, $session_id);

            header("Location: /orders");
            exit;
        }

        renderView('view/orders/list.php');
    }

    public function success()
    {
        if (!isset($_SESSION['last_order'])) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng!";
            header("Location: /orders");
            exit;
        }

        $order = $_SESSION['last_order'];
        unset($_SESSION['last_order']); //xóa session sau khi hiển thị

        renderView('view/orders/success.php', compact('order'), "Đặt hàng thành công!");
    }

    public function removeCoupon()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['coupon'])) {
            unset($_SESSION['coupon']); // Xóa mã giảm giá khỏi session
            $_SESSION['message'] = "Mã giảm giá đã được hủy!";
        } else {
            $_SESSION['error'] = "Không có mã giảm giá nào để hủy!";
        }

        header("Location: /orders"); // Điều hướng về trang checkout
        exit;
    }

    public function listOrder()
    {
        $orders = $this->orderModel->getAllOrders();
        renderView("view/orders/orders_list.php", compact('orders'), "Danh sách đơn hàng");
    }

    public function orderDetail()
    {
        if (!isset($_GET['code']) || empty($_GET['code'])) {
            die(" Lỗi: ID đơn hàng không hợp lệ.");
        }

        $orderCode = $_GET['code'];

        $orderModel = new OrderModel();
        $orderInfo = $orderModel->getOrderByCode($orderCode);

        if (!$orderInfo) {
            die(" Lỗi: Không tìm thấy đơn hàng với ID: $orderCode"); // Hiện lỗi nếu không có đơn hàng
        }

        $orderDetails = $orderModel->getOrderDetails($orderInfo['id']);

        renderView("view/orders/orders_detail.php", compact('orderInfo', 'orderDetails'), "Chi tiết đơn hàng");
    }

    public function orderHistory()
    {
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['error'] = "Vui lồn đăng nhập để xem lịch sử đơn hàng!";
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersByUser($user_id);
        renderView("view/orders/orders_history.php", compact('orders'), "Lịch sử đơn hàng");
    }

    public function orderDetailhistory()
    {

        if (!isset($_GET['code']) || empty($_GET['code'])) {
            die(" Lỗi: ID đơn hàng không hợp lệ.");
            header("Location: /orders/history");
        }

        $orderCode = $_GET['code'];
        $userId = $_SESSION['user']['id'] ?? null;

        //Lấy thống tin đơn hàng
        $orderInfo = $this->orderModel->getOrderByCodeUser($orderCode, $userId);

        //Kiểm tra nếu đơn hàng ko tồn tại hoặc ko thuộc về user
        if (!$orderInfo || $orderInfo['userId'] !== $userId) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng với ID: $orderCode";
            header("Location: /orders/history");
            exit;
        }

        //Lấy chi tiết đơn hàng
        $orderDetail = $this->orderModel->getOrderDetails($orderInfo['id']);

        renderView("view/orders/history_detail.php", compact('orderInfo', 'orderDetail'), "Chi tiết đơn hàng");
    }

    public function cancelOrder()
    {
        if (!isset($_POST['orderId'])) {
            http_response_code(400);
            echo json_encode(["error" => "Thiếu dữ liệu đơn hàng!"]);
            exit;
        }

        $orderId = $_POST['orderId'];
        $userId = $_SESSION['user']['id'] ?? null;

        $order = $this->orderModel->getOrderById($orderId);

        if (!$order || $order['userId'] !== $userId) {
            http_response_code(403);
            echo json_encode(["error" => "Bạn không có quyền hủy đơn hàng này!"]);
            exit;
        }

        if ($order['status'] != 'pending') {
            http_response_code(400);
            echo json_encode(["error" => "Đơn hàng đang được xử lý, không thể hủy!"]);
            exit;
        }

        // Lấy chi tiết đơn hàng và hoàn lại số lượng sản phẩm
        $orderDetails = $this->orderModel->getOrderDetails($orderId);
        foreach ($orderDetails as $item) {
            $this->orderModel->increaseProductQuantity($item['idProductVariants'], $item['quantity']);
        }

        // Cập nhật trạng thái đơn hàng thành "canceled"
        $this->orderModel->updateOrderStatus($orderId, 'cancelled');

        echo json_encode(["success" => "Đơn hàng đã được hủy!"]);
        exit;
    }

    // Lấy dữ liệu thống kê doanh thu
    public function getRevenueData()
    {
        $totalRevenue = $this->orderModel->getTotalRevenue();
        $revenueByMonth = $this->orderModel->getRevenueByMonth();
        $totalOrders = $this->orderModel->getTotalOrders();
        $completedOrders = $this->orderModel->getCompletedOrders();
        $processingOrders = $this->orderModel->getProcessingOrders();
        $totalQuantity = $this->orderModel->getTotalQuantity();

        // Chuyển dữ liệu về định dạng JSON cho giao diện
        $months = [];
        $revenues = [];
        foreach ($revenueByMonth as $data) {
            $months[] = "Tháng " . $data['month'];
            $revenues[] = $data['revenue'];
        }

        $data = [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'completedOrders' => $completedOrders,
            'processingOrders' => $processingOrders,
            'totalQuantity' => $totalQuantity,
            'months' => json_encode($months),
            'revenues' => json_encode($revenues)
        ];

        renderView("dashboard_admin.php", $data, "Biểu đồ doanh thu");
    }
}
