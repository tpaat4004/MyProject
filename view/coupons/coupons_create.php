<h1>Thêm Mã Giảm Giá</h1>
<form id="createCouponForm" method="POST">
    <div class="mb-3">
        <label for="codeCoupon" class="form-label">Mã Giảm Giá</label>
        <input type="text" class="form-control" id="codeCoupon" name="codeCoupon" required>
    </div>

    <div class="mb-3">
        <label for="nameCoupon" class="form-label">Tên Mã Giảm Giá</label>
        <input type="text" class="form-control" id="nameCoupon" name="nameCoupon" required>
    </div>

    <div class="mb-3">
        <label for="discount" class="form-label">Giảm Giá (%)</label>
        <input type="number" class="form-control" id="discount" name="discount" min="1" max="100" required>
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">Ngày Bắt Đầu</label>
        <input type="datetime-local" class="form-control" id="startDate" name="startDate" required>
    </div>

    <div class="mb-3">
        <label for="endDate" class="form-label">Ngày Kết Thúc</label>
        <input type="datetime-local" class="form-control" id="endDate" name="endDate" required>
    </div>

    <div class="mb-3">
        <label for="quantityCoupon" class="form-label">Số Lượng</label>
        <input type="number" class="form-control" id="quantityCoupon" name="quantityCoupon" min="1" required>
    </div>

    <button type="submit" class="btn btn-success">Thêm Mã</button>
</form>

<!-- Thêm SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

