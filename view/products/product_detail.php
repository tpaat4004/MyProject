<h1><?= $product['name'] ?></h1>
<p><strong>Category: <?php foreach ($categories as $category): if ($category['id'] == $product['category_id']): echo $category['name']; endif; endforeach; ?></strong></p>
<p><strong>Description:</strong> <?= $product['description'] ?></p>
<p><strong>Price:</strong> $<?= $product['price'] ?></p>
<a href="/products" class="btn btn-secondary">Back to List</a>