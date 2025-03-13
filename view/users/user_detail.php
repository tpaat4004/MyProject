<h1><?= htmlspecialchars($user['name']) ?></h1>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Image:</strong></p>
<?php if (!empty($user['image'])): ?>
    <img src="/<?= htmlspecialchars($user['image']) ?>" alt="User Image" width="150" height="120">
<?php else: ?>
    <p>No Image</p>
<?php endif; ?>
<a href="/users" class="btn btn-secondary">Back to List</a>
