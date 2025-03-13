
<h2>Chi tiết đơn hàng</h2>
<?php if (!isset($orderInfo) || empty($orderInfo)): ?>
    <p>Không tìm thấy đơn hàng.</p>
<?php else: ?>
<div class="container my-4">
    <h2 class="text-center">Chi tiết đơn hàng</h2>

    <div class="card p-3 mb-4">
        <h5>Mã đơn hàng: <?= htmlspecialchars($orderInfo['code']) ?></h5>
        <p>Ngày đặt: <?= date("d/m/Y H:i", strtotime($orderInfo['createDate'])) ?></p>
        <p>Tổng tiền: <b><?= number_format($orderInfo['total'], 0, ',', '.') ?> VND</b></p>
        <p>Trạng thái: <span class="badge bg-info"><?= htmlspecialchars($orderInfo['status']) ?></span></p>
        <p>Phương thức thanh toán: <?= htmlspecialchars($orderInfo['paymentMethod']) ?></p>
        <p>Địa chỉ giao hàng: <?= htmlspecialchars($orderInfo['address']) ?></p>
        <p>Ghi chú: <?= htmlspecialchars($orderInfo['note']) ?></p>
    </div>

    <h3>Danh sách sản phẩm</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>SKU</th>
                <th>Màu sắc</th>
                <th>Kích thước</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetail as $item): ?>
                <tr>
                    <td><img src="/<?= $item['product_image'] ?>" width="50"></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= htmlspecialchars($item['sku']) ?></td>
                    <td><?= htmlspecialchars($item['color_name']) ?></td>
                    <td><?= htmlspecialchars($item['size_name']) ?></td>
                    <td><?= number_format($item['price']) ?> VNĐ</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['quantity'] * $item['price']) ?> VNĐ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/orders/history" class="btn btn-secondary mt-3">Quay lại</a>
</div>
<?php endif; ?>



