<?php
require_once "Database.php";

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProduct()
    {
        $query = "SELECT p.*, c.name as category_name,
              (SELECT GROUP_CONCAT(image_path) FROM product_images WHERE product_id = p.id) as images
              FROM products p 
              JOIN categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tách ảnh thành mảng
        foreach ($products as &$product) {
            $product['images'] = explode(',', $product['images']);
        }

        return $products;
    }

    public function getProductBySlug($slug)
    {
        $sql = "SELECT * FROM products WHERE slug = :slug LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($category_id, $name, $price, $description)
    {
        $query = "INSERT INTO products (category_id, name, price, description) 
              VALUES (:category_id, :name, :price, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        return $this->conn->lastInsertId(); // trả về id để lưu ảnh
    }

    public function addProductImage($product_id, $image_path)
    {
        $query = "INSERT INTO product_images (product_id, image_path) 
              VALUES (:product_id, :image_path)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':image_path', $image_path);
        return $stmt->execute();
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $product['images'] = $this->getProductImages($id); // lấy danh sách ảnh
        }

        return $product;
    }

    public function getProductImages($product_id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $category_id, $name, $price, $description)
    {
        $query = "UPDATE products SET category_id = :category_id, name = :name,
              price = :price, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
