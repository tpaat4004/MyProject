<h1>Product List</h1>
<a href="/products/create" class="btn btn-primary mb-3">Create Product</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Miêu tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?php foreach ($categories as $category): if ($category['id'] == $product['category_id']): echo $category['name'];
                        endif;
                    endforeach; ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>
                    <?php if (!empty($product['images'])): ?>
                        <div style="display: flex; gap: 5px;">
                            <?php foreach ($product['images'] as $image): ?>
                                <img src="/<?= htmlspecialchars($image['image_path']) ?>" alt="Product Image" width="50" height="50">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span>No Images</span>
                    <?php endif; ?>
                </td>
                <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td>
                    <a href="/products/<?= $product['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>