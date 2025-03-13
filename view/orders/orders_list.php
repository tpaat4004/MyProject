
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="">
    <h2 class="mb-4 text-center">Quản lý đơn hàng</h2>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr id="order-<?= $order['id'] ?>">
                    <td><?= $order['code'] ?></td>
                    <td><?= $order['createDate'] ?></td>
                    <td><strong><?= number_format($order['total']) ?> VNĐ</strong></td>
                    <td>
                        <select class="form-select update-status" data-order-id="<?= $order['id'] ?>">
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                            <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Đã nhận đơn</option>
                            <option value="paid" <?= $order['status'] == 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                            <option value="shipping" <?= $order['status'] == 'shipping' ? 'selected' : '' ?>>Đang giao hàng</option>
                            <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Đã giao</option>
                            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Hủy</option>
                        </select>
                    </td>
                    <td>
                        <a href="/orders/detail?code=<?= $order['code'] ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $(".update-status").change(function () {
                let orderId = $(this).data("order-id");
                let status = $(this).val();
                let row = $("#order-" + orderId);

                $.ajax({
                    url: "/orders/update-status",
                    type: "POST",
                    data: { orderId: orderId, status: status },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: 'Trạng thái đơn hàng đã được cập nhật!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Không thể cập nhật trạng thái!',
                        });
                    }
                });
            });

            <?php if (isset($_SESSION['message'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '<?= $_SESSION['message'] ?>',
                });
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: '<?= $_SESSION['error'] ?>',
                });
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
