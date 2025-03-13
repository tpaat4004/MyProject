<h1>Edit Product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="mb-3">
        <label for="images" class="form-label">Image</label>
        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    </div>

    <?php if (!empty($images)): ?>
        <div class="mb-3">
            <label class="form-label">Current Images</label>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($images as $image): ?>
                    <div class="image-preview" style="position: relative;">
                        <img src="/<?= htmlspecialchars($image['image_path']) ?>" alt="Product Image" style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;">
                        <a href="/products/delete-image/<?= $image['id'] ?>" class="btn btn-danger btn-sm" style="position: absolute; top: 0; right: 0; transform: translate(50%, -50%);">X</a>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-warning">Update</button>
</form>
