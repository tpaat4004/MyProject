<?php
require_once "Database.php";

class ColorModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllColor() {
        $query = "SELECT * FROM colors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getColorById($id) {
        $query = "SELECT * FROM colors WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createColor($name) {
        $query = "INSERT INTO colors (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function updateColor($id, $name) {
        $query = "UPDATE colors SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function deleteColor($id) {
        $query = "DELETE FROM colors WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getColorsByProductId($productId) {
        $query = "SELECT c.name 
                  FROM product_variants pv
                  JOIN colors c ON pv.color_id = c.id
                  WHERE pv.product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
}
?>