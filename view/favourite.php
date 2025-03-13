<?php
$favorites = $favoriteModel->getFavorites($_SESSION['user']['id']);
?>

<h2>Danh sách yêu thích</h2>
<ul>
    <?php foreach ($favorites as $product): ?>
        <li><?= $product['name'] ?> - <button class="btn-remove-fav" data-product-id="<?= $product['id'] ?>">❌</button></li>
    <?php endforeach; ?>
</ul>

<script>
    document.querySelectorAll('.btn-remove-fav').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');

            fetch('/favorite/remove', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.parentElement.remove();
                } else {
                    alert(data.message);
                }
            });
        });
    });
</script>
