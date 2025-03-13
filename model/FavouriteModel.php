<?php
require_once "Database.php";




class FavoriteModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function addFavorite($userId, $productId) {
        $sql = "INSERT  INTO favourite_items (user_id, product_id) VALUES (:user_id, :product_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeFavorite($userId, $productId) {
        $sql = "DELETE FROM favourite_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    // Lấy danh sách sản phẩm yêu thích của người dùng
    public function getFavorites($userId) {
        $sql = "SELECT p.* FROM products p INNER JOIN favourite_items f ON p.id = f.product_id WHERE f.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Kiểm tra sản phẩm có trong danh sách yêu thích không
    public function isFavorite($userId, $productId) {
        $sql = "SELECT COUNT(*) FROM favourite_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        return $stmt->fetchColumn() > 0;
    }
}

