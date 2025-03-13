<?php
require_once "Database.php";

class OrderModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createOrder($data)
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO orders (userId, code, name, phone, address, note, total, status, paymentMethod, coupon) 
                      VALUES (:userId, :code, :name, :phone, :address, :note, :total, :status, :paymentMethod, :coupon)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':userId' => $data['userId'],
                ':code' => $data['code'],
                ':name' => $data['name'],
                ':phone' => $data['phone'],
                ':address' => $data['address'],
                ':note' => $data['note'],
                ':total' => $data['total'],
                ':status' => $data['status'],
                ':paymentMethod' => $data['paymentMethod'],
                ':coupon' => $data['coupon']
            ]);

            $orderId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function createOrderDetail($data)
    {
        $query = "INSERT INTO orders_detail (idOrder, idProductVariants, quantity, price) 
                  VALUES (:idOrder, :idProductVariants, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':idOrder' => $data['idOrder'],
            ':idProductVariants' => $data['idProductVariants'],
            ':quantity' => $data['quantity'],
            ':price' => $data['price']
        ]);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $query = "UPDATE orders SET status = :status WHERE id = :orderId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getOrdersByUser($userId)
    {
        $query = "SELECT * FROM orders WHERE userId = :userId ORDER BY createDate DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function reduceCouponQuantity($couponCode)
    {
        $query = "UPDATE coupons SET quantityCoupon = quantityCoupon - 1 WHERE codeCoupon = :couponCode AND quantityCoupon > 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':couponCode', $couponCode, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function reduceProductQuantity($idProductVariants, $quantity)
    {
        $query = "UPDATE product_variants SET quantity = quantity - :quantity WHERE id = :idProductVariants AND quantity >= :quantity";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':idProductVariants', $idProductVariants, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllOrders()
    {
        $query = "SELECT * FROM orders ORDER BY createDate DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderWithDetails($orderCode)
{
    $query = "SELECT 
                o.*, -- Lấy thông tin đơn hàng
                od.*, -- Lấy chi tiết đơn hàng
                pv.sku, 
                pv.product_id, 
                pv.color_id, 
                pv.size_id, 
                pv.price, 
                p.name AS product_name, 
                c.name AS color_name, 
                s.name AS size_name, 
                (SELECT pi.image_path FROM product_images pi WHERE pi.product_id = pv.product_id LIMIT 1) AS product_image
              FROM orders o
              JOIN orders_detail od ON o.id = od.idOrder
              JOIN product_variants pv ON od.idProductVariants = pv.id
              JOIN products p ON pv.product_id = p.id
              LEFT JOIN colors c ON pv.color_id = c.id
              LEFT JOIN sizes s ON pv.size_id = s.id
              WHERE o.code = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$orderCode]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public function getOrderDetails($orderId)
    {
        $query = "SELECT 
                od.*, 
                pv.sku, 
                pv.product_id, 
                pv.color_id, 
                pv.size_id, 
                pv.price, 
                p.name AS product_name, 
                c.name AS color_name, 
                s.name AS size_name, 
                (SELECT pi.image_path FROM product_images pi WHERE pi.product_id = pv.product_id LIMIT 1) AS product_image
              FROM orders_detail od
              JOIN product_variants pv ON od.idProductVariants = pv.id
              JOIN products p ON pv.product_id = p.id
              JOIN colors c ON pv.color_id = c.id
              JOIN sizes s ON pv.size_id = s.id
              WHERE od.idOrder = :orderId";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([':orderId' => $orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getOrderByCode($orderCode)
    {
        $query = "SELECT * FROM orders WHERE code = :orderCode LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':orderCode' => $orderCode]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin đơn hàng
    }

    public function getOrderByCodeUser($Code, $userId)
    {
        // $query = "SELECT * FROM orders WHERE code = ? AND userId = ?";
        // $stmt = $this->conn->prepare($query);
        // $stmt->execute([$Code, $userId]);
        // return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin đơn hàng
    }

    public function getOrderById($orderId)
    {
        $query = "SELECT o.*, u.email FROM orders o 
            LEFT JOIN users u ON o.userId = u.id 
            WHERE o.id = :orderId";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([':orderId' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function increaseProductQuantity($idProductVariants, $quantity) {
        $query = "UPDATE product_variants SET quantity = quantity + :quantity WHERE id = :idProductVariants";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':idProductVariants', $idProductVariants, PDO::PARAM_INT);
        return $stmt->execute();
    }

     // Lấy tổng doanh thu của đơn hàng hoàn thành
     public function getTotalRevenue() {
        $query = "SELECT SUM(total) AS revenue FROM orders WHERE status = 'completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['revenue'];
    }

    // Lấy doanh thu theo tháng
    public function getRevenueByMonth() {
        $query = "SELECT MONTH(createDate) AS month, SUM(total) AS revenue 
                  FROM orders WHERE status = 'completed' 
                  GROUP BY MONTH(createDate) ORDER BY month";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalOrders() {
        $query = "SELECT COUNT(*) AS totalOrders FROM orders";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['totalOrders'];
    }

    public function getCompletedOrders() {
        $query = "SELECT COUNT(*) AS completedOrders FROM orders WHERE status = 'completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['completedOrders'];
    }

    public function getProcessingOrders() {
        $query = "SELECT COUNT(*) AS processingOrders FROM orders WHERE status = 'processing'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['processingOrders'];
    }

    public function getTotalQuantity() {
        $query = "SELECT SUM(quantity) AS totalQuantity FROM product_variants";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['totalQuantity'];
    }


    public function getUserAddresses($userId) {
        $query = "SELECT * FROM user_addresses WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAddressById($addressId) {
        $query = "SELECT * FROM user_addresses WHERE id = :addressId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':addressId' => $addressId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function saveNewAddress($userId, $name, $phone, $address) {
        $query = "INSERT INTO user_addresses (userId, name, phone, address) VALUES (:userId, :name, :phone, :address)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':userId' => $userId,
            ':name' => $name,
            ':phone' => $phone,
            ':address' => $address
        ]);
        return $this->conn->lastInsertId();
    }
    
    
}
