<?php
require_once "Database.php";

class CouponModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy danh sách tất cả mã giảm giá
    public function getAllCoupons() {
        $query = "SELECT * FROM coupons ORDER BY startDate DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm mã giảm giá mới
    public function addCoupon($code, $name, $discount, $startDate, $endDate, $quantity) {
        $query = "INSERT INTO coupons (codeCoupon, nameCoupon, discount, startDate, endDate, quantityCoupon) 
                  VALUES (:code, :name, :discount, :startDate, :endDate, :quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    // Lấy thông tin một mã giảm giá theo ID
    public function getCouponById($id) {
        $query = "SELECT * FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật mã giảm giá
    public function updateCoupon($id, $code, $name, $discount, $startDate, $endDate, $quantity) {
        $query = "UPDATE coupons SET 
                    codeCoupon = :code, 
                    nameCoupon = :name, 
                    discount = :discount, 
                    startDate = :startDate, 
                    endDate = :endDate, 
                    quantityCoupon = :quantity 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    // Xóa mã giảm giá
    public function deleteCoupon($id) {
        $query = "DELETE FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
