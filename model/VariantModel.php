<?php
require_once "Database.php";

class VariantModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariantById($id) {
        $query = "SELECT * FROM product_variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProductVariant($productId, $colorId, $sizeId, $quantity, $price, $sku) {
        $query = "INSERT INTO product_variants (product_id, color_id, size_id, quantity, price, sku) VALUES (:product_id, :color_id, :size_id, :quantity, :price, :sku)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':color_id', $colorId);
        $stmt->bindParam(':size_id', $sizeId);
        $stmt->bindParam(':quantity', $quantity); 
        $stmt->bindParam(':price', $price); 
        $stmt->bindParam(':sku', $sku);
        return $stmt->execute();
    }

    public function updateVariant($id, $productId, $colorId, $sizeId, $quantity, $price, $sku) {
        $query = "UPDATE product_variants SET product_id = :product_id, color_id = :color_id, size_id = :size_id, quantity = :quantity, price = :price, sku = :sku WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':color_id', $colorId);
        $stmt->bindParam(':size_id', $sizeId);
        $stmt->bindParam(':quantity', $quantity); 
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sku', $sku);
        return $stmt->execute();
    }
    
    public function getAllProductVariants() {
        $query = "
            SELECT pv.*, p.name AS product_name, c.name AS color_name, s.name AS size_name
            FROM product_variants pv
            INNER JOIN products p ON pv.product_id = p.id
            INNER JOIN colors c ON pv.color_id = c.id
            INNER JOIN sizes s ON pv.size_id = s.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteVariant($id) {
        $query = "DELETE FROM product_variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>