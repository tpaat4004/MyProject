<h1>Edit Product Variant</h1>

<form action="/product/edit/<?= htmlspecialchars($variant['id']) ?>" method="POST">
    <div class="mb-3">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" class="form-control" required>
            <?php foreach ($products as $product): ?>
                <option value="<?= htmlspecialchars($product['id']) ?>" 
                        <?= $product['id'] == $variant['product_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($product['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="color_id">Color:</label>
        <select name="color_id" id="color_id" class="form-control" required>
            <?php foreach ($colors as $color): ?>
                <option value="<?= htmlspecialchars($color['id']) ?>" 
                        <?= $color['id'] == $variant['color_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($color['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="size_id">Size:</label>
        <select name="size_id" id="size_id" class="form-control" required>
            <?php foreach ($sizes as $size): ?>
                <option value="<?= htmlspecialchars($size['id']) ?>" 
                        <?= $size['id'] == $variant['size_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($size['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="price">Price (VND):</label>
        <input type="text" name="price" id="price" class="form-control" 
               value="<?= htmlspecialchars($variant['price']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" 
               value="<?= htmlspecialchars($variant['quantity']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" class="form-control" 
               value="<?= htmlspecialchars($variant['sku']) ?>" required>
    </div>


    <button type="submit" class="btn btn-success">Save Changes</button>
    <a href="/product" class="btn btn-secondary">Cancel</a>
</form>
