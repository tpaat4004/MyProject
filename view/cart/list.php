<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        }
        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-control button {
            border: none;
            background-color: #007bff;
            color: white;
            width: 30px;
            height: 30px;
            font-size: 16px;
            border-radius: 5px;
        }
        .quantity-control input {
            width: 50px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <h2 class="text-center my-3">Giỏ hàng của bạn</h2>
        
        <?php if (count($carts) == 0): ?>
            <div class="alert alert-warning text-center">Giỏ hàng trống!</div>
        <?php else: ?>
            <form method="POST" action="/carts/update">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Size</th>
                            <th>Màu</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($carts as $cart): ?>
                            <tr>
                                <td><img src="<?= $cart['product_image'] ?>" width="50" class="img-fluid"></td>
                                <td><?= $cart['sku'] ?></td>
                                <td><?= $cart['size_name'] ?></td>
                                <td><?= $cart['color_name'] ?></td>
                                <td>
                                    <div class="quantity-control">
                                        <button type="button" class="btn-decrease">-</button>
                                        <input type="text" name="quantity[<?= $cart['id'] ?>]" value="<?= $cart['quantity'] ?>" class="quantity-input">
                                        <button type="button" class="btn-increase">+</button>
                                    </div>
                                </td>
                                <td><?= number_format($cart['price'], 0, ',', '.') ?>đ</td>
                                <td><?= number_format($cart['price'] * $cart['quantity'], 0, ',', '.') ?>đ</td>
                                <td><a href="/carts/delete/<?= $cart['id'] ?>" class="btn btn-danger btn-sm">Xóa</a></td>
                            </tr>
                            <?php $total += $cart['price'] * $cart['quantity']; ?>
                        <?php endforeach; ?>
                        <tr class="table-light">
                            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td><strong><?= number_format($total, 0, ',', '.') ?>đ</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                    <a href="/orders" class="btn btn-success">Thanh toán</a>
                    <a href="/shop" class="btn btn-secondary">Tiếp tục mua sắm</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
    
    <script>
        document.querySelectorAll('.btn-increase').forEach(button => {
            button.addEventListener('click', function () {
                let input = this.previousElementSibling;
                input.value = parseInt(input.value) + 1;
            });
        });
        
        document.querySelectorAll('.btn-decrease').forEach(button => {
            button.addEventListener('click', function () {
                let input = this.nextElementSibling;
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['error'])): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: '<?= $_SESSION['error'] ?>',
    });
</script>
<?php unset($_SESSION['error']); endif; ?>

<?php if (isset($_SESSION['message'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: '<?= $_SESSION['message'] ?>',
    });
</script>
<?php unset($_SESSION['message']); endif; ?>

</body>
</html>
