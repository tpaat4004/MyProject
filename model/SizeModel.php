<?php
require_once "Database.php";

class SizeModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllSize() {
        $query = "SELECT * FROM sizes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSizeById($id) {
        $query = "SELECT * FROM sizes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createSize($name) {
        $query = "INSERT INTO sizes (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function updateSize($id, $name) {
        $query = "UPDATE sizes SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function deleteSize($id) {
        $query = "DELETE FROM sizes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getSizesByProductId($productId) {
        $query = "SELECT s.name 
                  FROM product_variants pv
                  JOIN sizes s ON pv.size_id = s.id
                  WHERE pv.product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
}
?>