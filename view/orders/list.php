<?php
$totalQuantity = 0;
$totalPrice = 0;

if (!empty($carts)) {
    foreach ($carts as $cartItem) {
        $totalQuantity += $cartItem['quantity'];
        $totalPrice += $cartItem['price'] * $cartItem['quantity'];
    }
}

$discountAmount = $_SESSION['coupon']['discount'] ?? 0;
$discountValue = ($totalPrice * $discountAmount) / 100;
$totalAfterDiscount = $totalPrice - $discountValue + 30000;
?>

<section id="checkout" class="h-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="fs-4 fw-bold">THÔNG TIN THANH TOÁN</h3>
                <form action="/orders/create" method="post" class="mb-3">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>


                    <div class="address-delivery">
                        <p class="fw-bold mb-2">1. Địa chỉ nhận hàng</p>
                        <div class="detail-address px-2">
                            <div class="existing-address mt-3">
                                <label for="saved_addresses" class="form-label">Chọn địa chỉ có sẵn</label>
                                <select name="saved_address_id" id="saved_addresses" class="w-100 p-2 form-control">
                                    <option value="">Chọn địa chỉ...</option>
                                    <?php foreach ($addresses as $address): ?>
                                        <option value="<?= htmlspecialchars($address['id']); ?>"
                                            <?= isset($_POST['saved_address_id']) && $_POST['saved_address_id'] == $address['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($address['name'] . ' - ' . $address['phone'] . ' - ' . $address['address']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Input ẩn để kiểm soát logic chọn địa chỉ -->
                                <input type="hidden" name="address_option" id="address_option" value="saved">
                            </div>

                            <div class="mt-3">
                                <input type="checkbox" id="new_address_check" name="new_address_check" <?= isset($_POST['new_address_check']) ? 'checked' : '' ?>>
                                <label for="new_address_check">Nhập địa chỉ mới</label>
                            </div>

                            <div id="new_address_section" style="display: <?= isset($_POST['new_address_check']) ? 'block' : 'none'; ?>;">
                                <div class="nameOrder mt-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" name="name" class="w-100 p-2 form-control" placeholder="Nhập tên" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                                </div>
                                <div class="phone mt-3">
                                    <label for="phone" class="form-label">SĐT</label>
                                    <input type="text" name="phone" class="w-100 p-2 form-control" placeholder="Nhập số điện thoại" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                                </div>
                                <div class="address mt-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" name="address" class="w-100 p-2 form-control" placeholder="Nhập địa chỉ" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                                </div>
                            </div>


                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let checkbox = document.getElementById('new_address_check');
                            let newAddressSection = document.getElementById('new_address_section');
                            let addressOption = document.getElementById('address_option');
                            let selectAddress = document.getElementById('saved_addresses');

                            checkbox.addEventListener('change', function() {
                                if (this.checked) {
                                    newAddressSection.style.display = 'block';
                                    addressOption.value = 'new';
                                    selectAddress.disabled = true;
                                } else {
                                    newAddressSection.style.display = 'none';
                                    addressOption.value = 'saved';
                                    selectAddress.disabled = false;
                                }
                            });

                            selectAddress.addEventListener('change', function() {
                                checkbox.checked = false;
                                newAddressSection.style.display = 'none';
                                addressOption.value = 'saved';
                            });
                        });
                    </script>


                    <!-- Ghi chú tách riêng -->
                    <div class="noteOrder mt-3">
                        <label for="note" class="form-label">Ghi chú</label>
                        <textarea name="note" id="note" class="w-100 p-2 form-control" rows="3" placeholder="Ghi chú ..."></textarea>
                    </div>
                    <hr>
                    <div class="payment">
                        <p class="fw-bold mb-2">2. Phương thức thanh toán</p>
                        <div class="payment-method px-2">
                            <div class="pay">
                                <input type="radio" name="payment" value="cod" id="payment1" required>
                                <label class="fs-6 mx-2" for="payment1">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="vnPay mt-1">
                                <input type="radio" name="payment" value="vnpay" id="payment2" required>
                                <label class="fs-6 mx-2" for="payment2">Thanh toán VNPAY</label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <input type="hidden" name="action" value="order">
                    <input type="submit" class="btn btn-primary fw-bold w-100 mt-3" value="MUA HÀNG">
                </form>
            </div>

            <div class="col-md-6">
                <h3 class="fs-4 fw-bold">THÔNG TIN SẢN PHẨM</h3>
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Size</th>
                            <th>Màu</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($carts)): ?>
                            <?php foreach ($carts as $cartItem): ?>
                                <tr>
                                    <td class="product-image">
                                        <div class="cart-products d-flex align-items-center">
                                            <div class="image-products">
                                                <img src="<?= $cartItem['product_image'] ?>" width="50" class="img-fluid">
                                            </div>
                                            <div class="product-content mx-2">
                                                <p class="product-name text-dark fw-bold"><?= htmlspecialchars($cartItem['sku']); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="name"><?= htmlspecialchars($cartItem['size_name']); ?></span></td>
                                    <td><span class="name"><?= htmlspecialchars($cartItem['color_name']); ?></span></td>
                                    <td><span class="price"><?= number_format($cartItem['price']); ?>đ</span></td>
                                    <td><span class="quantity text-center"><?= $cartItem['quantity']; ?></span></td>
                                    <td><span class="total-price"><?= number_format($cartItem['price'] * $cartItem['quantity']); ?>đ</span></td>
                                </tr>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống</td>
                            </tr>

                        <?php endif; ?>
                    </tbody>
                </table>
                <p><strong>Phí giao hàng: 30,000đ</strong></p>

                <!-- Form nhập mã giảm giá (TÁCH RIÊNG) -->
                <form action="/orders/apply-Coupon" method="post" class="mb-3">
                    <div class="coupon">
                        <p class="fw-bold mb-2">3. Áp dụng mã giảm giá</p>
                        <div class="coupon-input px-2">
                            <input type="text" name="coupon" id="coupon" placeholder="Nhập mã giảm giá" value="<?= $_SESSION['coupon']['code'] ?? '' ?>">
                            <button type="submit" name="applyCoupon" class="btn btn-success">Sử dụng</button>
                        </div>
                    </div>
                </form>

                <!-- Hiển thị thông tin mã giảm giá nếu có -->
                <?php if (isset($_SESSION['coupon'])): ?>
                    <p class="text-success mx-2">Bạn đã áp dụng mã: <strong><?= $_SESSION['coupon']['code']; ?></strong> (Giảm <?= $_SESSION['coupon']['discount']; ?>%)</p>

                    <!-- Form hủy mã giảm giá -->
                    <form action="/orders/remove-Coupon" method="post">
                        <button type="submit" class="btn btn-danger">Hủy mã</button>
                    </form>
                <?php endif; ?>

                <hr>
                <div class="d-flex justify-content-between text-danger">
                    <h5 class="fw-bold">TỔNG TIỀN:</h5>
                    <h5 class="fw-bold"><?= number_format($totalAfterDiscount); ?>đ</h5>
                </div>
            </div>
        </div>
    </div>
</section>