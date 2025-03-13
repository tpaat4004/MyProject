<h2>Chi tiết đơn hàng</h2>
<?php if (!isset($orderInfo) || empty($orderInfo)): ?>
    <p>Không tìm thấy đơn hàng.</p>
<?php else: ?>
    <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($orderInfo['code'] ?? 'Không có') ?></p>
    <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($orderInfo['createDate'] ?? 'Không có') ?></p>
    <p><strong>Tên khách hàng:</strong> <?= htmlspecialchars($orderInfo['name'] ?? 'Không có') ?></p>
    <p><strong>SĐT:</strong> <?= htmlspecialchars($orderInfo['phone'] ?? 'Không có') ?></p>
    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderInfo['address'] ?? 'Không có') ?></p>
    <p><strong>Mã giảm giá:</strong> <?= htmlspecialchars($orderInfo['coupon'] ?? 'Không có') ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($orderInfo['total'] ?? 0) ?> VNĐ</p>
    <p><strong>Ghi chú:</strong> <?= htmlspecialchars($orderInfo['note'] ?? 'Không có') ?></p>

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
            <?php foreach ($orderDetails as $item): ?>
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
<?php endif; ?>