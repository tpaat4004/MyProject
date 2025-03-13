<h1>Product Variants List</h1>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Product Name</th>
            <th>Color</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Sku</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productVariants as $variant): ?>
            <tr>
                <td><?= htmlspecialchars($variant['product_name']) ?></td>
                <td><?= htmlspecialchars($variant['color_name']) ?></td>
                <td><?= htmlspecialchars($variant['size_name']) ?></td>
                <td><?= $variant['quantity'] ?></td>
                <td><?= number_format($variant['price'], ) ?> VND</td>
                <td><?= $variant['sku'] ?></td>
                <td>
                    <a href="/product/edit/<?= $variant['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/product/delete/<?= $variant['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/product/add" class="btn btn-primary">Add New Variant</a>
