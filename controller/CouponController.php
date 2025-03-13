<?php
require_once "model/CouponModel.php";

class CouponController {
    private $couponModel;

    public function __construct() {
        $this->couponModel = new CouponModel();
    }

    // Hiển thị danh sách mã giảm giá
    public function index() {
        $coupons = $this->couponModel->getAllCoupons();
        renderView("view/coupons/coupons_list.php", compact('coupons'), "Danh sách mã giảm giá");
    }

    // Hiển thị form thêm mới mã giảm giá
    public function show() {
        renderView("view/coupons/coupons_details.php", []);
    }

    // Xử lý thêm mã giảm giá
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['codeCoupon'] ?? '';
            $name = $_POST['nameCoupon'] ?? '';
            $discount = $_POST['discount'] ?? 0;
            $startDate = $_POST['startDate'] ?? '';
            $endDate = $_POST['endDate'] ?? '';
            $quantity = $_POST['quantityCoupon'] ?? 0;
    
            if ($this->couponModel->addCoupon($code, $name, $discount, $startDate, $endDate, $quantity)) {
                header("Location: /coupons?success=1");
            } else {
                header("Location: /coupons?error=1");
            }
            exit;
        }
        renderView("view/coupons/coupons_create.php", [], "Thêm mã giảm giá");
    }
    

    // Cập nhật mã giảm giá
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['codeCoupon'] ?? '';
            $name = $_POST['nameCoupon'] ?? '';
            $discount = $_POST['discount'] ?? 0;
            $startDate = $_POST['startDate'] ?? '';
            $endDate = $_POST['endDate'] ?? '';
            $quantity = $_POST['quantityCoupon'] ?? 0;
    
            if ($this->couponModel->updateCoupon($id, $code, $name, $discount, $startDate, $endDate, $quantity)) {
                header("Location: /coupons?update_success=1");
            } else {
                header("Location: /coupons?update_error=1");
            }
            exit;
        } else {
            $coupon = $this->couponModel->getCouponById($id);
            if (!$coupon) {
                header("Location: /coupons?not_found=1");
                exit;
            }
            renderView("view/coupons/coupons_edit.php", compact('coupon'), "Chỉnh sửa mã giảm giá");
        }
    }
    
    

    // Xóa mã giảm giá
    public function delete($id) {
        if ($this->couponModel->deleteCoupon($id)) {
            header("Location: /coupons?delete_success=1");
        } else {
            header("Location: /coupons?delete_error=1");
        }
        exit;
    }
    
}
?>
