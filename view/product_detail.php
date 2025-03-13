<?php

// Lấy danh sách màu sắc và kích thước không trùng lặp từ biến thể
$uniqueColors = [];
$uniqueSizes = [];

foreach ($product['variants'] as $variant) {
    if ($variant['product_id'] == $product['id']) {
        $uniqueColors[$variant['color_id']] = $variant['color_name'];
        $uniqueSizes[$variant['size_id']] = $variant['size_name'];
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-images img {
            max-width: 100%;
            border-radius: 10px;
        }

        .variant-select {
            margin-bottom: 15px;
        }

        .thumbnail:hover {
            border: 2px solid #007bff;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <div class="product-images text-center">
                    <!-- Ảnh chính -->
                    <img id="main-image" src="/<?= htmlspecialchars($product['images'][0]['image_path']) ?>"
                        alt="Main Product Image" class="img-fluid mb-3"
                        style="width: 350px; border-radius: 10px; height: 480px; object-fit: cover;">
                    <!-- Album ảnh nhỏ -->
                    <div class="d-flex justify-content-center gap-2">
                        <?php foreach ($product['images'] as $image): ?>
                            <img src="/<?= htmlspecialchars($image['image_path']) ?>"
                                alt="Thumbnail" class="thumbnail img-fluid"
                                style="width: 100px; height: 100px; border-radius: 5px; cursor: pointer; object-fit: cover;">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><b>Mô tả:</b><?= htmlspecialchars($product['description']) ?></p>
                <h6 id="product-sku">Mã sản phẩm (SKU): <?= !empty($product['sku']) ? htmlspecialchars($product['sku']) : 'Chưa có SKU' ?></h6>
                <h6 id="product-stock">Số lượng tồn kho: <?= !empty($product['stock']) ? htmlspecialchars($product['stock']) : '-' ?></h6>

                <!-- Form thêm vào giỏ hàng -->
                <form action="/carts/addToCart" method="POST" onsubmit="return validateQuantity(event)">
                    <!-- Chọn màu sắc -->
                    <div class="variant-select">
                        <label for="color">Màu sắc:</label>
                        <select name="color_id" id="color" class="form-control" required>
                            <option value="">Chọn màu sắc</option>
                            <?php foreach ($uniqueColors as $colorId => $colorName): ?>
                                <option value="<?= $colorId ?>"><?= htmlspecialchars($colorName) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Chọn kích thước -->
                    <div class="variant-select">
                        <label for="size">Kích thước:</label>
                        <select name="size_id" id="size" class="form-control" required>
                            <option value="">Chọn kích thước</option>
                            <?php foreach ($uniqueSizes as $sizeId => $sizeName): ?>
                                <option value="<?= $sizeId ?>"><?= htmlspecialchars($sizeName) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Nhập số lượng -->
                    <div class="variant-select">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                    </div>

                    <h4 id="product-price">Giá: <?= number_format($product['price'], 0, ',', '.') ?>đ</h4>

                    <!-- Ẩn trường SKU và giá sản phẩm -->
                    <input type="hidden" name="sku" value="">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">

                    <!-- Nút thêm vào giỏ hàng -->
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>

        <!-- Sản phẩm liên quan -->
        <div class="mt-5">
            <h3>Sản phẩm liên quan</h3>
            <div class="row">
                <?php foreach ($relatedProducts as $related): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="/<?= htmlspecialchars($related['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($related['name']) ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"> <?= htmlspecialchars($related['name']) ?> </h5>
                                <p class="card-text text-danger"> <?= number_format($related['price'], 0, ',', '.') ?>đ </p>
                                <a href="/product_detail/<?= $related['id'] ?>" class="btn btn-outline-primary">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        const variants = <?= json_encode($product['variants']) ?>;

        document.getElementById('color').addEventListener('change', updatePrice);
        document.getElementById('size').addEventListener('change', updatePrice);

        function updatePrice() {
            let colorId = document.getElementById('color').value;
            let sizeId = document.getElementById('size').value;
            let priceElement = document.getElementById('product-price');
            let skuElement = document.getElementById('product-sku');
            let stockElement = document.getElementById('product-stock');
            let skuInput = document.querySelector('input[name="sku"]');

            let selectedVariant = variants.find(v => v.product_id == <?= $product['id'] ?> && v.color_id == colorId && v.size_id == sizeId);

            if (selectedVariant) {
                priceElement.innerText = "Giá: " + new Intl.NumberFormat('vi-VN').format(selectedVariant.price) + "đ";
                skuElement.innerText = "Mã sản phẩm (SKU): " + selectedVariant.sku;
                stockElement.innerText = "Số lượng tồn kho: " + selectedVariant.quantity;
                skuInput.value = selectedVariant.sku;
            } else {
                stockElement.innerText = "Số lượng tồn kho: -";
                priceElement.innerText = "Giá: -";
                skuElement.innerText = "Mã sản phẩm (SKU): Chưa có";
                skuInput.value = "";
            }
        }


        function validateQuantity(event) {
            let quantityInput = document.getElementById('quantity');
            let stockElement = document.getElementById('product-stock').innerText;
            let stock = parseInt(stockElement.replace("Số lượng tồn kho: ", "")) || 0;
            let quantity = parseInt(quantityInput.value);

            if (quantity < 1 || quantity > stock) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Số lượng không vượt quá số lượng tồn kho!',
                });
            }
            return true;
        }

        document.querySelectorAll('.thumbnail').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('main-image').src = this.src;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>