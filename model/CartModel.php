<?php
require_once "Database.php";

class CartModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy giỏ hàng theo user_id hoặc session_id
    public function getCart($user_id, $session_id)
    {
        $query = "SELECT c.id, c.sku, c.size_id, c.color_id, c.quantity, c.price, 
                     s.name AS size_name, col.name AS color_name, 
                     pi.image_path AS product_image, 
                     pv.id AS idProductVariants  -- Lấy idProductVariants từ product_variants
              FROM carts c
              LEFT JOIN sizes s ON c.size_id = s.id
              LEFT JOIN colors col ON c.color_id = col.id
              LEFT JOIN product_variants pv ON c.sku = pv.sku  -- Liên kết với product_variants
              LEFT JOIN product_images pi ON pv.product_id = pi.product_id
              WHERE (c.user_id = :user_id OR c.cart_session = :cart_session)
              GROUP BY c.id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    private function productExists($user_id, $cart_session, $sku, $color_id, $size_id)
    {
        $query = "SELECT id, quantity FROM carts 
                  WHERE (user_id = :user_id OR cart_session = :cart_session)
                  AND sku = :sku AND color_id = :color_id AND size_id = :size_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindParam(':color_id', $color_id, PDO::PARAM_INT);
        $stmt->bindParam(':size_id', $size_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addCart($user_id, $cart_session, $sku, $color_id, $size_id, $quantity, $price)
    {
        try {
            $existingProduct = $this->productExists($user_id, $cart_session, $sku, $color_id, $size_id);

            if ($existingProduct) {
                $newQuantity = $existingProduct['quantity'] + $quantity;
                $query = "UPDATE carts SET quantity = :quantity WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
                $stmt->bindParam(':id', $existingProduct['id'], PDO::PARAM_INT);
            } else {
                $query = "INSERT INTO carts (user_id, cart_session, sku, color_id, size_id, quantity, price) 
                          VALUES (:user_id, :cart_session, :sku, :color_id, :size_id, :quantity, :price)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
                $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
                $stmt->bindParam(':color_id', $color_id, PDO::PARAM_INT);
                $stmt->bindParam(':size_id', $size_id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Lỗi SQL: ";
                print_r($stmt->errorInfo());
                exit();
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            exit();
        }
    }

    public function getCartItems($user_id, $session_id)
    {
        $query = "SELECT c.id, c.sku, c.size_id, c.color_id, c.quantity, c.price, 
                         s.name AS size_name, col.name AS color_name, 
                         pi.image_path AS product_image
                  FROM carts c
                  LEFT JOIN sizes s ON c.size_id = s.id
                  LEFT JOIN colors col ON c.color_id = col.id
                  LEFT JOIN product_variants pv ON c.sku = pv.sku
                  LEFT JOIN product_images pi ON pv.product_id = pi.product_id
                  WHERE (c.user_id = :user_id OR c.cart_session = :cart_session)
                  GROUP BY c.id";  // Tránh trùng ảnh nếu có nhiều ảnh

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy số lượng tồn kho của sản phẩm trong giỏ hàng
    public function getStockByCartId($cart_id)
    {
        $query = "SELECT pv.quantity 
              FROM carts c
              JOIN product_variants pv ON c.sku = pv.sku
              WHERE c.id = :cart_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['quantity'] : 0;
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartQuantity($cart_id, $new_quantity)
    {
        $query = "UPDATE carts SET quantity = :quantity WHERE id = :cart_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteCart($id)
    {
        $query = "DELETE FROM carts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function clearCart($user_id, $session_id)
    {
        $query = "DELETE FROM carts WHERE (user_id = :user_id OR cart_session = :cart_session)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Lấy ID giỏ hàng theo user_id
    public function getCartByIdUser($user_id)
    {
        $query = "SELECT id FROM carts WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm trong giỏ hàng theo cart_id
    public function getCartItemByIdCart($cart_id)
    {
        $query = "SELECT c.sku, c.quantity, c.price, pv.id AS idProductVariants, pv.product_id AS idProduct
              FROM carts c
              JOIN product_variants pv ON c.sku = pv.sku
              WHERE c.id = :cart_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo chi tiết đơn hàng
    public function createOrderItem($order_id, $product_id, $product_item_id, $quantity, $price)
    {
        $query = "INSERT INTO orders_detail (idOrder, idProductVariants, quantity, price) 
              VALUES (:order_id, :product_item_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_item_id', $product_item_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xóa giỏ hàng sau khi thanh toán thành công
    public function clearCartByIdUser($user_id)
    {
        $query = "DELETE FROM carts WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getVariantPrice($sku, $color_id, $size_id) {
        $sql = "SELECT price FROM product_variants WHERE sku = :sku AND color_id = :color_id AND size_id = :size_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':color_id', $color_id, PDO::PARAM_INT);
        $stmt->bindParam(':size_id', $size_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
