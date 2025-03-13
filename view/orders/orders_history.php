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
<div class="container my-4">
    <h2 class="text-center">Lịch sử đơn hàng</h2>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr id="order-<?= $order['id'] ?>">
                    <td><?= htmlspecialchars($order['code']) ?></td>
                    <td><?= date("d/m/Y", strtotime($order['createDate'])) ?></td>
                    <td><?= number_format($order['total'], 0, ',', '.') ?> VND</td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><a href="/orders/details?code=<?= $order['code'] ?>" class="btn btn-info btn-sm btn-primary">Xem</a></td>
                    <td>
                        <?php if ($order['status'] == 'pending' ): ?>
                            <button class="btn btn-danger btn-sm cancel-order" data-order-id="<?= $order['id'] ?>">Hủy</button>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $(".update-status").change(function() {
            let orderId = $(this).data("order-id");
            let status = $(this).val();
            let row = $("#order-" + orderId);

            $.ajax({
                url: "/orders/update-status",
                type: "POST",
                data: {
                    orderId: orderId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: 'Trạng thái đơn hàng đã được cập nhật!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
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

    $(document).ready(function () {
    $(".cancel-order").click(function () {
        let orderId = $(this).data("order-id");

        Swal.fire({
            title: "Bạn có chắc muốn hủy đơn hàng?",
            text: "Số lượng sản phẩm sẽ được hoàn lại vào kho!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Có, hủy đơn!",
            cancelButtonText: "Không"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/orders/cancel",
                    type: "POST",
                    data: { orderId: orderId },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đơn hàng đã được hủy!',
                            text: 'Trang sẽ được tải lại.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Reload lại trang sau khi xác nhận
                        });
                    },
                    error: function () {
                        Swal.fire("Lỗi!", "Không thể hủy đơn hàng.", "error");
                    }
                });
            }
        });
    });
});


</script>