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

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductDetails($productId)
    {
        $sql = "SELECT p.*, c.name AS category_name 
        FROM products p 
        INNER JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Lấy danh sách ảnh
            $sql = "SELECT * FROM product_images WHERE product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$productId]);
            $product['images'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Lấy danh sách biến thể (variants)
            $sql = "SELECT pv.*, c.name AS color_name, s.name AS size_name 
                    FROM product_variants pv 
                    INNER JOIN colors c ON pv.color_id = c.id 
                    INNER JOIN sizes s ON pv.size_id = s.id
                    WHERE pv.product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$productId]);
            $product['variants'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $product;
    }




    // Tạo sản phẩm mới và trả về ID
    public function createProduct($name, $category_id, $description, $price)
    {
        $query = "INSERT INTO products (name, category_id, description, price) VALUES (:name, :category_id, :description, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Trả về ID vừa chèn
        } else {
            throw new Exception("Failed to create product.");
        }
    }

    // Tải lên ảnh sản phẩm (kiểm tra sự tồn tại của product_id)
    public function uploadImages($productId, $imagePath)
    {
        // Kiểm tra product_id có tồn tại không
        $checkQuery = "SELECT COUNT(*) FROM products WHERE id = :product_id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() == 0) {
            throw new Exception("Product ID $productId does not exist.");
        }

        // Chèn ảnh vào bảng product_images
        $query = "INSERT INTO product_images (product_id, image_path) VALUES (:product_id, :image_path)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':image_path', $imagePath, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Failed to upload image for Product ID $productId.");
        }

        return true;
    }

    // Lấy danh sách ảnh theo ID sản phẩm
    public function getImagesByProductId($productId)
    {
        $query = "SELECT * FROM product_images WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $category_id, $description, $price)
    {
        $query = "UPDATE products SET name = :name, category_id = :category_id, description = :description, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function addProductVariant($productId, $colorId, $sizeId, $quantity, $price)
    {
        $query = "INSERT INTO product_variants (product_id, color_id, size_id, quantity, price) VALUES (:product_id, :color_id, :size_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':color_id', $colorId);
        $stmt->bindParam(':size_id', $sizeId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function getAllProductVariants()
    {
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

    // Lấy thông tin ảnh theo ID
    public function getImageById($imageId)
    {
        $query = "SELECT * FROM product_images WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$imageId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa ảnh theo ID
    public function deleteImageById($imageId)
    {
        $query = "DELETE FROM product_images WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$imageId]);
        return $stmt->rowCount() > 0;
    }

    public function getRelatedProducts($categoryId, $excludeProductId, $limit = 4)
    {
        $limit = (int) $limit; // Ép kiểu thành số nguyên

        $query = "SELECT p.id, p.name, p.price, 
                     (SELECT image_path FROM product_images WHERE product_id = p.id LIMIT 1) AS image 
              FROM products p
              WHERE p.category_id = ? AND p.id != ? 
              ORDER BY RAND() 
              LIMIT $limit";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$categoryId, $excludeProductId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
