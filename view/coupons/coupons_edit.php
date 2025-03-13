<h1>Chỉnh Sửa Mã Giảm Giá</h1>
<form id="editCouponForm" method="POST">
    <div class="mb-3">
        <label for="codeCoupon" class="form-label">Mã Giảm Giá</label>
        <input type="text" class="form-control" id="codeCoupon" name="codeCoupon" value="<?= htmlspecialchars($coupon['codeCoupon']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="nameCoupon" class="form-label">Tên Chương Trình</label>
        <input type="text" class="form-control" id="nameCoupon" name="nameCoupon" value="<?= htmlspecialchars($coupon['nameCoupon']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="discount" class="form-label">Giảm Giá (%)</label>
        <input type="number" class="form-control" id="discount" name="discount" value="<?= $coupon['discount'] ?>" min="1" max="100" required>
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">Ngày Bắt Đầu</label>
        <input type="datetime-local" class="form-control" id="startDate" name="startDate" value="<?= date('Y-m-d\TH:i', strtotime($coupon['startDate'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="endDate" class="form-label">Ngày Kết Thúc</label>
        <input type="datetime-local" class="form-control" id="endDate" name="endDate" value="<?= date('Y-m-d\TH:i', strtotime($coupon['endDate'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="quantityCoupon" class="form-label">Số Lượng</label>
        <input type="number" class="form-control" id="quantityCoupon" name="quantityCoupon" value="<?= $coupon['quantityCoupon'] ?>" min="1" required>
    </div>

    <button type="submit" class="btn btn-warning">Cập Nhật</button>
</form>

<!-- Thêm SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
