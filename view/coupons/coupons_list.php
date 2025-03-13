<h1>Danh Sách Mã Giảm Giá</h1>
<a href="/coupons/create" class="btn btn-primary mb-3">Thêm Mã Giảm Giá</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Mã Giảm Giá</th>
            <th>Tên Chương Trình</th>
            <th>Giảm Giá (%)</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Số Lượng</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($coupons as $coupon): ?>
            <tr>
                <td><?= $coupon['id'] ?></td>
                <td><?= htmlspecialchars($coupon['codeCoupon']) ?></td>
                <td><?= htmlspecialchars($coupon['nameCoupon']) ?></td>
                <td><?= $coupon['discount'] ?>%</td>
                <td><?= date("d/m/Y H:i", strtotime($coupon['startDate'])) ?></td>
                <td><?= date("d/m/Y H:i", strtotime($coupon['endDate'])) ?></td>
                <td><?= $coupon['quantityCoupon'] ?></td>
                <td>
                    <a href="/coupons/edit/<?= $coupon['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/coupons/delete/<?= $coupon['id'] ?>" class="btn btn-danger  btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Thêm SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_GET['success'])): ?>
    <script>
        Swal.fire({
            title: "Thành công!",
            text: "Mã giảm giá đã được tạo thành công.",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php elseif (isset($_GET['error'])): ?>
    <script>
        Swal.fire({
            title: "Lỗi!",
            text: "Có lỗi xảy ra khi tạo mã giảm giá.",
            icon: "error",
            confirmButtonText: "Thử lại"
        });
    </script>
<?php endif; ?>
<?php if (isset($_GET['update_success'])): ?>
    <script>
        Swal.fire({
            title: "Thành công!",
            text: "Cập nhật mã giảm giá thành công.",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php elseif (isset($_GET['update_error'])): ?>
    <script>
        Swal.fire({
            title: "Lỗi!",
            text: "Có lỗi xảy ra khi cập nhật mã giảm giá.",
            icon: "error",
            confirmButtonText: "Thử lại"
        });
    </script>
<?php endif; ?>

<?php if (isset($_GET['delete_success'])): ?>
    <script>
        Swal.fire({
            title: "Đã xóa!",
            text: "Mã giảm giá đã được xóa thành công.",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php elseif (isset($_GET['delete_error'])): ?>
    <script>
        Swal.fire({
            title: "Lỗi!",
            text: "Không thể xóa mã giảm giá.",
            icon: "error",
            confirmButtonText: "Thử lại"
        });
    </script>
<?php endif; ?>

