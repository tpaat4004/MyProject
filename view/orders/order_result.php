<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
    <h2>Chi tiết đơn hàng: <?php echo $orderInfo['code']; ?></h2>
    
    <p><b>Khách hàng:</b> <?php echo $orderInfo['name']; ?></p>
    <p><b>Địa chỉ:</b> <?php echo $orderInfo['address']; ?></p>
    <p><b>Số điện thoại:</b> <?php echo $orderInfo['phone']; ?></p>
    <p><b>Trạng thái:</b> <?php echo $orderInfo['status']; ?></p>
    <p><b>Thanh toán:</b> <?php echo $orderInfo['paymentMethod']; ?></p>
    <p><b>Tổng tiền:</b> <?php echo number_format($orderInfo['total']); ?> VNĐ</p>

    <h3>Danh sách sản phẩm:</h3>
    <ul>
        <?php foreach ($orderDetails as $item): ?>
            <li><?php echo $item['quantity'] . " x " . number_format($item['price']); ?> VNĐ</li>
        <?php endforeach; ?>
    </ul>

    <a href="search_order.php">Tìm đơn hàng khác</a>
</body>
</html>
