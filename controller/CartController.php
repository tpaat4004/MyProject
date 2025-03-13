<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";
require_once "model/CartModel.php";

class CartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    // Hiển thị giỏ hàng
    public function index()
    {

        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        renderView("view/cart/list.php", compact('carts'), "Giỏ hàng");
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'] ?? '';
            $color_id = $_POST['color_id'] ?? null;
            $size_id = $_POST['size_id'] ?? null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;


            // Kiểm tra dữ liệu đầu vào
            if (empty($sku) || empty($color_id) || empty($size_id) || $quantity <= 0) {
                $_SESSION['error'] = "Vui lòng chọn đầy đủ thông tin sản phẩm!";
                header("Location: /carts");
                exit;
            }

            //Lấy giá sản phẩm theo sku, color_id, size_id
            $variant = $this->cartModel->getVariantPrice($sku, $color_id, $size_id);
            if (!$variant) {
                $_SESSION['error'] = "Không tìm thấy sản phẩm!";
                header("Location: /carts");
                exit;
            }
            $price = $variant['price'];

            // Gọi model để thêm vào giỏ hàng
            $success = $this->cartModel->addCart($user_id, $session_id, $sku, $color_id, $size_id, $quantity, $price);

            if ($success) {
                $_SESSION['message'] = "Thêm vào giỏ hàng thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi thêm vào giỏ hàng. Vui lòng thử lại!";
            }

            header("Location: /carts");
            exit;
        }
    }

    public function updateCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantities = $_POST['quantity'] ?? [];

            foreach ($quantities as $cart_id => $new_quantity) {
                $new_quantity = (int) $new_quantity;

                // Kiểm tra nếu số lượng bằng 0, thì xóa sản phẩm khỏi giỏ hàng
                if ($new_quantity <= 0) {
                    $this->cartModel->deleteCart($cart_id);
                    continue;
                }

                // Kiểm tra tồn kho
                $stock = $this->cartModel->getStockByCartId($cart_id);
                if ($new_quantity > $stock) {
                    $_SESSION['error'] = "Số lượng vượt quá số lượng trong kho là $stock!";
                    header("Location: /carts");
                    exit;
                }

                // Cập nhật số lượng
                $this->cartModel->updateCartQuantity($cart_id, $new_quantity);
            }

            $_SESSION['message'] = "Cập nhật giỏ hàng thành công!";
            header("Location: /carts");
            exit;
        }
    }




    // Xóa sản phẩm khỏi giỏ hàng
    public function delete($id)
    {
        $this->cartModel->deleteCart($id);
        header("Location: /carts");
        exit;
    }
}
