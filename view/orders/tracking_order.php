<style>
    .tracking-container {
        text-align: center;
        margin-bottom: 30px;
    }

    .search-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 0 auto;
    }

    .search-box input {
        width: 300px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        outline: none;
    }

    .search-box input:focus {
        border-color: #007bff;
    }

    .search-box button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }

    .search-box button:hover {
        background-color: #0056b3;
    }
</style>

<div class="tracking-container">
    <h2>Tra cứu đơn hàng</h2>
    <form action="/orders/tracking" method="POST" class="search-box">
        <input type="text" name="code" value="<?= htmlspecialchars($orderCode) ?>" placeholder="Nhập mã đơn hàng">
        <button type="submit">Tra cứu</button>
    </form>
</div>


<?php if (!empty($_SESSION['error'])): ?>
    <p style="color: red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<?php if ($orderInfo): ?>
    <h3>Thông tin đơn hàng</h3>
    <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($orderInfo['code'] ?? 'Không có') ?></p>
    <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($orderInfo['createDate'] ?? 'Không có') ?></p>
    <p><strong>Tên khách hàng:</strong> <?= htmlspecialchars($orderInfo['name'] ?? 'Không có') ?></p>
    <p><strong>SĐT:</strong> <?= htmlspecialchars($orderInfo['phone'] ?? 'Không có') ?></p>
    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderInfo['address'] ?? 'Không có') ?></p>
    <p><strong>Mã giảm giá:</strong> <?= htmlspecialchars($orderInfo['coupon'] ?? 'Không có') ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($orderInfo['total'] ?? 0) ?> VNĐ</p>
    <p><strong>Ghi chú:</strong> <?= htmlspecialchars($orderInfo['note'] ?? 'Không có') ?></p>

    <h3>Chi tiết đơn hàng</h3>
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
