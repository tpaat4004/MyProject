<h1>Add Product Variant</h1>

<form method="POST">
    <!-- Chọn sản phẩm -->
    <div class="mb-3">
        <label for="product_id" class="form-label">Select Product</label>
        <select class="form-control" id="product_id" name="product_id" required>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Chọn màu sắc -->
    <div class="mb-3">
        <label for="colors" class="form-label">Colors</label>
        <select class="form-control" id="colors" name="colors[]" required>
            <?php foreach ($colors as $color): ?>
                <option value="<?= $color['id'] ?>"><?= htmlspecialchars($color['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Chọn kích thước -->
    <div class="mb-3">
        <label for="sizes" class="form-label">Sizes</label>
        <select class="form-control" id="sizes" name="sizes[]" required>
            <?php foreach ($sizes as $size): ?>
                <option value="<?= $size['id'] ?>"><?= htmlspecialchars($size['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Số lượng -->
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>

    <!-- Giá biến thể -->
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>

    <!-- SKU (Serial Number) -->
    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" required>
    </div>

    <button type="submit" class="btn btn-success">Add Variant</button>
</form>
