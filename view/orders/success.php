

<style>
    .success-container {
        text-align: center;
        padding: 40px;
        max-width: 600px;
        margin: 50px auto;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .success-icon {
        font-size: 50px;
        color: #28a745;
        margin-bottom: 20px;
    }

    .order-details {
        text-align: left;
        margin-top: 20px;
        font-size: 16px;
    }

    .order-details p {
        margin: 8px 0;
    }

    .btn-primary {
        display: inline-block;
        padding: 12px 20px;
        font-size: 16px;
        color: #fff;
        background: #007bff;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background: #0056b3;
    }
</style>

<div class="success-container">
    <div class="success-icon">✅</div>
    <h2>Cảm ơn bạn đã đặt hàng!</h2>
    <p>Đơn hàng của bạn đã được xác nhận.</p>

    <div class="order-details">
        <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($order['code']) ?></p>
        <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['paymentMethod']) ?></p>
        <p><strong>Tổng tiền:</strong> <?= number_format($order['total']) ?> VNĐ</p>
        <p><strong>Tên người nhận:</strong> <?= htmlspecialchars($order['name']) ?></p>
        <p><strong>SĐT người nhận:</strong> <?= htmlspecialchars($order['phone']) ?></p>
        <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($order['address']) ?></p>
        <p><strong>Trạng thái đơn hàng:</strong> <?= htmlspecialchars($order['status']) ?></p>
    </div>

    <a href="/shop" class="btn-primary">Tiếp tục mua hàng</a>
</div>


